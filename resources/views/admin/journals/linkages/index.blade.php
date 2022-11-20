<x-master-layout>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Artikel Terkait</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ env('APP_URL') }}/admin/dashboard">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ env('APP_URL') }}/admin/posts/posts">All Post</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Post Linkages</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create-modal">
                            Add Linkage
                        </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-9 col-lg-8 col-md-7">
                    <div class="card user-card">
                        <div class="card-body">
                            <div class="user-info mb-1">
                                <h4 class="mb-1">{!! $data['post']['title'] !!}</h4>
                                <span class="card-text">{!! $data['post']['preview'] !!}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-5">
                    <div class="card plan-card">
                        <div class="card-header">
                            <h5 class="mb-0">{{ $data['widget']['date'] }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="badge badge-light-primary">{{ $data['post']->getCategory->name }}</div>
                                <div class="avatar bg-light-primary rounded">
                                    <div class="avatar-content">
                                        <i class="fa fa-check avatar-icon font-medium-2"></i>
                                    </div>
                                </div>
                                <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="" class="avatar pull-up my-0" data-original-title=" Ditambahkan oleh: {{ $data['author'][0]['name'] }}">
                                    <img src="{{ $data['author'][0]['avatar'] }}" alt="Avatar" height="32" width="32" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @livewire('post-linkage-index', ['postId'=> $data['post']->id])

    </div>

    @include('admin.posts.linkages.modal-create')

    @push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
            Livewire.hook('message.processed', (message, component) => {
                $(function () {
                    $('[data-toggle="tooltip"]').tooltip()
                })
            })
        });
        window.addEventListener('openModalDetail', event => {
            $("#detail-modal").modal('show');
        });

        window.addEventListener('openModalStatus', event => {
            $("#status-modal").modal('show');
        });

        window.addEventListener('closeModalStatus', event => {
            $("#status-modal").modal('hide');
        });

        window.addEventListener('openModalDelete', event => {
            $("#delete-modal").modal('show');
        });

        window.addEventListener('closeModalDelete', event => {
            $("#delete-modal").modal('hide');
        });
    </script>
    @endpush

</x-master-layout>

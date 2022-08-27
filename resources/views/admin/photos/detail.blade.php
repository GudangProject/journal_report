<x-master-layout>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Detail Photos</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ env('APP_URL') }}/admin/dashboard">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('photos.index') }}">Photos</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Detail</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    {{-- <div class="form-group breadcrumb-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create-modal">
                            Add Linkage
                        </button>
                    </div> --}}
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-5">
                    <div class="card user-card">
                        <div class="card-body">
                            <div class="user-info mb-1">
                                <h4 class="mb-1">Foto Utama</h4>
                                <a href="{{ $data->image }}" data-fancybox="gallery-a" data-fancybox data-type="image" data-caption="{{ $data->caption }}">
                                    <img class="img-fluid rounded mb-75" src="{{ $data->image }}" alt="{{ $data->title }}" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 col-md-7">
                    <div class="card user-card">
                        <div class="card-body">
                            <div class="user-info mb-1">
                                <h4 class="mb-1">{!! $data->title !!}</h4>
                                <span class="card-text">{!! $data->content !!}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card user-card">
                        <div class="card-body">
                            <div class="user-info mb-1">
                                <div class="row">
                                    <div class="col-6">
                                        <h4 class="mb-1">Foto Terkait <span class="badge badge-light-primary">{{ $photoContent->count() }}</span></h4>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end">
                                        <div class="form-group breadcrumb-right">
                                            <a href="{{ route('create-photos-linkage', $data->id) }}" class="btn btn-sm btn-primary">Tambah Photo</a>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        @livewire('photo-contents', ['parent_id' => $data->id ])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- @livewire('post-linkage-index', ['postId'=> $data['post']->id]) --}}

    </div>

    {{-- @include('admin.posts.linkages.modal-create') --}}

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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" type="text/css" media="screen" />
    @endpush

</x-master-layout>

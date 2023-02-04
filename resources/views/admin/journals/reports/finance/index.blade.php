<x-master-layout>
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-5 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h3 class="content-header-title float-left mb-0">Laporan Keuangan</h3>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/admin">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">List Laporan Keuangan
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-right col-md-3 col-7">
                    <div class="form-group breadcrumb-right">
                        @livewire('journals.mybank-form')
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h2 class="font-weight-bolder mb-0">Rp {{ number_format($data['income_amount']) }}</h2>
                                <p class="card-text">Dana Masuk</p>
                            </div>
                            <div class="avatar bg-light-primary p-50 m-0">
                                <div class="avatar-content">
                                    <i class="fa fa-credit-card font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h2 class="font-weight-bolder mb-0">Rp {{ number_format($data['speding_money']) }}</h2>
                                <p class="card-text">Dana Keluar</p>
                            </div>
                            <div class="avatar bg-light-danger p-50 m-0">
                                <div class="avatar-content">
                                    <i class="fa fa-credit-card font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                @if (session()->has('message'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <div class="alert-body"><strong>{{ session('message') }}</strong></div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @livewire('journals.finance-table')
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="{{asset('app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/cards/card-statistics.js')}}"></script>

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

        window.addEventListener('openModalEdit', event => {
            $("#edit-modal").modal('show');
        });

        window.addEventListener('closeModalEdit', event => {
            $("#edit-modal").modal('hide');
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

<x-master-layout>
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-5 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h3 class="content-header-title float-left mb-0">Pembayaran</h3>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">List Pembayaran
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-7">
                    <div class="form-group breadcrumb-right">
                        <a href="{{ route('payment.create') }}" class="btn btn-primary">Tambah</a>
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
                @else
                <div class="alert alert-dark alert-dismissible fade show" role="alert">
                    <div class="alert-body"><strong>Invoice akan muncul pada kolom AKSI, jika status pembayaran sudah LUNAS</strong></div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @livewire('journals.payment-table')
            </div>
        </div>
    </div>

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

        window.addEventListener('openModalEdit', event => {
            $("#edit-modal").modal('show');
        });

        window.addEventListener('closeModalEdit', event => {
            $("#edit-modal").modal('hide');
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

        window.addEventListener('openModalDeleteSelected', event => {
            $("#delete-modal-selected").modal('show');
        });

        window.addEventListener('closeModalDeleteSelected', event => {
            $("#delete-modal-selected").modal('hide');
        });
    </script>
    @endpush

</x-master-layout>

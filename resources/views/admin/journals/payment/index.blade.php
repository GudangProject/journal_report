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
                @role('author|super admin|pic')
                    <div class="content-header-right text-md-right col-md-3 col-7">
                        <div class="form-group breadcrumb-right">
                            <a href="{{ route('payment.create') }}" class="btn btn-primary">Tambah</a>
                        </div>
                    </div>
                @endrole
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h2 class="font-weight-bolder mb-0">Rp {{ number_format($paid) }}</h2>
                                <p class="card-text">LUNAS</p>

                            </div>
                            <div class="avatar bg-light-success p-50 m-0">
                                <div class="avatar-content">
                                    <i class="fa fa-credit-card font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                        @role('pic')
                        {{-- <div class="card-footer">
                            <h5 class="text-primary">Berdasarkan Volume :</h5>
                            <form action="{{ route('payment.index') }}" method="get">
                                <div class="row">
                                    <div class="col-4">
                                        <select name="volume" id="" class="form-control">
                                            @foreach ($dataVolume as $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <select name="number" id="" class="form-control">
                                            @foreach ($dataNumber as $item2)
                                                <option value="{{ $item2 }}">{{ $item2 }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4 text-left">
                                        <button type="submit" class="btn btn-dark">CEK</button>
                                    </div>
                                </div>
                            </form>
                        </div> --}}
                        @endrole
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h2 class="font-weight-bolder mb-0">Rp {{ number_format($pending) }}</h2>
                                <p class="card-text">PENDING</p>
                            </div>
                            <div class="avatar bg-light-warning p-50 m-0">
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
                @else
                    <div class="alert alert-dark alert-dismissible fade show" role="alert">
                        <div class="alert-body"><strong>Invoice akan muncul pada kolom AKSI, jika status pembayaran
                                sudah LUNAS</strong></div>
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
                $(function() {
                    $('[data-toggle="tooltip"]').tooltip()
                })
                Livewire.hook('message.processed', (message, component) => {
                    $(function() {
                        $('[data-toggle="tooltip"]').tooltip()
                    })
                })
            });

            window.addEventListener('openModalPayment', event => {
                $("#modal-proofpayment").modal('show');
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

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
                                    <li class="breadcrumb-item"><a href="/admin">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('payment.index') }}">List Pembayaran</a>
                                    </li>
                                    <li class="breadcrumb-item active">Invoice
                                    </li>
                                </ol>
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
                <div class="row invoice-preview">
                    <!-- Invoice -->
                    <div class="col-xl-9 col-md-8 col-12">
                        <div class="card invoice-preview-card">
                            <div class="card-body invoice-padding pb-0">
                                <!-- Header starts -->
                                <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                    <div>
                                        <div class="logo-wrapper">
                                            <h3 class="text-primary invoice-logo">Invoice Pembayaran Jurnal & Naskah</h3>
                                            <p>By {{ config('app.name') }}</p>
                                        </div>

                                    </div>
                                    <div class="mt-md-0 mt-2 text-right">
                                        <h4 class="invoice-title">
                                            Invoice
                                            <span class="invoice-number">#{{ $invoice->code }}</span>
                                        </h4>
                                        <p>{{ $payment->dateOriginal }}</p>
                                    </div>
                                </div>
                                <!-- Header ends -->
                            </div>

                            <hr class="invoice-spacing" />

                            <div class="card-body invoice-padding pt-0">
                                <div class="row invoice-spacing">
                                    <div class="col-xl-8 pl-1">
                                        <h6 class="mb-2">Kepada:</h6>
                                        <h6 class="mb-25 text-primary">{{ ucwords($payment->payer_name) }}</h6>
                                    </div>
                                    <div class="col-xl-4 pl-1 mt-xl-0 mt-2">
                                        <h6 class="mb-2">Detail Pembayaran:</h6>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="pr-1">Total :</td>
                                                    <td><span class="font-weight-bold">RP {{ number_format($payment->price) }} </span></td>
                                                </tr>
                                                <tr>
                                                    <td class="pr-1">Bank name:</td>
                                                    <td>{{ $payment->payer_bank }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="pr-1">No Rek:</td>
                                                    <td>{{ $payment->payer_rekening }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="py-1">List Pembayaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="py-1">
                                                <p class="card-text font-weight-bold mb-25">Jurnal</p>
                                                <p class="card-text text-nowrap text-primary">
                                                    {{ $payment->journal->name }}
                                                </p>
                                            </td>
                                        </tr>
                                        <tr class="border-bottom">
                                            <td class="py-1">
                                                <p class="card-text font-weight-bold mb-25">Naskah</p>
                                                <ul>
                                                    @foreach ($naskah as $item)
                                                        <li>{{ $item->name }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="card-body invoice-padding pb-0">
                                <div class="row invoice-sales-total-wrapper">
                                    <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                                        <p class="card-text mb-0">
                                            <span class="font-weight-bold">Total pembayaran:</span>
                                        </p>
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                                        <p><strong>RP {{ number_format($payment->price) }}</strong></p>
                                    </div>
                                </div>
                            </div>
                            <!-- Invoice Description ends -->

                            <hr class="invoice-spacing" />

                            <!-- Invoice Note starts -->
                            <div class="card-body invoice-padding pt-0">
                                <div class="row">
                                    <div class="col-12">
                                        <span class="font-weight-bold">Keterangan:</span>
                                        <span>{!! $payment->description !!}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Invoice Note ends -->
                        </div>
                    </div>
                    <!-- /Invoice -->

                    <!-- Invoice Actions -->
                    <div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('reports.invoice-download', ['id' => $payment->id]) }}" class="btn btn-primary btn-block mb-75">
                                    Download
                                </a>
                                <a class="btn btn-outline-secondary btn-block mb-75" href="./app-invoice-print.html" target="_blank">
                                    Print
                                </a>

                            </div>
                        </div>
                    </div>
                    <!-- /Invoice Actions -->
                </div>
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

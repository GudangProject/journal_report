<div wire:ignore.self class="modal fade text-left" id="modal-proofpayment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel16">Bukti pembayaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @isset($detailPayment)
                    <div class="row">
                        <div class="col-12">
                            <div class="row mb-3">
                                <div class="col-4">
                                    <b>Jurnal</b>
                                </div>
                                <div class="col-1">:</div>
                                <div class="col-7 d-flex justify-content-right">
                                    {{ $detailPayment->journal->name }}
                                </div>
                                <div class="col-4">
                                    <b>Volume</b>
                                </div>
                                <div class="col-1">:</div>
                                <div class="col-7 d-flex justify-content-right">
                                    {{ $detailPayment->journal->volume }} No. {{ $detailPayment->journal->number }} {{ $detailPayment->journal->month }} {{ $detailPayment->journal->year }}, Semester: {{ $detailPayment->journal->semester }}
                                </div>
                                <div class="col-4">
                                    <b>Rumpun Ilmu</b>
                                </div>
                                <div class="col-1">:</div>
                                <div class="col-7 d-flex justify-content-right">
                                    {{ strtoupper($detailPayment->knowledge) }}
                                </div>
                                <div class="col-4">
                                    <b>Naskah</b>
                                </div>
                                <div class="col-1">:</div>
                                <div class="col-7">
                                    @isset($detailPayment)
                                        @foreach ($detailPayment->naskah() as $item)
                                            <a href="{{ $item->link }}" style="margin: 3px;font-weight:bold;" class="badge badge-success" title="{{ $item->name }}">
                                                {{ $item->sortName }} <span class="badge badge-dark"><small>No. </small>{{ $item->number }}</span>
                                            </a><br>
                                        @endforeach
                                    @endisset
                                </div>
                                <div class="col-4">
                                    <b>Tanggal Pembayaran</b>
                                </div>
                                <div class="col-1">:</div>
                                <div class="col-7 d-flex justify-content-right">
                                    {{ $detailPayment->date }}
                                </div>
                                <div class="col-4">
                                    <b>Nama</b>
                                </div>
                                <div class="col-1">:</div>
                                <div class="col-7 d-flex justify-content-right">
                                    <tt>{{ $detailPayment->payer_name }}</tt>
                                </div>
                                <div class="col-4">
                                    <b>Rekening</b>
                                </div>
                                <div class="col-1">:</div>
                                <div class="col-7 d-flex justify-content-right">
                                    <tt>{{ $detailPayment->payer_bank }} {{ $detailPayment->payer_rekening }}</tt>
                                </div>
                                <div class="col-4">
                                    <b>Total</b>
                                </div>
                                <div class="col-1">:</div>
                                <div class="col-7 d-flex justify-content-right">
                                    <tt>Rp {{ number_format($detailPayment->price) }}</tt>
                                </div>
                                <div class="col-4">
                                    <b>Dibayar kepada</b>
                                </div>
                                <div class="col-1">:</div>
                                <div class="col-7 d-flex justify-content-right text-danger">
                                    <tt>{{ $detailPayment->mybank->bank }} {{ $detailPayment->mybank->no_rekening }} a.n {{ $detailPayment->mybank->owner }}</tt>
                                </div>
                                <div class="col-4">
                                    <b>Status</b>
                                </div>
                                <div class="col-1">:</div>
                                <div class="col-7 d-flex justify-content-right">
                                    <div class="btn-group">
                                        @role('author|admin|pic')
                                        <button class="btn btn-sm btn-{{ $detailPayment->status == 1 ? 'success' : 'secondary' }}">
                                            {{ $detailPayment->status == 1 ? 'LUNAS' : 'PENDING' }}
                                        </button>
                                        @endrole
                                    </div>
                                </div>
                                <div class="col-4">
                                    <b>Foto</b>
                                </div>
                                <div class="col-1">:</div>
                                <div class="col-7 d-flex justify-content-right">
                                    <a href="{{ asset('storage/pictures/payment/big/'.$detailPayment->image) }}">
                                        <img src="{{ asset('storage/pictures/payment/big/'.$detailPayment->image) }}" id="account-upload-img" class="rounded" alt="image" height="150" width="150">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endisset
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-primary" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel160">Tambah Rumpun Ilmu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-12">

                                <div class="form-group">
                                    <h5 class="text-primary">NAMA RUMPUN ILMU</h5>
                                    <input id="name" wire:model="name" type="text" class="form-control" value="{{ old('name') }}"/>
                                    @if ($errors->has('name'))<span class="text-danger">{{$errors->first('name')}}</span>@endif
                                </div>

                            </div>

                            <div class="col-12">
                                <div class="form-group border rounded p-1">
                                    <button type="submit" class="btn btn-primary mr-1">Simpan</button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade text-left modal-primary" id="status-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel160">Update Status 😊</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                Apakah anda yakin ingin update status data tersebut!
            </div>
            <div class="modal-footer">
                <button wire:click.prevent="updateStatus()" type="button" class="btn btn-primary">Ok</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade text-left modal-primary" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel160">Hapus Data 😊</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin hapus data tersebut!
            </div>
            <div class="modal-footer">
                <button wire:click.prevent="deleteStatus()" type="button" class="btn btn-primary">Ok</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade text-left modal-primary" id="delete-modal-selected" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel160">Hapus Data 😊</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin hapus data tersebut!
            </div>
            <div class="modal-footer">
                <button wire:click.prevent="deleteSelected()" type="button" class="btn btn-primary">Ok</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

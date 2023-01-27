
<div class="modal fade modal-primary" id="detail-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel160">{!! $title !!}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="{!! empty($image) ? '' : $image !!}" class="img-fluid card-img-top" alt="{{ $name }}" />
                <div class="row">
                    <div class="col-12">
                        {!! $content !!}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade text-left modal-primary" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel160">Update Status 😊</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label>No Rekening </label>
                    <div class="form-group">
                        <input type="number" wire:model.defer="no_rekening" class="form-control" />
                        @error('no_rekening') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <label>Bank </label>
                    <div class="form-group">
                        <input type="text" wire:model.defer="bank" class="form-control" />
                        @error('bank') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <label>Nama Pemilik </label>
                    <div class="form-group">
                        <input type="text" wire:model.defer="owner" class="form-control" />
                        @error('owner') <span class="error">{{ $message }}</span> @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <a wire:click='update()' class="btn btn-primary" data-dismiss="modal">Simpan</a>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade text-left modal-primary" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel160">Peringatan !</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Data laporan asset jumlah uang pada rekening tersebut akan hilang pada sistem ini.</p><br>
                Apakah anda yakin ingin hapus data tersebut!
            </div>
            <div class="modal-footer">
                <button wire:click.prevent="deleteStatus()" type="button" class="btn btn-primary">Ok</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

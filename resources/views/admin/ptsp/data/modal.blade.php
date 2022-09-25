<div class="modal-size-default d-inline-block">
    <div wire:ignore.self class="modal fade text-left" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel18">Tambah Data PTSP Baru</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <h5 class="text-primary">NAMA LAYANAN</h5>
                            <input wire:model='name' type="text" class="form-control" placeholder="Nama Layanan" required/>
                        </div>
                        <div class="form-group">
                            <h5 class="text-primary">PERSYARATAN</h5>
                            <textarea wire:model='persyaratan' rows="5" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <h5 class="text-primary">KATEGORI</h5>
                            <select name="parent_id" class="form-control" wire:model='category'>
                                <option value="">--Pilih Parent Kategori--</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id_layanan }}">{{ $item->nama_layanan }}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" wire:click='saveData()'>SIMPAN</button>
                    </div>
                </form>
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
                Semua permohonan layanan yang berkaitan dengan data akan terhapus !<br/>
                Apakah anda yakin ingin hapus data tersebut!
            </div>
            <div class="modal-footer">
                <button wire:click.prevent="deleteStatus()" type="button" class="btn btn-primary">Ok</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

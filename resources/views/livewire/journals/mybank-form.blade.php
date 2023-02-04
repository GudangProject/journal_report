<div>
    <div class="form-group">
        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#inlineForm">TAMBAH REKENING</a>
    </div>
    @if (session()->has('message'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <div class="alert-body"><strong>{{ session('message') }}</strong></div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <div class="alert-body"><strong>{{ session('error') }}</strong></div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!-- Modal -->
    <div wire:ignore class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Rekening Tujuan/Penerima</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>No Rekening </label>
                    <div class="form-group">
                        <input type="number" wire:model="no_rekening" class="form-control" />
                        @error('no_rekening') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <label>Bank </label>
                    <div class="form-group">
                        <input type="text" wire:model="bank" class="form-control" />
                        @error('bank') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <label>Nama Pemilik </label>
                    <div class="form-group">
                        <input type="text" wire:model="owner" class="form-control" />
                        @error('owner') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <a wire:click='submit()' class="btn btn-primary" data-dismiss="modal">Simpan</a>
                </div>
            </div>
        </div>
    </div>
</div>

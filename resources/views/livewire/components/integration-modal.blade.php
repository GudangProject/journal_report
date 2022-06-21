<div class="modal-size-lg d-inline-block">
    <div class="modal fade text-left" id="form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel18">
                        @if($showEditModal)
                        <span>Edit Integrasi</span>
                        @else
                        <span>Buat Integrasi</span>
                        @endif
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'update' : 'store' }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <h5 class="text-primary">NAMA</h5>
                            <input wire:model.defer="name" id="name" type="text" class="form-control"/>
                            @if ($errors->has('name'))<span class="text-danger">{{$errors->first('name')}}</span>@endif
                        </div>
                        <div class="form-group">
                            <h5 class="text-primary">DOMAIN</h5>
                            <input wire:model.defer="domain" id="domain" type="text" class="form-control"/>
                            @if ($errors->has('domain'))<span class="text-danger">{{$errors->first('domain')}}</span>@endif
                        </div>
                        <div class="form-group">
                            <h5 class="text-primary">API</h5>
                            <input wire:model.defer="api" id="api" type="text" class="form-control"/>
                            @if ($errors->has('api'))<span class="text-danger">{{$errors->first('api')}}</span>@endif
                        </div>
                        <div class="form-group">
                            <h5 class="text-primary">Token</h5>
                            <input wire:model.defer="token" id="token" type="text" class="form-control"/>
                            @if ($errors->has('token'))<span class="text-danger">{{$errors->first('token')}}</span>@endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade text-left modal-primary" id="status" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
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
                <button wire:click.prevent="updateStatus()" type="button" class="btn btn-primary">Ok</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

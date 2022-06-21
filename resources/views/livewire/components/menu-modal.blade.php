<div class="modal-size-lg d-inline-block">
    <div class="modal fade text-left" id="form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel18">
                        @if($showEditModal)
                        <span>Edit Menu</span>
                        @else
                        <span>Buat Menu</span>
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
                            <h5 class="text-primary">URL</h5>
                            <input wire:model.defer="slug" id="slug" type="text" class="form-control"/>
                            @if ($errors->has('slug'))<span class="text-danger">{{$errors->first('slug')}}</span>@endif
                        </div>
                        <div class="form-group">
                            <h5 class="text-primary">KATEGORI</h5>
                            <select wire:model.defer="category_id" class="form-control" id="basicSelect">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('category_id'))
                            <span class="text-danger">
                                {{ $errors->first('category_id') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <h5 class="text-primary">PARENT</h5>
                            <select wire:model.defer="parent_id" class="form-control" id="basicSelect">
                                <option value="0"> -- No Parent -- </option>
                                @foreach ($row_category as $item)
                                <option value="{{ $item->id }}" {{ ($item->id == $parent_id ? 'selected' : '') }}>{!! $item->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <h5 class="text-primary">TYPE</h5>
                            <select wire:model.defer="type" class="form-control" id="basicSelect">
                                <option value="0" {{ ($type == 0 ? 'selected' : '') }}>NONE</option>
                                <option value="1" {{ ($type == 1 ? 'selected' : '') }}>SUBMENU</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <h5 class="text-primary">STATUS</h5>
                            <div class="d-flex flex-row">
                                <div class="custom-control custom-radio">
                                    <input wire:model.defer="status" type="radio" id="customRadio4" class="custom-control-input" value="1" {{ ($status == 1 ? 'checked' : '') }}/>
                                    <label class="custom-control-label" for="customRadio4">Aktif</label>
                                </div>
                                <div class="custom-control custom-radio ml-2">
                                    <input wire:model.defer="status" type="radio" id="customRadio5" class="custom-control-input" value="0" {{ ($status == 0 ? 'checked' : '') }}/>
                                    <label class="custom-control-label" for="customRadio5">Tidak</label>
                                </div>
                            </div>
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

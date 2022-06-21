<div class="modal-size-default d-inline-block">
    <div class="modal fade text-left" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('menuscategories.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel18">Buat Kategori Menu</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <h5 class="text-primary">NAMA</h5>
                            <input name="name" type="text" class="form-control" placeholder="Kategori Menu" value="{{ old('name') }}" required/>
                        </div>
                        <div class="form-group">
                            <h5 class="text-primary">DESKRIPSI</h5>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        <h5 class="text-primary">STATUS</h5>
                        <div class="d-flex flex-row">
                            <div class="custom-control custom-radio">
                                <input name="status" type="radio" id="customRadio4" class="custom-control-input" value="1" checked/>
                                <label class="custom-control-label" for="customRadio4">Aktif</label>
                            </div>
                            <div class="custom-control custom-radio ml-2">
                                <input name="status" type="radio" id="customRadio5" class="custom-control-input" value="0"/>
                                <label class="custom-control-label" for="customRadio5">Tidak</label>
                            </div>
                        </div>
                        @if ($errors->has('status'))<span class="text-danger">{{$errors->first('status')}}</span>@endif
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" >Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

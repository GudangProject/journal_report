<div class="modal-size-default d-inline-block">
    <div class="modal fade text-left" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('videocategories.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel18">Buat Kategori Video</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <h5 class="text-primary">NAMA</h5>
                            <input name="name" type="text" class="form-control" placeholder="Nama Kategori Video" value="{{ old('name') }}" required/>
                        </div>
                        <div class="form-group">
                            <h5 class="text-primary">DESKRIPSI</h5>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <h5 class="text-primary">PARENT KATEGORI</h5>
                            <select name="parent_id" class="form-control">
                                <option value="">--Pilih Parent Kategori--</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" >Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

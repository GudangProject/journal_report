<div>
    <div class="card">
        <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('journals.store') }}">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 col-12 mb-2">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-primary">Nama Jurnal</td>
                                    <th class="text-primary">Volume Jurnal</th>
                                    <th class="text-primary"></th>
                                </tr>
                            </thead>
                            <tbody id="add-volume">
                                <tr>
                                    <td>
                                        <select class="select2 form-control" name="journal_id" wire:model="journal_id">
                                            <option selected disabled>--Silahkan Pilih---</option>
                                            @foreach ($journals as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </td>
                                    <td>
                                        <select class="select2 form-control" name="volume">
                                            @isset($volume)
                                                @foreach ($volume as $item)
                                                    <option value="{{ $item->volume }}">{{ $item->volume.' No.'.$item->number.' Bulan '.$item->month.' Tahun '.$item->year }}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </td>

                                    <td><button type="text" class="btn btn-success btn-add"><i class="fas fa-plus"></i></button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <h5 class="text-primary">Nama</h5>
                            <input id="payer_name" name="payer_name" type="text" class="form-control" placeholder="Nama Pembayar" value="{{ old('payer_name') }}"/>
                            @error('payer_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <h5 class="text-primary">Judul Naskah</h5>
                            <input id="manuscript_title" name="manuscript_title" type="text" class="form-control" placeholder="Judul Naskah" value="{{ old('manuscript_title') }}"/>
                            @error('manuscript_title') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <h5 class="text-primary">Link Naskah</h5>
                            <input id="manuscript_link" name="manuscript_link" type="text" class="form-control" placeholder="Link Naskah" value="{{ old('manuscript_link') }}"/>
                            @error('manuscript_link') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <h5 class="text-primary">Biaya</h5>
                            <div class="input-group">
                                <input type="number" name="price" class="form-control"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-xl-4 col-12">
                        <h5 class="text-primary">Bukti Bayar</h5>
                        <div class="form-group">
                            <div class="media flex-column text-center">
                                <div class="media-body mt-1 w-100">
                                    <div class="d-inline-block">
                                        <div class="form-group mb-0">
                                            <div class="custom-file mb-1">
                                                <input name="image" type="file" class="custom-file-input" id="image-crop" accept="image/*" />
                                                @if ($errors->has('image'))<span class="text-danger">{{$errors->first('image')}}</span>@endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="16_9_width" id="16_9_width"/>
                            <input type="hidden" name="16_9_height" id="16_9_height"/>
                            <input type="hidden" name="16_9_x" id="16_9_x"/>
                            <input type="hidden" name="16_9_y" id="16_9_y"/>

                            <input type="hidden" name="4_3_width" id="4_3_width"/>
                            <input type="hidden" name="4_3_height" id="4_3_height"/>
                            <input type="hidden" name="4_3_x" id="4_3_x"/>
                            <input type="hidden" name="4_3_y" id="4_3_y"/>

                            <input type="hidden" name="1_1_width" id="1_1_width"/>
                            <input type="hidden" name="1_1_height" id="1_1_height"/>
                            <input type="hidden" name="1_1_x" id="1_1_x"/>
                            <input type="hidden" name="1_1_y" id="1_1_y"/>
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <div class="form-group border rounded p-1">
                            <button type="submit" class="btn btn-primary mr-1">Simpan</button>
                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

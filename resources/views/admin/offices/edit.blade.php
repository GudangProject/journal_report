<x-master-layout>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-7 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h3 class="content-header-title float-left mb-0">Office</h3>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('offices.index') }}">List Office</a>
                                    </li>
                                    <li class="breadcrumb-item active">Edit</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('offices.update', $data->id) }}">
                                    @method('PUT')
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8 col-12">

                                                <div class="form-group">
                                                    <h5 class="text-primary">JUDUL</h5>
                                                    <input id="title" name="title" type="text" class="form-control" placeholder="Judul Office" value="{{ $data->title }}"/>
                                                    @if ($errors->has('title'))<span class="text-danger">{{$errors->first('title')}}</span>@endif
                                                </div>

                                                <div class="form-group">
                                                    <h5 class="text-primary">SLUG</h5>
                                                    <div class="alert alert-primary" role="alert">
                                                        <div class="alert-body"><strong id="text-slug"> {{ $data->slug }}</strong></div>
                                                    </div>
                                                    <span id="input-slug" style="display:none;">
                                                        <input name="slug" type="text" id="slug" class="form-control mb-1" value="{{ $data->slug }}"/>
                                                        <button type="button" class="btn btn-primary btn-xs" id="simpan_slug">OK</button>
                                                        <button type="button" class="btn btn-secondary btn-xs" id="close_slug">Cancel</button>
                                                    </span>
                                                    @if ($errors->has('slug'))<span class="text-danger">{{$errors->first('slug')}}</span>@endif
                                                </div>

                                                <div class="form-group">
                                                    <h5 class="text-primary">KATEGORI</h5>
                                                    <select name="category_id" class="form-control" id="basicSelect">
                                                        <option value="">-- Pilih Kategori --</option>
                                                        @foreach ($categories as $item)
                                                        <option value="{{ $item->id }}" {{ ($item->id == $data->category_id ? 'selected' : '') }}>{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('category_id'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('category_id') }}
                                                    </span>
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                    <h5 class="text-primary">WEBSITE</h5>
                                                    <input name="description" type="text" class="form-control" placeholder="Alamat Website" value="{{ $data->description }}"/>
                                                    @if ($errors->has('description'))<span class="text-danger">{{$errors->first('description')}}</span>@endif
                                                </div>

                                                <div class="form-group">
                                                    <h5 class="text-primary">SEJARAH</h5>
                                                    <textarea name="content" class="form-control">{{ $data->content }}</textarea>
                                                    @if ($errors->has('content'))<span class="text-danger">{{$errors->first('content')}}</span>@endif
                                                </div>

                                                <div class="form-group">
                                                    <h5 class="text-primary">INFORMASI</h5>
                                                    <textarea name="information" id="information" class="form-control">{{ $data->information }}</textarea>
                                                    @if ($errors->has('information'))<span class="text-danger">{{$errors->first('information')}}</span>@endif
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <h5 class="text-primary">Luas Wilayah</h5>
                                                    <input id="title" name="luas_wilayah" type="text" class="form-control" placeholder="Luas Wilayah" value="{{ $data->luas_wilayah }}"/>
                                                    @if ($errors->has('luas_wilayah'))<span class="text-danger">{{$errors->first('luas_wilayah')}}</span>@endif
                                                </div>
                                                <div class="form-group">
                                                    <h5 class="text-primary">Jumlah Kecamatan</h5>
                                                    <input id="title" name="jumlah_kecamatan" type="number" class="form-control" placeholder="Jumlah Kecamatan" value="{{ $data->jumlah_kecamatan }}"/>
                                                    @if ($errors->has('jumlah_kecamatan'))<span class="text-danger">{{$errors->first('jumlah_kecamatan')}}</span>@endif
                                                </div>
                                                <div class="form-group">
                                                    <h5 class="text-primary">Jumlah Kelurahan</h5>
                                                    <input id="title" name="jumlah_kelurahan" type="number" class="form-control" placeholder="Jumlah Kelurahan" value="{{ $data->jumlah_kelurahan }}"/>
                                                    @if ($errors->has('jumlah_kelurahan'))<span class="text-danger">{{$errors->first('jumlah_kelurahan')}}</span>@endif
                                                </div>
                                                <div class="form-group mb-2">
                                                    <h5 class="text-primary">Jumlah Desa</h5>
                                                    <input id="title" name="jumlah_desa" type="number" class="form-control" placeholder="Jumlah Desa" value="{{ $data->jumlah_desa }}"/>
                                                    @if ($errors->has('jumlah_desa'))<span class="text-danger">{{$errors->first('jumlah_desa')}}</span>@endif
                                                </div>
                                                <div class="form-group mb-2">
                                                    <h5 class="text-primary">IMAGE</h5>
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
                                                <div class="form-group border rounded p-1">
                                                    <h5 class="text-primary">STATUS</h5>
                                                    <div class="d-flex flex-row">
                                                        <div class="custom-control custom-radio">
                                                            <input name="status" type="radio" id="customRadio4" class="custom-control-input" value="1" {{ ($data->status == 1 ? 'checked' : '') }}/>
                                                            <label class="custom-control-label" for="customRadio4">Terbit</label>
                                                        </div>
                                                        <div class="custom-control custom-radio ml-2">
                                                            <input name="status" type="radio" id="customRadio5" class="custom-control-input" value="2" {{ ($data->status == 2 ? 'checked' : '') }}/>
                                                            <label class="custom-control-label" for="customRadio5">Tidak</label>
                                                        </div>
                                                    </div>
                                                    @if ($errors->has('status'))<span class="text-danger">{{$errors->first('status')}}</span>@endif
                                                </div>
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
                    </div>
                </section>
            </div>
        </div>
    </div>

    @include('admin.components.imagecrop')
    @include('admin.components.slug')
    @include('admin.components.texteditor-simple')

    @push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.css')}}">
    @endpush

    @push('scripts')
    <script src="{{asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>
    <script>
        $(function () {
            var changePicture = $('#change-picture'),
                userAvatar = $('.user-avatar'),
                languageSelect = $('#users-language-select2'),
                form = $('.form-validate'),
                birthdayPickr = $('.birthdate-picker');

            // Change user profile picture
            if (changePicture.length) {
                $(changePicture).on('change', function (e) {
                var reader = new FileReader(),
                    files = e.target.files;
                reader.onload = function () {
                    if (userAvatar.length) {
                    userAvatar.attr('src', reader.result);
                    }
                };
                reader.readAsDataURL(files[0]);
                });
            }
        });
    </script>
    @endpush
</x-master-layout>

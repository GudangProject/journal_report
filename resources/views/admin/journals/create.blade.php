<x-master-layout>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-7 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h3 class="content-header-title float-left mb-0">Jurnal</h3>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('journals.index') }}">List Jurnal</a>
                                    </li>
                                    <li class="breadcrumb-item active">Create</li>
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
                                <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('journals.store') }}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 col-12">

                                                <div class="form-group">
                                                    <h5 class="text-primary">NAMA JURNAL</h5>
                                                    <input id="nama_jurnal" name="nama_jurnal" type="text" class="form-control" placeholder="Judul Jurnal" value="{{ old('nama_jurnal') }}"/>
                                                    @if ($errors->has('nama_jurnal'))<span class="text-danger">{{$errors->first('nama_jurnal')}}</span>@endif
                                                </div>

                                            </div>
                                            <div class="col-md-6 col-12">

                                                <div class="form-group">
                                                    <h5 class="text-primary">VOLUME</h5>
                                                    <input id="volume" name="volume" type="text" class="form-control" placeholder="Volume Jurnal" value="{{ old('volume') }}"/>
                                                    @if ($errors->has('volume'))<span class="text-danger">{{$errors->first('volume')}}</span>@endif
                                                </div>

                                            </div>
                                            <div class="col-md-6 col-12">

                                                <div class="form-group">
                                                    <h5 class="text-primary">JUMLAH NASKAH</h5>
                                                    <div class="input-group input-group-lg">
                                                        <input type="number" name="jumlah_naskah" class="touchspin" value="0" />
                                                        @if ($errors->has('jumlah_naskah'))<span class="text-danger">{{$errors->first('jumlah_naskah')}}</span>@endif

                                                    </div>
                                                </div>

                                            </div>
                                            {{-- <div class="col-md-4 col-12">
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
                                                <div class="form-group">
                                                    <h5 class="text-primary">CAPTION</h5>
                                                    <textarea name="caption" class="form-control" rows="2" placeholder="Caption Image">{{ old('caption') }}</textarea>
                                                    @if ($errors->has('caption'))<span class="text-danger">{{$errors->first('caption')}}</span>@endif
                                                </div>

                                                <div class="form-group">
                                                    <h5 class="text-primary">AUTHOR</h5>
                                                    @foreach($authors as $k=>$v)
                                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                                            <label for="{{$k}}">{{$v['name']}}</label>
                                                            <select name="author[{{$k}}]" class="form-control form-control-sm" style="width: 65%" @if($k == 'e') @endif>
                                                                <option value="">Pilih {{$v['name']}}</option>
                                                                @foreach($v['data'] as $a=>$b)
                                                                    <option op="{{$k}}" value="{{$b['id']}}" {{ ($b['id'] == auth()->user()->id ? 'selected' : '') }}
                                                                    >{{$b['name']}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="form-group">
                                                    <h5 class="text-primary">TAGS</h5>
                                                    <input name="tags" type="text" class="form-control" placeholder="tags1, tags2" value="{{ old('caption') }}"/>
                                                    @if ($errors->has('tags'))<span class="text-danger">{{$errors->first('tags')}}</span>@endif
                                                </div>

                                                <div class="form-group border rounded p-1">
                                                    <h5 class="text-primary">TYPE</h5>
                                                    <div class="d-flex flex-row">
                                                        <div class="custom-control custom-radio">
                                                            <input name="type" type="radio" id="customRadio2" class="custom-control-input" value="1" checked/>
                                                            <label class="custom-control-label" for="customRadio2">NORMAL</label>
                                                        </div>
                                                        <div class="custom-control custom-radio ml-2">
                                                            <input name="type" type="radio" id="customRadio3" class="custom-control-input" value="2"/>
                                                            <label class="custom-control-label" for="customRadio3">SLIDE/HEADLINE</label>
                                                        </div>
                                                    </div>
                                                    @if ($errors->has('type'))<span class="text-danger">{{$errors->first('type')}}</span>@endif
                                                </div>

                                                <div class="form-group border rounded p-1">
                                                    <h5 class="text-primary">STATUS</h5>
                                                    <div class="d-flex flex-row">
                                                        <div class="custom-control custom-radio">
                                                            <input name="status" type="radio" id="customRadio4" class="custom-control-input" value="1" checked/>
                                                            <label class="custom-control-label" for="customRadio4">Terbit</label>
                                                        </div>
                                                        <div class="custom-control custom-radio ml-2">
                                                            <input name="status" type="radio" id="customRadio5" class="custom-control-input" value="2"/>
                                                            <label class="custom-control-label" for="customRadio5">Tidak</label>
                                                        </div>
                                                    </div>
                                                    @if ($errors->has('status'))<span class="text-danger">{{$errors->first('status')}}</span>@endif
                                                </div>

                                                <div class="form-group border rounded p-1">
                                                    <button type="submit" class="btn btn-primary mr-1">Simpan</button>
                                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                                </div>
                                            </div> --}}
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
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    @include('admin.components.imagecrop')
    @include('admin.components.slug')
    @include('admin.components.texteditor')

    @push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.css')}}">
    @endpush

    @push('scripts')
    <script src="{{asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/forms/form-number-input.js')}}"></script>
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

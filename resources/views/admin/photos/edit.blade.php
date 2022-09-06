<x-master-layout>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-7 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h3 class="content-header-title float-left mb-0">Edit Photos</h3>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('photos.index') }}">List Photo</a>
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
                                <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('photos.update', $data->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8 col-12">

                                                <div class="form-group">
                                                    <h5 class="text-primary">JUDUL</h5>
                                                    <input id="title" name="title" type="text" class="form-control" placeholder="Judul Image" value="{!! $data->title !!}"/>
                                                    @if ($errors->has('title'))<span class="text-danger">{{$errors->first('title')}}</span>@endif
                                                </div>
                                                <div class="form-group">
                                                    <h5 class="text-primary">SLUG</h5>
                                                    <div class="alert alert-primary" role="alert">
                                                        <div class="alert-body"><strong id="text-slug"> {{ old('slug') }}</strong></div>
                                                    </div>
                                                    <span id="input-slug" style="display:none;">
                                                        <input name="slug" type="text" id="slug" class="form-control mb-1" value="{{ $data->slug }}"/>
                                                        <button type="button" class="btn btn-primary btn-xs" id="simpan_slug">OK</button>
                                                        <button type="button" class="btn btn-secondary btn-xs" id="close_slug">Cancel</button>
                                                    </span>
                                                    @if ($errors->has('slug'))<span class="text-danger">{{$errors->first('slug')}}</span>@endif
                                                </div>
                                                <div class="form-group">
                                                    <h5 class="text-primary">DESCRIPTION</h5>
                                                    <textarea name="content" class="form-control">{{ $data->content }}</textarea>
                                                    @if ($errors->has('description'))<span class="text-danger">{{$errors->first('description')}}</span>@endif
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">

                                                <div class="form-group form-group border rounded p-1">
                                                    <h5 class="text-primary">IMAGE</h5>
                                                    <div class="custom-file text-center">
                                                        <img name="image" src="{{ $data->image }}" alt="users avatar" class="user-avatar users-avatar-shadow rounded my-25 cursor-pointer" width="100%" />
                                                        <div class="media-body mt-50">
                                                            <label class="btn btn-primary mb-0" for="change-picture">
                                                                <span class="d-none d-sm-block">Pilih Image</span>
                                                                <input class="form-control" name="image" type="file" id="change-picture" hidden/>
                                                                <span class="d-block d-sm-none">
                                                                    <i class="mr-0" data-feather="edit"></i>
                                                                </span>
                                                            </label>
                                                        </div>
                                                        @if ($errors->has('image'))
                                                        <span class="text-danger">
                                                            {{ $errors->first('image') }}
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5 class="text-primary">CAPTION</h5>
                                                    <textarea name="caption" class="form-control">{{ $data->caption }}</textarea>
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
                                                                    <option op="{{$k}}" value="{{$b['id']}}" {{ ($b['id'] == $v['id'] ? 'selected' : '') }}>{{$b['name']}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @endforeach
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
    @include('admin.components.texteditor')

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

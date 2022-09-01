<x-master-layout>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-7 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h3 class="content-header-title float-left mb-0">Edit Video</h3>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('videos.index') }}">List Video</a>
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
                                <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('videos.update', $data->id) }}">
                                    @method('PUT')
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8 col-12">
                                                <div class="form-group">
                                                    <h5 class="text-primary">TANGGAL PUBLISH</h5>
                                                    <input name="published_at" type="text" class="form-control flatpickr-date-time" placeholder="Tanggal Publish Video" value="{{ $data->created_at }}" />
                                                    @if ($errors->has('created_at'))<span class="text-danger">{{$errors->first('created_at')}}</span>@endif
                                                </div>
                                                <div class="form-group">
                                                    <h5 class="text-primary">JUDUL</h5>
                                                    <input id="title" name="title" type="text" class="form-control" placeholder="Judul Video" value="{{ $data->title }}"/>
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
                                                            @if ($item->parent_id == 0)
                                                            <option value="{{ $item->id }}" {{ ($item->id == $data->category_id ? 'selected' : '') }}>-- {{ $item->name }} --</option>
                                                                @foreach ($categories as $value)
                                                                    @if ($value->parent_id == $item->id)
                                                                    <option value="{{ $value->id }}" {{ ($value->id == $data->category_id ? 'selected' : '') }}>{{ $value->name }}</option>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('category_id'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('category_id') }}
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <h5 class="text-primary">CONTENT</h5>
                                                    <textarea name="content" id="content" class="form-control">{{ $data->content }}</textarea>
                                                    @if ($errors->has('content'))<span class="text-danger">{{$errors->first('content')}}</span>@endif
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="form-group border rounded p-1">
                                                    <h5 class="text-primary">YOUTUBE ID</h5>
                                                    <input id="youtube_id" name="youtube_id" type="text" class="form-control" name="fname-column" value="{{ $data->youtube_id }}"/>
                                                    @if ($errors->has('youtube_id'))<span class="text-danger">{{$errors->first('youtube_id')}}</span>@endif
                                                    <div class="embed-responsive embed-responsive-16by9 mt-1">
                                                        <iframe id="frame_video" class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $data->youtube_id }}?rel=0" allowfullscreen></iframe>
                                                    </div>
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

                                                <div class="form-group">
                                                    <h5 class="text-primary">TAGS</h5>
                                                    <input name="tags" type="text" class="form-control" placeholder="tags1, tags2" value="{{ $data->tags }}"/>
                                                    @if ($errors->has('tags'))<span class="text-danger">{{$errors->first('tags')}}</span>@endif
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

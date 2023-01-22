<x-master-layout>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-7 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h3 class="content-header-title float-left mb-0">Berita</h3>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('posts.index') }}">List Berita</a>
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
                                <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('posts.update', $data->id) }}">
                                    @method('PUT')
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8 col-12">

                                                <div class="row col-6 form-group">
                                                    <h5 class="text-primary">TANGGAL PUBLISH</h5>
                                                    <input name="published_at" type="text" class="form-control flatpickr-date-time" placeholder="Tanggal Publish Berita" value="{{ $data->published_at }}" />
                                                    @if ($errors->has('published_at'))<span class="text-danger">{{$errors->first('published_at')}}</span>@endif
                                                </div>

                                                <div class="form-group">
                                                    <h5 class="text-primary">PREFIX <span class="text-danger">(opsional)</span></h5>
                                                    <input name="prefix" type="text" class="form-control" placeholder="Prefix Berita" value="{{ $data->prefix }}"/>
                                                    @if ($errors->has('prefix'))<span class="text-danger">{{$errors->first('prefix')}}</span>@endif
                                                </div>

                                                <div class="form-group">
                                                    <h5 class="text-primary">JUDUL</h5>
                                                    <input id="title" name="title" type="text" class="form-control" placeholder="Judul Berita" value="{{ $data->title }}"/>
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
                                                    <h5 class="text-primary">PREVIEW</h5>
                                                    <textarea name="preview" id="preview" class="form-control">{{ $data->preview }}</textarea>
                                                    @if ($errors->has('preview'))<span class="text-danger">{{$errors->first('preview')}}</span>@endif
                                                </div>

                                                <div class="form-group">
                                                    <h5 class="text-primary">CONTENT</h5>
                                                    <textarea name="content" id="content" class="form-control">{{ $data->content }}</textarea>
                                                    @if ($errors->has('content'))<span class="text-danger">{{$errors->first('content')}}</span>@endif
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
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
                                                    <textarea name="caption" class="form-control" rows="2" placeholder="Caption Image">{{ $data->caption }}</textarea>
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

                                                <div class="form-group">
                                                    <h5 class="text-primary">TAGS</h5>
                                                    <input name="tags" type="text" class="form-control" placeholder="tags1, tags2" value="{{ $data->tags }}"/>
                                                    @if ($errors->has('tags'))<span class="text-danger">{{$errors->first('tags')}}</span>@endif
                                                </div>

                                                <input name="type" type="radio" id="customRadio2" class="custom-control-input" value="1" checked hidden/>

                                                <input name="status" type="radio" id="customRadio5" class="custom-control-input" value="2" checked hidden/>


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

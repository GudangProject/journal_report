<x-master-layout>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-7 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h3 class="content-header-title float-left mb-0">Tambah Photo</h3>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('photos.index') }}">List Photo</a>
                                    </li>
                                    <li class="breadcrumb-item active">Tambah Terkait</li>
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
                                <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('photos-content.store') }}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8 col-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="mb-0">{{ $dataParent->title }}</h5>
                                                        <div class="row mt-2">
                                                            <div class="col-md-4 col-6 mb-1 profile-latest-img">
                                                                <a href="{{ $dataParent->image }}" data-fancybox="gallery-a" data-fancybox data-type="image" data-caption="{{ $dataParent->caption }}">
                                                                    <img src="{{ $dataParent->image }}" class="img-fluid rounded" alt="avatar img" />
                                                                </a>
                                                            </div>
                                                            @foreach ($photoLinkage as $item)
                                                            <div class="col-md-4 col-6 profile-latest-img">
                                                                <a href="{{ $item->image }}" data-fancybox="gallery-a" data-fancybox data-type="image" data-caption="{{ $item->caption }}">
                                                                    <img src="{{ $item->image }}" class="img-fluid rounded" alt="avatar img" />
                                                                </a>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <input type="hidden" name="parent_id" value="{{ $dataParent->id }}">
                                                <div class="form-group form-group border rounded p-1">
                                                    <h5 class="text-primary">IMAGE</h5>
                                                    <div class="custom-file text-center">
                                                        <img name="image" src="{{ asset('assets/images/dummy-image.jpeg') }}" alt="users avatar" class="user-avatar users-avatar-shadow rounded my-25 cursor-pointer" width="100%" />
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
                                                    <textarea name="caption" class="form-control">{{ old('caption') }}</textarea>
                                                    @if ($errors->has('caption'))<span class="text-danger">{{$errors->first('caption')}}</span>@endif
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

    {{-- fancy Box --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" type="text/css" media="screen" />
    @endpush
</x-master-layout>

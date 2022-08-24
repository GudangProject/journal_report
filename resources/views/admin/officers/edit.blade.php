<x-master-layout>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-7 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h3 class="content-header-title float-left mb-0">Edit Struktur Organisasi</h3>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('officers.index') }}">Struktur Organisasi</a>
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
                                <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('officers.update', $data->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8 col-12">

                                                <div class="form-group">
                                                    <h5 class="text-primary">NAMA LENGKAP</h5>
                                                    <input id="name" name="name" type="text" class="form-control" placeholder="Nama dan Gelar jika ada" value="{{ $data->name }}"/>
                                                    @if ($errors->has('name'))<span class="text-danger">{{$errors->first('name')}}</span>@endif
                                                </div>

                                                <div class="form-group">
                                                    <h5 class="text-primary">JABATAN</h5>
                                                    <textarea name="preview" id="preview" class="form-control">{{ $data->position }}</textarea>
                                                    @if ($errors->has('preview'))<span class="text-danger">{{$errors->first('preview')}}</span>@endif
                                                </div>

                                                <div class="form-group">
                                                    <h5 class="text-primary">BIO DATA</h5>
                                                    <textarea name="content" id="content" class="form-control">{!! $data->description !!}</textarea>
                                                    @if ($errors->has('content'))<span class="text-danger">{{$errors->first('content')}}</span>@endif
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="form-group mb-2">
                                                    <h5 class="text-primary">PHOTO</h5>
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

@push('style-components')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/bootstrap-fileinput/css/fileinput.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/cropperjs/cropper.css') }}">
@endpush

@push('script-components')
<script src="{{ asset('app-assets/vendors/bootstrap-fileinput/js/fileinput.js') }}"></script>
<script src="{{ asset('app-assets/vendors/cropperjs/cropper.js') }}"></script>
<script type="text/javascript">
    $("#image-crop").fileinput({
        showCaption: false,
        showUpload: false,
        dropZoneEnabled: true,
        fileActionSettings: false,
        maxImageWidth: '2100',
        maxImageHeight: '2100',
        browseLabel: "Pilih Image",
        mainClass: "input-group",
        defaultPreviewContent: '<img src="{{ $data->images['medium'] ?? '/assets/images/dummy-image.jpeg'}}" style="width:100%;" alt="default">',
        browseIcon: "<i class=\"fa fa-picture-o\"></i> ",
        allowedFileExtensions: ["jpg", "png", "gif", "jpeg", "svg"]
    }).on('fileloaded', function(event, file, previewId, index, reader){
        var t_file = file.type;
        if(t_file){
            var img = new Image();
            img.src = reader.result;
            img.onload = (e) => {
                width = e.target.naturalWidth;
                height = e.target.naturalHeight;

                if(width > 1700 || height > 1700){
                    alert('dimension image terlalu besar');
                    $("#image-crop").fileinput('clear');
                }else{
                    var fileImg = reader.result;

                    $('#16-9-show').attr("src", fileImg);
                    $('#4-3-show').attr("src", fileImg);
                    $('#1-1-show').attr("src", fileImg);

                    const image16_9         = document.getElementById('16-9-show');
                    var previews16_9        = document.getElementById('preview-16-9');
                    var preview16_9Ready    = false;

                    var cropper16_9       = new Cropper(image16_9, {
                        ready: function(){
                            var clone = this.cloneNode();
                            clone.className = '';
                            clone.style.cssText = (
                                'display: block;' +
                                'width: 178px;' +
                                'min-width: 0;' +
                                'min-height: 0;' +
                                'max-width: none;' +
                                'max-height: none;'
                            );
                            previews16_9.appendChild(clone.cloneNode());
                            var cropBoxData = cropper16_9.getCropBoxData();
                            var imageData   = cropper16_9.getImageData();
                            var data        = cropper16_9.getData();

                            var previewAspectRatio = data.width / data.height;
                            var previewImage = previews16_9.getElementsByTagName('img').item(0);
                            var previewWidth = 178;
                            var previewHeight = previewWidth / previewAspectRatio;
                            var imageScaledRatio = data.width / previewWidth;

                            previews16_9.style.height = previewHeight + 'px';
                            previewImage.style.width = imageData.naturalWidth / imageScaledRatio + 'px';
                            previewImage.style.height = imageData.naturalHeight / imageScaledRatio + 'px';
                            previewImage.style.marginLeft = -data.x / imageScaledRatio + 'px';
                            previewImage.style.marginTop = -data.y / imageScaledRatio + 'px';

                            $('#16_9_width').val(data.width);
                            $('#16_9_height').val(data.height);
                            $('#16_9_x').val(data.x);
                            $('#16_9_y').val(data.y);

                            preview16_9Ready = true;
                        },
                        crop: function(event) {
                            if (!preview16_9Ready) {
                                return;
                            }
                            var data = event.detail;
                            var imageData = cropper16_9.getImageData();
                            var previewAspectRatio = data.width / data.height;

                            var previewImage = previews16_9.getElementsByTagName('img').item(0);
                            var previewWidth = previews16_9.offsetWidth;
                            var previewHeight = previewWidth / previewAspectRatio;
                            var imageScaledRatio = data.width / previewWidth;

                            previews16_9.style.height = previewHeight + 'px';
                            previewImage.style.width = imageData.naturalWidth / imageScaledRatio + 'px';
                            previewImage.style.height = imageData.naturalHeight / imageScaledRatio + 'px';
                            previewImage.style.marginLeft = -data.x / imageScaledRatio + 'px';
                            previewImage.style.marginTop = -data.y / imageScaledRatio + 'px';

                            $('#16_9_width').val(event.detail.width);
                            $('#16_9_height').val(event.detail.height);
                            $('#16_9_x').val(event.detail.x);
                            $('#16_9_y').val(event.detail.y);
                        },
                        responsive: true,
                        rotatable: false,
                        scalable: false,
                        zoomable: false,
                        zoomOnTouch: false,
                        zoomOnWheel: false,
                        viewMode: 1,
                        minContainerWidth: 480,
                        minContainerHeight: 250,
                        aspectRatio: 16 / 9,
                    });
                    const image4_3 = document.getElementById('4-3-show');
                    var previews4_3        = document.getElementById('preview-4-3');
                    var preview4_3Ready    = false;
                    var cropper4_3 = new Cropper(image4_3, {
                        ready: function(event){
                            var clone = this.cloneNode();
                            clone.className = '';
                            clone.style.cssText = (
                                'display: block;' +
                                'width: 178px;' +
                                'min-width: 0;' +
                                'min-height: 0;' +
                                'max-width: none;' +
                                'max-height: none;'
                            );

                            previews4_3.appendChild(clone.cloneNode());
                            var cropBoxData = cropper4_3.getCropBoxData();
                            var imageData   = cropper4_3.getImageData();
                            var data        = cropper4_3.getData();

                            var previewAspectRatio = data.width / data.height;
                            var previewImage = previews4_3.getElementsByTagName('img').item(0);
                            var previewWidth = 178;
                            var previewHeight = previewWidth / previewAspectRatio;
                            var imageScaledRatio = data.width / previewWidth;

                            previews4_3.style.height = previewHeight + 'px';
                            previewImage.style.width = imageData.naturalWidth / imageScaledRatio + 'px';
                            previewImage.style.height = imageData.naturalHeight / imageScaledRatio + 'px';
                            previewImage.style.marginLeft = -data.x / imageScaledRatio + 'px';
                            previewImage.style.marginTop = -data.y / imageScaledRatio + 'px';

                            $('#4_3_width').val(data.width);
                            $('#4_3_height').val(data.height);
                            $('#4_3_x').val(data.x);
                            $('#4_3_y').val(data.y);

                            preview4_3Ready = true;
                        },
                        crop: function(event) {
                            if (!preview4_3Ready) {
                                return;
                            }
                            var data = event.detail;
                            var imageData = cropper4_3.getImageData();
                            var previewAspectRatio = data.width / data.height;

                            var previewImage = previews4_3.getElementsByTagName('img').item(0);
                            var previewWidth = previews4_3.offsetWidth;
                            var previewHeight = previewWidth / previewAspectRatio;
                            var imageScaledRatio = data.width / previewWidth;

                            previews4_3.style.height = previewHeight + 'px';
                            previewImage.style.width = imageData.naturalWidth / imageScaledRatio + 'px';
                            previewImage.style.height = imageData.naturalHeight / imageScaledRatio + 'px';
                            previewImage.style.marginLeft = -data.x / imageScaledRatio + 'px';
                            previewImage.style.marginTop = -data.y / imageScaledRatio + 'px';

                            $('#4_3_width').val(event.detail.width);
                            $('#4_3_height').val(event.detail.height);
                            $('#4_3_x').val(event.detail.x);
                            $('#4_3_y').val(event.detail.y);
                        },
                        responsive: true,
                        rotatable: false,
                        scalable: false,
                        zoomable: false,
                        zoomOnTouch: false,
                        zoomOnWheel: false,
                        viewMode: 1,
                        minContainerWidth: 480,
                        minContainerHeight: 250,
                        aspectRatio: 4 / 3,
                    });
                    const image1_1 = document.getElementById('1-1-show');
                    var previews1_1        = document.getElementById('preview-1-1');
                    var preview1_1Ready    = false;
                    var cropper1_1 = new Cropper(image1_1, {
                        ready: function(event){
                            var clone = this.cloneNode();
                            clone.className = '';
                            clone.style.cssText = (
                                'display: block;' +
                                'width: 178px;' +
                                'min-width: 0;' +
                                'min-height: 0;' +
                                'max-width: none;' +
                                'max-height: none;'
                            );
                            previews1_1.appendChild(clone.cloneNode());
                            var cropBoxData = cropper1_1.getCropBoxData();
                            var imageData   = cropper1_1.getImageData();
                            var data        = cropper1_1.getData();

                            var previewAspectRatio = data.width / data.height;
                            var previewImage = previews1_1.getElementsByTagName('img').item(0);
                            var previewWidth = 178;
                            var previewHeight = previewWidth / previewAspectRatio;
                            var imageScaledRatio = data.width / previewWidth;

                            previews1_1.style.height = previewHeight + 'px';
                            previewImage.style.width = imageData.naturalWidth / imageScaledRatio + 'px';
                            previewImage.style.height = imageData.naturalHeight / imageScaledRatio + 'px';
                            previewImage.style.marginLeft = -data.x / imageScaledRatio + 'px';
                            previewImage.style.marginTop = -data.y / imageScaledRatio + 'px';

                            $('#1_1_width').val(data.width);
                            $('#1_1_height').val(data.height);
                            $('#1_1_x').val(data.x);
                            $('#1_1_y').val(data.y);

                            preview1_1Ready = true;
                        },
                        crop: function(event) {
                            if (!preview1_1Ready) {
                                return;
                            }
                            var data = event.detail;
                            var imageData = cropper1_1.getImageData();
                            var previewAspectRatio = data.width / data.height;

                            var previewImage = previews1_1.getElementsByTagName('img').item(0);
                            var previewWidth = previews1_1.offsetWidth;
                            var previewHeight = previewWidth / previewAspectRatio;
                            var imageScaledRatio = data.width / previewWidth;

                            previews1_1.style.height = previewHeight + 'px';
                            previewImage.style.width = imageData.naturalWidth / imageScaledRatio + 'px';
                            previewImage.style.height = imageData.naturalHeight / imageScaledRatio + 'px';
                            previewImage.style.marginLeft = -data.x / imageScaledRatio + 'px';
                            previewImage.style.marginTop = -data.y / imageScaledRatio + 'px';

                            $('#1_1_width').val(event.detail.width);
                            $('#1_1_height').val(event.detail.height);
                            $('#1_1_x').val(event.detail.x);
                            $('#1_1_y').val(event.detail.y);
                        },
                        responsive: true,
                        rotatable: false,
                        scalable: false,
                        zoomable: false,
                        zoomOnTouch: false,
                        zoomOnWheel: false,
                        viewMode: 1,
                        minContainerWidth: 480,
                        minContainerHeight: 250,
                        aspectRatio: 1 / 1,
                    });
                    $('#modal-image-crop').modal({
                        show: true,
                        keyboard: false,
                        backdrop: 'static'
                    }).on('hidden.bs.modal', function (e) {

                        $('#preview-16-9').html('');
                        var preview16_9Ready    = false;
                        $('#16-9-show').attr('src','#');
                        cropper16_9.destroy();

                        $('#preview-4-3').html('');
                        var preview4_3Ready    = false;
                        $('#4-3-show').attr('src','#');
                        cropper4_3.destroy();

                        $('#preview-1-1').html('');
                        var preview1_1Ready    = false;
                        $('#1-1-show').attr('src','#');
                        cropper1_1.destroy();

                        $('.cropper-container').remove();
                    });
                    $('#onClose').on('click', function(){
                        $('#modal-image-crop').modal('hide');

                        $('#preview-16-9').html('');
                        var preview16_9Ready    = false;
                        $('#16_9_width').val('');
                        $('#16_9_height').val('');
                        $('#16_9_x').val('');
                        $('#16_9_y').val('');

                        $('#16-9-show').attr('src','#');
                        cropper16_9.destroy();

                        $('#preview-4-3').html('');
                        var preview4_3Ready    = false;
                        $('#4_3_width').val('');
                        $('#4_3_height').val('');
                        $('#4_3_x').val('');
                        $('#4_3_y').val('');
                        $('#4-3-show').attr('src','#');
                        cropper4_3.destroy();

                        $('#preview-1-1').html('');
                        var preview1_1Ready    = false;
                        $('#1_1_width').val('');
                        $('#1_1_height').val('');
                        $('#1_1_x').val('');
                        $('#1_1_y').val('');
                        $('#1-1-show').attr('src','#');
                        cropper1_1.destroy();

                        $('.cropper-container').remove();
                        $("#image-crop").fileinput('clear');
                    });
                    $('#closeAtas').on('click', function(){
                        $('#modal-image-crop').modal('hide');

                        $('#preview-16-9').html('');
                        var preview16_9Ready    = false;
                        $('#16_9_width').val('');
                        $('#16_9_height').val('');
                        $('#16_9_x').val('');
                        $('#16_9_y').val('');

                        $('#16-9-show').attr('src','#');
                        cropper16_9.destroy();

                        $('#preview-4-3').html('');
                        var preview4_3Ready    = false;
                        $('#4_3_width').val('');
                        $('#4_3_height').val('');
                        $('#4_3_x').val('');
                        $('#4_3_y').val('');
                        $('#4-3-show').attr('src','#');
                        cropper4_3.destroy();

                        $('#preview-1-1').html('');
                        var preview1_1Ready    = false;
                        $('#1_1_width').val('');
                        $('#1_1_height').val('');
                        $('#1_1_x').val('');
                        $('#1_1_y').val('');
                        $('#1-1-show').attr('src','#');
                        cropper1_1.destroy();

                        $('.cropper-container').remove();
                        $("#image-crop").fileinput('clear');
                    });
                }
            };
        }
    });
</script>
@endpush
</x-master-layout>

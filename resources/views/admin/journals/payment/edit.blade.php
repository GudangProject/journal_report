<x-master-layout>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-7 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h3 class="content-header-title float-left mb-0">Edit Pembayaran</h3>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('payment.index') }}">List Pembayaran</a>
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
                                <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('payment.update', $data->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <h5 class="text-primary">Pilih Jurnal</h5>
                                                    <select class="form-control" name="journal_id" required>
                                                        <optgroup label="Daftar Jurnal">
                                                            @foreach ($journals as $item)
                                                                <option value="{{ $item->id }}" {{ $item->id == $data->journal_id ? 'selected' : ''}} {{ $item->id != $data->journal_id ? 'disabled' : ''}}>{{ $item->name }}, Volume {{ $item->volume }} No. {{ $item->number }} {{ $item->month }} {{ $item->year }}, Semester: {{ $item->semester }}, Slot: {{ $item->total }}</option>
                                                            @endforeach
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-primary">Judul Naskah</td>
                                                            <th class="text-primary">Link Naskah</th>
                                                            <th class="text-primary"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="add-volume">
                                                        @foreach ($naskah as $item)
                                                            <tr>
                                                                <td>
                                                                    <input disabled type="text" name="manuscript_titlex" id="manuscript_title" class="form-control " autocomplete="off" placeholder="Judul Naskah" value="{{ $item->name }}" required>
                                                                </td>
                                                                <td>
                                                                    <input disabled type="text" name="manuscript_linkx" id="manuscript_link" class="form-control " autocomplete="off" placeholder="Link Naskah" value="{{ $item->link }}" required>
                                                                </td>
                                                                <td><a href="/admin/naskah/delete/{{ $item->id }}" class="btn btn-danger"><i class="fas fa-times"></i></a></td>
                                                            </tr>
                                                        @endforeach
                                                        <tr>
                                                            <td>
                                                                <input type="text" name="manuscript_title[]" id="manuscript_title" class="form-control " autocomplete="off" placeholder="Judul Naskah" value="">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="manuscript_link[]" id="manuscript_link" class="form-control " autocomplete="off" placeholder="Link Naskah" value="">
                                                            </td>
                                                            <td><button type="text" class="btn btn-success btn-add"><i class="fas fa-plus"></i></button></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <h5 class="text-primary">No Rekening</h5>
                                                    <input id="payer_rekening" name="payer_rekening" type="number" class="form-control" placeholder="No Rekening" value="{{ $data->payer_rekening }}" required/>
                                                    @error('payer_rekening') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <h5 class="text-primary">BANK</h5>
                                                    <input id="payer_bank" name="payer_bank" type="text" class="form-control" placeholder="BANK" value="{{ $data->payer_bank }}" required/>
                                                    @error('payer_bank') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <h5 class="text-primary">Nama</h5>
                                                    <input id="payer_name" name="payer_name" type="text" class="form-control" placeholder="Nama Pembayar" value="{{ $data->payer_name }}" required/>
                                                    @error('payer_name') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <h5 class="text-primary">Rekening Tujuan</h5>
                                                    <select class="form-control" name="mybank_id" required>
                                                        <optgroup label="Daftar rekening pembayaran">
                                                            @foreach ($mybank as $item)
                                                                <option value="{{ $item->id }}">{{ $item->no_rekening }} {{ $item->bank }} a.n {{ $item->owner }}</option>
                                                            @endforeach
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <h5 class="text-primary">Nominal Transfer</h5>
                                                    <div class="input-group">
                                                        <input type="number" name="price" class="form-control" value="{{ $data->price }}" required/>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-lg-4 col-xl-4 col-12">
                                                <h5 class="text-primary">Bukti Bayar</h5>
                                                <div class="form-group mb-2">
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
                                            <div class="col-md-12 col-12 mt-2">
                                                <div class="form-group">
                                                    <h5 class="text-primary">Ketetangan</h5>
                                                    <div class="input-group">
                                                        <textarea name="description" class="form-control" placeholder="Tulis keterangan pembayaran disini.">{{ $data->description }}</textarea>
                                                    </div>
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
                    </div>
                </section>
            </div>
        </div>
    </div>

    <div class="modal fade text-left" id="modal-image-crop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crop Image: Mohon sesuaikan semua ukurannya!</h5>
                    <button type="button" class="close" id="closeAtas" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col-12 d-flex justify-content-center">
                            <div class="img-container p-2 text-center">
                                <div id="preview-1-1" class="d-none"></div>
                                <h4 class="text-primary">Aspect Ratio 1:1</h4>
                                <img id="1-1-show">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Crop</button>
                    <button type="button" class="btn btn-secondary" aria-label="Close" id="onClose">Close</button>
                </div>
            </div>
        </div>
    </div>
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
            defaultPreviewContent: '<img src="{{ asset('storage/pictures/payment/big/'.$data->image) ?? '/assets/images/dummy-image.jpeg'}}" style="width:100%;" alt="default">',
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

                        // $('#16-9-show').attr("src", fileImg);
                        // $('#4-3-show').attr("src", fileImg);
                        $('#1-1-show').attr("src", fileImg);


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

    @push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/select/select2.min.css')}}">
    @endpush

    @push('scripts')
    <script src="{{asset('app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/forms/form-number-input.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/forms/form-select2.js')}}"></script>
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
    <script>
        $(document).ready(function() {
            $(".btn-add").click(function(e) {
                e.preventDefault();
                let html = '<tr>';
                html += '<td>';
                html += '<input type="text" name="manuscript_title[]" id="manuscript_title" class="form-control " autocomplete="off" placeholder="Judul Naskah" value="">';
                html += '</td>';
                html += '<td>';
                html += '<input type="text" name="manuscript_link[]" id="manuscript_link" class="form-control " autocomplete="off" placeholder="Link Naskah" value="">';
                html += '</td>';

                html += '<td><button type="text" class="btn btn-danger btn-remove"><i class="fas fa-times"></i></button></td>';
                html += '</tr>';
                $('#add-volume').append(html);
            });
            $(document).on('click', '.btn-remove', function(e) {
                e.preventDefault();
                $(this).parents('tr').remove();
                s
            })
        });
    </script>
    @endpush
</x-master-layout>

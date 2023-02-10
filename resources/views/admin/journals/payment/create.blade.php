<x-master-layout>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-7 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h3 class="content-header-title float-left mb-0">Tambah Pembayaran</h3>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('payment.index') }}">List Pembayaran</a>
                                    </li>
                                    <li class="breadcrumb-item active">Tambah</li>
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
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <div class="alert-body"><strong>Harap isi data seusuai nama kolom dan pastikan data sudah benar sebelum disimpan.</strong></div>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="card">
                                <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('payment.store') }}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <h5 class="text-primary">Pilih Jurnal</h5>
                                                    <select class="select2 form-control form-control-lg" name="journal_id" required>
                                                        @foreach ($journals as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}, Volume {{ $item->volume }} No. {{ $item->number }} {{ $item->month }} {{ $item->year }}, Semester: {{ $item->semester }}, Slot: {{ $item->total }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-primary">Judul Naskah</td>
                                                            <th class="text-primary">Nomor</th>
                                                            <th class="text-primary">Link Naskah</th>
                                                            <th class="text-primary"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="add-volume">
                                                        <tr>
                                                            <td>
                                                                <input type="hidden" name="created_by[]" id="created_by" class="form-control " autocomplete="off" value="{{ auth()->user()->id }}" required>
                                                                <input type="text" name="manuscript_title[]" id="manuscript_title" class="form-control " autocomplete="off" placeholder="Judul Naskah" value="" required>
                                                            </td>
                                                            <td>
                                                                <input type="text" name="manuscript_number[]" id="manuscript_number" class="form-control " autocomplete="off" placeholder="Nomor Naskah" value="" required>
                                                            </td>
                                                            <td>
                                                                <input type="text" name="manuscript_link[]" id="manuscript_link" class="form-control " autocomplete="off" placeholder="Link Naskah" value="" required>
                                                            </td>
                                                            <td><button type="text" class="btn btn-success btn-add"><i class="fas fa-plus"></i></button></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <h5 class="text-primary">No Rekening</h5>
                                                    <input id="payer_rekening" name="payer_rekening" type="text" class="form-control" placeholder="No Rekening" value="{{ old('payer_rekening') }}" required/>
                                                    @error('payer_rekening') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <h5 class="text-primary">BANK</h5>
                                                    <input id="payer_bank" name="payer_bank" type="text" class="form-control" placeholder="BANK" value="{{ old('payer_bank') }}" required/>
                                                    @error('payer_bank') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <h5 class="text-primary">Nama</h5>
                                                    <input id="payer_name" name="payer_name" type="text" class="form-control" placeholder="Nama Pembayar" value="{{ old('payer_name') }}" required/>
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
                                                        <input type="text" name="price" class="form-control numeral-mask" placeholder="10,000" value="{{ old('price') }}" id="numeral-formatting" />
                                                        {{-- <input type="number" name="price" class="form-control" value="{{ old('price') }}" required/> --}}

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
                                                    <h5 class="text-primary">Keterangan</h5>
                                                    <div class="input-group">
                                                        <textarea name="description" class="form-control" placeholder="Tulis keterangan pembayaran disini."></textarea>
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

    @include('admin.components.imagecropuser')
    @include('admin.components.slug')

    @push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/select/select2.min.css')}}">
    @endpush

    @push('scripts')
    <script src="{{asset('app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/forms/cleave/cleave.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/forms/cleave/addons/cleave-phone.us.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/forms/form-number-input.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/forms/form-select2.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/forms/form-input-mask.js')}}"></script>
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
                html += '<input type="hidden" name="created_by[]" id="created_by" class="form-control " autocomplete="off" value="{{ auth()->user()->id }}" required>';
                html += '<input type="text" name="manuscript_title[]" id="manuscript_title" class="form-control " autocomplete="off" placeholder="Judul Naskah" value="" required>';
                html += '</td>';
                html += '<td>';
                html += '<input type="text" name="manuscript_number[]" id="manuscript_number" class="form-control " autocomplete="off" placeholder="Nomor Naskah" value="" required>';
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

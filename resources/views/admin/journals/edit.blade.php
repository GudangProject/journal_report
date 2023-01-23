<x-master-layout>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-7 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h3 class="content-header-title float-left mb-0">Edit Jurnal</h3>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('journals.index') }}">List Jurnal</a>
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
                                <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('journals.update', $data->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <h5 class="text-primary">Rumpun Ilmu</h5>
                                                    <select class="select2 form-control" name="knowledge_id">
                                                        <option selected disabled>--Silahkan Pilih---</option>
                                                        @foreach ($knowledge as $item)
                                                            <option value="{{ $item->id }}" {{ $item->id == $data->knowledge_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">

                                                <div class="form-group">
                                                    <h5 class="text-primary">Nama Jurnal</h5>
                                                    <input id="name" name="name" type="text" class="form-control" placeholder="Judul Jurnal" value="{{ $data->name }}"/>
                                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>

                                            </div>

                                            <div class="col-md-12 col-12 mb-2">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-primary">Volume</td>
                                                            <th class="text-primary">Nomor</th>
                                                            <th class="text-primary">Bulan</th>
                                                            <th class="text-primary">Tahun</th>
                                                            <th class="text-primary">Semester</th>
                                                            <th class="text-primary">Link Issue</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <input type="text" name="volume" id="volume" class="form-control " autocomplete="off" placeholder="Volume" value="{{ $data->volume }}">
                                                                <div class="invalid-feedback"></div>
                                                            </td>
                                                            <td>
                                                                <input type="number" name="number" id="nomor" class="form-control " autocomplete="off" placeholder="Nomor" value="{{ $data->number }}">
                                                                <div class="invalid-feedback"></div>
                                                            </td>
                                                            <td>
                                                                <select name="month" class="form-control ">
                                                                    <option value="{{ $data->month }}" selected>{{ $data->month }}</option>
                                                                    <option value="Januari">Januari</option>
                                                                    <option value="Februari">Februari</option>
                                                                    <option value="Maret">Maret</option>
                                                                    <option value="April">April</option>
                                                                    <option value="Mei">Mei</option>
                                                                    <option value="Juni">Juni</option>
                                                                    <option value="Juli">Juli</option>
                                                                    <option value="Agustus">Agustus</option>
                                                                    <option value="September">September</option>
                                                                    <option value="Oktober">Oktober</option>
                                                                    <option value="Nopember">Nopember</option>
                                                                    <option value="Desember">Desember</option>
                                                                </select>
                                                                <div class="invalid-feedback"></div>
                                                            </td>
                                                            <td>
                                                                <select name="year" id="tahun" class="form-control ">
                                                                    <option value="{{ $data->year }}" selected>{{ $data->year }}</option>
                                                                    <option value="2020">2020</option>
                                                                    <option value="2021">2021</option>
                                                                    <option value="2022">2022</option>
                                                                    <option value="2023">2023</option>
                                                                    <option value="2024">2024</option>
                                                                    <option value="2025">2025</option>
                                                                    <option value="2026">2026</option>
                                                                    <option value="2027">2027</option>
                                                                    <option value="2028">2028</option>
                                                                </select>
                                                                <div class="invalid-feedback"></div>
                                                            </td>
                                                            <td>
                                                                <select name="semester" class="form-control ">
                                                                    <option value="{{ $data->semester }}" selected>{{ $data->semester }}</option>
                                                                    <option value="Ganjil">Ganjil</option>
                                                                    <option value="Genap">Genap</option>
                                                                </select>
                                                                <div class="invalid-feedback"></div>
                                                            <td>
                                                                <input type="text" name="link_issue" id="link_issue" class="form-control " autocomplete="off" placeholder="link_issue" value="{{ $data->link_issue }}">
                                                                <div class="invalid-feedback"></div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <h5 class="text-primary">Indexasi</h5>
                                                    <select name="indexasi" class="form-control ">
                                                        <option value="{{ $data->indexasi }}" selected>{{ $data->indexasi }}</option>
                                                        <option value="SINTA 1">SINTA 1</option>
                                                        <option value="SINTA 2">SINTA 2</option>
                                                        <option value="SINTA 3">SINTA 3</option>
                                                        <option value="SINTA 4">SINTA 4</option>
                                                        <option value="SINTA 5">SINTA 5</option>
                                                        <option value="SINTA 6">SINTA 6</option>
                                                        <option value="NASIONAL">NASIONAL</option>
                                                        <option value="INTERNASIONAL">INTERNASIONAL</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <h5 class="text-primary">Afiliasi</h5>
                                                    <input type="text" name="afiliate" id="afiliate" class="form-control " autocomplete="off" placeholder="Masukkan Afiliasi jurnal" value="{{ $data->afiliate }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <h5 class="text-primary">JUMLAH</h5>
                                                    <div class="input-group">
                                                        <input type="number" name="total" class="form-control" value="{{ $data->total }}"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <h5 class="text-primary">Pengelola Jurnal</h5>
                                                    <input type="text" name="manager_by" id="manager_by" class="form-control " autocomplete="off" placeholder="Nama pengelola jurnal" value="{{ $data->manager_by }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <h5 class="text-primary">Nomor Hp Pengelola</h5>
                                                    <div class="input-group">
                                                        <input type="text" name="manager_phone" class="form-control" value="{{ $data->phone_by }}"/>
                                                    </div>
                                                </div>
                                            </div>
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
    <script src="{{asset('app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
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
    <script>
        $(document).ready(function() {
            $(".btn-add").click(function(e) {
                e.preventDefault();
                let html = '<tr>';
                html += '<td>';
                html += '<input type="text" name="volume[]" id="volume" class="form-control " autocomplete="off" placeholder="Volume" value="">';
                html += ' <div class = "invalid-feedback"> </div>';
                html += '</td>';
                html += '<td>';
                html += '<input type="number" name="number[]" id="nomor" class="form-control " autocomplete="off" placeholder="Nomor" value="">';
                html += ' <div class = "invalid-feedback"> </div>';
                html += '</td>';
                html += '<td>';
                html += '<select name="month[]" id="bulan" class="form-control " autocomplete="off" placeholder="Bulan">';
                html += '<option selected disabled>--Silahkan Pilih---</option>';
                html += '<option value="Januari">Januari</option>';
                html += '<option value="Februari">Februari</option>';
                html += '<option value="Maret">Maret</option>';
                html += '<option value="April">April</option>';
                html += '<option value="Mei">Mei</option>';
                html += '<option value="Juni">Juni</option>';
                html += '<option value="Juli">Juli</option>';
                html += '<option value="Agustus">Agustus</option>';
                html += '<option value="September">September</option>';
                html += '<option value="Oktober">Oktober</option>';
                html += '<option value="Nopember">Nopember</option>';
                html += '<option value="Desember">Desember</option>';
                html += '</select>';
                html += '<div class="invalid-feedback"> </div>';
                html += '</td>';
                html += '<td>';
                html += '<select name="year[]" id="tahun" class="form-control " autocomplete="off" placeholder="Tahun">';
                html += '<option value="2020">2020</option>';
                html += '<option value="2021">2021</option>';
                html += '<option value="2022">2022</option>';
                html += '<option value="2023">2023</option>';
                html += '<option value="2024">2024</option>';
                html += '<option value="2025">2025</option>';
                html += '<option value="2026">2026</option>';
                html += '<option value="2027">2027</option>';
                html += '<option value="2028">2028</option>';
                html += '</select>';
                html += ' <div class="invalid-feedback"> </div>';
                html += '</td>';

                html += '<td>';
                html += '<select name="semester[]" class="form-control">';
                html += '<option selected disabled>--Silahkan Pilih---</option>';
                html += '<option value="Ganjil">Ganjil</option>';
                html += '<option value="Genap">Genap</option>';
                html += '</select>';
                html += ' <div class="invalid-feedback"> </div>';
                html += '</td>';


                html += '<td>';
                html += '<input type="text" name="link_issue[]" id="link_issue" class="form-control" autocomplete="off" placeholder="link_issue" value="">';
                html += ' <div class="invalid-feedback"> </div>';
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

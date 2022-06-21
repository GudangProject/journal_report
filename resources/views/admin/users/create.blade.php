<x-master-layout>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-7 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h3 class="content-header-title float-left mb-0">Menu</h3>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="/dashboard">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('users.index') }}">List User</a>
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
                                <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('users.store') }}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 col-12">

                                                <div class="form-group">
                                                    <h5 class="text-primary">NAMA</h5>
                                                    <input id="title" name="name" type="text" class="form-control" placeholder="Nama Lengkap" value="{{ old('title') }}" required/>
                                                    @if ($errors->has('title'))<span class="text-danger">{{$errors->first('title')}}</span>@endif
                                                </div>

                                                <div class="form-group">
                                                    <h5 class="text-primary">EMAIL</h5>
                                                    <input id="email" name="email" type="email" class="form-control" placeholder="cth :user@yahoo.com" value="{{ old('title') }}" required/>
                                                    @if ($errors->has('email'))<span class="text-danger">{{$errors->first('email')}}</span>@endif
                                                </div>

                                                <div class="form-group">
                                                    <h5 class="text-primary">KABUPATEN/KOTA</h5>
                                                    <select name="kota" class="form-control" id="basicSelect">
                                                        <option value="">--Pilih Kota--</option>
                                                        @foreach (config('app.kota') as $item)
                                                            <option value="{{ $item }}">{{ $item }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <h5 class="text-primary">ROLE</h5>
                                                    <select name="roles" class="form-control" id="basicSelect" required>
                                                        <option value="">-- PILIH --</option>
                                                        @foreach ($data['roles'] as $item)
                                                            <option value="{{ $item->name }}">{{ strtoupper($item->name) }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('roles'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('roles') }}
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <h5 class="text-primary">TYPE</h5>
                                                    <div class="d-flex flex-row">
                                                        @foreach (config('app.user_type') as $k=>$item)
                                                        <div class="custom-control custom-control-success custom-checkbox">
                                                            <input type="checkbox" name="user_type[]" value="{{ $k }}" class="custom-control-input" id="colorCheck{{ $k }}">
                                                            <label class="custom-control-label mr-1" for="colorCheck{{ $k }}">{{ $item }}</label>
                                                        </div>
                                                        @endforeach
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
    @endpush
</x-master-layout>

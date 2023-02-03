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
                                                    <h5 class="text-primary">Instansi</h5>
                                                    <input id="company" name="company" type="text" class="form-control" required/>
                                                    @if ($errors->has('company'))<span class="text-danger">{{$errors->first('company')}}</span>@endif
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

                                                <h5 class="text-primary">IMAGE</h5>
                                                <div class="col-md-4 col-12">
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
    @include('admin.components.imagecropuser')

    @push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.css')}}">
    @endpush

    @push('scripts')
    <script src="{{asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>
    @endpush
</x-master-layout>

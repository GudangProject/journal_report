@section('title')
    Edit Role Permission Setting -
@endsection
<x-master-layouts>
    @include('sweetalert::alert')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-7">
                            <h2 class="content-header-title float-left mb-0">Edit Role Setting</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="{{ route('role-permission.index') }}">Role</a>
                                    </li>
                                    <li class="breadcrumb-item active">Edit
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row" id="basic-table">
                    <div class="col-12">
                        <form action="{{ route('role-permission.update', $role->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card">
                                <div class="card-body">
                                    <h5>Name</h5>
                                    <input type="text" class="form-control mb-2" name="name" value="{{ $role->name }}">
                                    <h5>Permission Access</h5>
                                    <select class="select2 form-control" name="permission[]" multiple>
                                        <optgroup label="Permission">
                                            @foreach ($currentPermission as $permission)
                                                <option value="{{ $permission->id }}" selected>{{ $permission->name }}</option>
                                            @endforeach
                                            @foreach ($dataPermission as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                    <button type="submit" class="btn btn-primary mt-2">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



            @push('vendor-css')
            <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/vendors/css/vendors.min.css">
            <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/vendors/css/forms/select/select2.min.css">
            @endpush

            @push('page-vendor')
            <script src="{{ asset('assets') }}/vendors/js/forms/select/select2.full.min.js"></script>
            @endpush

            @push('page-js')
            <script src="{{ asset('assets') }}/js/scripts/forms/form-select2.js"></script>

                <script type="text/javascript">
                    $(document).ready(function () {
                        $('.ckeditor').ckeditor();
                    });
                </script>
            @endpush
        </div>
    </div>
</x-master-layouts>


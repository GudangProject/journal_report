@section('title')
    Role Permission Setting -
@endsection
<x-master-layouts>
    @include('sweetalert::alert')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            @livewire('setting.role-permission')
        </div>
    </div>
</x-master-layouts>

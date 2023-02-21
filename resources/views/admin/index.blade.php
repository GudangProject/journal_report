<x-master-layout>
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <section id="dashboard-analytics">
                    <div class="row match-height">
                        @include('admin.dashboard.badge-name')
                        @include('admin.dashboard.count_content')
                        {{-- @include('admin.dashboard.top_point') --}}
                    </div>
                    <div class="row match-height">
                        @include('admin.dashboard.posts_update')
                        {{-- @include('admin.dashboard.wiget') --}}
                    </div>

                </section>
            </div>
        </div>
    </div>
    @push('scripts')

        <script src="{{asset('app-assets')}}/vendors/js/extensions/toastr.min.js"></script>
        {{-- <script src="{{asset('app-assets/js/scripts/pages/dashboard-ecommerce.js')}}"></script> --}}

    @endpush
</x-master-layout>


<x-master-layout>
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Points</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('points.index')}}">List Points</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <a class="btn-icon btn btn-sm btn-outline-primary btn-round btn-md" href="{{route('settings.index')}}"> Setting Point</a>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <section id="all-post">
                    <form method="get" action="{{ route('points.index') }}">
                        <div class="d-flex justify-content-end align-items-end">
                            <div class="form-group mr-1">
                                <h5 class="text-primary">BULAN</h5>
                                <select name="month" class="form-control">
                                    @foreach($data['date']['month'] as $k=>$v)
                                        <option value="{{ $k }}" @if($k == $data['date_now']['month']) selected @endif>{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <h5 class="text-primary">TAHUN</h5>
                                <select name="year" class="form-control">
                                    @foreach($data['date']['years'] as $k=>$v)
                                        <option value="{{ $k }}" @if($k == $data['date_now']['year']) selected @endif>{{ $v }}&nbsp;&nbsp;</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group ml-1">
                                <button type="submit" class="btn-icon btn btn-primary btn-round btn-md">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="card card-company-table">
                        <div class="card-body p-0">
                            {{-- {{ $month .'+'. $year  }} --}}
                            <div wire:loading></div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Name</th>
                                        <th class="text-center">Post</th>
                                        <th class="text-center">Viewed</th>
                                        <th class="text-center">Point</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (isset($data['data']))

                                        @foreach ($data['data'] as $k=>$v)
                                        <tr>
                                            <td>
                                                {{ $k+1 }}
                                            </td>
                                            <td>
                                                <span class="font-weight-bold">{!! $v['name'] !!}</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="badge badge-primary">
                                                    <span>{{ $v['total_post'] }}</span>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="badge badge-primary">
                                                    <span>{{ $v['total_view']}}</span>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="badge badge-primary">
                                                    <span>{{ $v['total_point']}}</span>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="content-header-right">
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-chevron-circle-down font-medium-3"></i></button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a type="button" class="dropdown-item" href="#">
                                                                <i class="mr-1 fas fa-desktop"></i>
                                                                <span class="align-middle">Detail</span>
                                                            </a>
                                                            <a class="dropdown-item" target="_blank" href="#">
                                                                <i class="mr-1 fas fa-eye"></i>
                                                                <span class="align-middle">Web</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    @else
                                    <tr>
                                        <td colspan="6"> Data Point tidak ditemukan !</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>

                </section>
            </div>
        </div>
    </div>
</x-master-layout>

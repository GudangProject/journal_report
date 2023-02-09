<div class="col-xl-8 col-md-8 col-12">
    <div class="card card-company-table">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Nama Jurnal</th>
                        <th>Rumpun Ilmu</th>
                        <th>Volume</th>
                        <th>Slot</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if (isset($data['journal']))
                            @foreach ($data['journal'] as $k=>$v)
                                <tr>
                                    <td>{!! $v->name !!}</td>
                                    <td>
                                        <div class="badge badge-light-primary">{{ $v->knowledge->name }}</div>
                                    </td>
                                    <td>
                                        <span class="text-primary font-italic">{{ $v->volume }} No. {{ $v->number }}, {{ $v->month }} {{ $v->year }}, Semester: {{ $v->semester }}</div>
                                    </td>
                                    <td class="text-nowrap">
                                        <div class="d-flex align-items-center">
                                            <span class="font-weight-bolder mr-1">
                                                {{ $v->total }}
                                            </span>
                                            <i data-feather="trending-up" class="text-success font-medium-1"></i>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-4 col-md-4 col-12">
    <div class="card card-browser-states">
        <div class="card-header">
            <div>
                <h4 class="card-title">Top Rank Point</h4>
                {{-- <p class="card-text font-small-2">Counter August 2020</p> --}}
            </div>
            {{-- <div class="dropdown chart-dropdown">
                <i data-feather="more-vertical" class="font-medium-3 cursor-pointer" data-toggle="dropdown"></i>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                    <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                    <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                </div>
            </div> --}}
        </div>
        <div class="card-body">
            {{-- {{ dd($data['top_point']) }} --}}
            @isset($data['top_point']['data'])
                @foreach ($data['top_point']['data'] as $item)
                    <div class="browser-states">
                        <div class="media">
                            <img src="{{ isset($item['picture']) ? asset('storage/pictures/users/mid/'.$item['picture']) : asset('assets/images/dummy-image.jpeg') }}" class="round mr-1" height="30" alt="image" />
                            <h6 class="align-self-center mb-0">{{ $item['username'] }}</h6>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="font-weight-bold text-body-heading mr-1">{{ $item['total_point'] }}</div>
                            @if ($loop->index == 0)
                                <img src="{{ asset('app-assets/images/icons/gold.png') }}" height="40" width="40" alt="medal">
                            @elseif(($loop->index == 1))
                                <img src="{{ asset('app-assets/images/icons/silver.png') }}" height="40" width="40" alt="medal">
                            @elseif(($loop->index == 2))
                                <img src="{{ asset('app-assets/images/icons/bronze.png') }}" height="40" width="40" alt="medal">
                            @else
                                <img src="{{ asset('app-assets/images/icons/all.png') }}" height="40" width="40" alt="medal">
                            @endif
                        </div>
                    </div>
                @endforeach
            @endisset
        </div>
    </div>
</div>

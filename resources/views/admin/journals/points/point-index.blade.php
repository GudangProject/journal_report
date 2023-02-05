<div class="d-flex justify-content-end align-items-end">
    <div class="form-group mr-1">
        <h5 class="text-primary">BULAN</h5>
        <select name="month" wire:model="model_month" class="form-control">
            <option value="{{ date('m') }}">{{ date('F') }}</option>
            @foreach($data_month as $k=>$v)
                @if($k != date('m'))
                <option value="{{ $k }}" @if($k == $month) selected @endif>{{ $v }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <h5 class="text-primary">TAHUN</h5>
        <select name="year" wire:model="model_year" class="form-control">
            <option value="{{ date('Y') }}">{{ date('Y') }}</option>
            @foreach($data_year as $k=>$v)
                @if($k != date('Y'))
                <option value="{{ $k }}" @if($k == $year) selected @endif>{{ $v }}&nbsp;&nbsp;</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="form-group ml-1">
        <button class="btn-icon btn btn-primary btn-round btn-md" wire:click="changeDate">
            <i class="fas fa-search"></i>
        </button>
    </div>
</div>
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
{{-- @dd($data); --}}
                @foreach ($data as $k=>$v)
                <tr>
                    <td>
                        {{ $k+1 }}
                    </td>
                    <td>
                        <span class="font-weight-bold">{!! $v['name'] !!}</span>
                    </td>
                    <td class="text-center">
                        <div class="badge badge-primary">
                            <span>{{ $v['content'] }}</span>
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="badge badge-primary">
                            <span>{{ $v['view']}}</span>
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="badge badge-primary">
                            <span>{{ $v['point']}}</span>
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
            </table>
        </div>
    </div>
</div>

<div class="col-12">
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

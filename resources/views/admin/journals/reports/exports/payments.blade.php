<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Jurnal</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/bootstrap.css">
</head>
<body>
    <div class="container">

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="7"><h4>Total Jurnal</h4></th>
                        <th colspan="3" class="text-right"><h4>{{ number_format($data->count()) }}</h4></th>
                    </tr>
                    <tr>
                        <th colspan="7"><h4>Total Stok Jurnal</h4></th>
                        <th colspan="3" class="text-right"><h4>{{ number_format($data->sum('total')) }}</h4></th>
                    </tr>
                    <tr>
                        <th colspan="10"><h4>-----------------------------------------------</h4></th>
                    </tr>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Rumpun Ilmu</th>
                        <th>Volume</th>
                        <th>Link Issue</th>
                        <th>Indexasi</th>
                        <th>Afiliasi</th>
                        <th>Stok</th>
                        <th>Pengelola</th>
                        <th>No HP</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $row)
                        <tr>
                            <td>
                                {{ $loop->index + 1 }}
                            </td>
                            <td>
                                {{ ucwords($row->name) }}
                            </td>
                            <td>
                                {{ strtoupper($row->knowledge->name) }}
                            </td>
                            <td>
                                {{ $row->volume }} No. {{ $row->number }} {{ $row->month }} {{ $row->year }}, Semester: {{ $row->semester }}
                            </td>
                            <td>
                                {{ $row->link_issue }}
                            </td>
                            <td>
                                {{ $row->indexasi }}
                            </td>
                            <td>
                                {{ $row->afiliate }}
                            </td>
                            <td>
                                {{ $row->total }}
                            </td>
                            <td>
                                {{ $row->manager_by }}
                            </td>
                            <td>
                                {{ $row->manager_phone }}
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center pt-2 pb-1"><strong>Data not found !</strong></td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pembayaran</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/bootstrap.css">
</head>
<body>
    <div class="container">

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="4"><h4>Total Dana Pembayaran</h4></th>
                        <th colspan="2" class="text-right"><h4>{{ number_format($income['income']['total']) }}</h4></th>
                    </tr>
                    <tr>
                        <th colspan="4"><h4>Pembayaran tahun ini</h4></th>
                        <th colspan="2" class="text-right"><h4>{{ number_format($income['income']['currentYear']) }}</h4></th>
                    </tr>
                    <tr>
                        <th colspan="4"><h4>Pembayaran bulan ini</h4></th>
                        <th colspan="2" class="text-right"><h4>{{ number_format($income['income']['currentMonth']) }}</h4></th>
                    </tr>
                    <tr>
                        <th colspan="4"><h4>Pembayaran hari ini</h4></th>
                        <th colspan="2" class="text-right"><h4>{{ number_format($income['income']['currentDay']) }}</h4></th>
                    </tr>
                    <tr>
                        <th colspan="6"><h4>-----------------------------------------------</h4></th>
                    </tr>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Rumpun Ilmu</th>
                        <th>Naskah</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $row)
                        <tr>
                            <td>
                                {{ $loop->index + 1 }}
                            </td>
                            <td>
                                {{ ucwords($row->journal->name) }}
                            </td>
                            <td>
                                {{ ucwords($row->knowledge) }}
                            </td>
                            <td>
                                @foreach ($row->naskah() as $item)
                                    <a href="{{ $item->link }}" class="badge badge-light-primary" style="margin: 3px;">
                                        {{ $item->name }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ $row->dateOriginal }}
                            </td>
                            <td>
                                {{ $row->price }}
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

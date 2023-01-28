<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pengeluaran</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/bootstrap.css">
</head>
<body>
    <div class="container">

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="2"><h4>Total Saldo</h4></th>
                        <th colspan="2" class="text-right"><h4>{{ number_format($data['income_amount']) }}</h4></th>
                    </tr>
                    <tr>
                        <th colspan="2"><h4>Total Dana Keluar</h4></th>
                        <th colspan="2" class="text-right"><h4>{{ number_format($data['speding_money']) }}</h4></th>
                    </tr>
                    <tr>
                        <th colspan="6"><h4>-----------------------------------------------</h4></th>
                    </tr>
                    <tr>
                        <th>No</th>
                        <th>Dana Keluar</th>
                        <th>Keterangan</th>
                        <th>Oleh</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($spedingMoney as $row)
                        <tr>
                            <td>
                                {{ $loop->index + 1 }}
                            </td>
                            <td>
                                {{ ucwords($row->amount) }}
                            </td>
                            <td>
                                {{ ucwords($row->description) }}
                            </td>
                            <td>
                                {{ $row->usedBy->name }}
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center pt-2 pb-1"><strong>Data not found !</strong></td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

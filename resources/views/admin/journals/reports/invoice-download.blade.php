<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Invoice {{ $invoice->code }}</title>

		<style>
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
                                    <h2>Invoice Pembayaran Jurnal & Naskah</h6>
                                    <small>{{ config('app.name') }}</small>
								</td>

								<td>
									Invoice #{{ $invoice->code }}<br>
                                    {{ $payment->dateOriginal }}
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td style="padding-right:100px;">
                                    Dibuat Oleh : <strong>{{ $payment->createBy->name }}</strong>
								</td>

								<td>
                                    Kepada :
                                    <strong>
                                        {{ $payment->payer_name }}<br />
                                    </strong>
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td>Detail Pembayaran</td>

					<td>Total Transfer </td>
				</tr>

				<tr class="details">
                    <td>
                        <ul>
                            <li>No Rekening: {{ $payment->payer_rekening }}</li>
                            <li>Bank : {{ $payment->payer_bank }}</li>
                            <li>Nama: {{ $payment->payer_name }}</li>
                        </ul>
                    </td>

					<td><strong>Rp {{ number_format($payment->price) }}</strong></td>
				</tr>
            </table>
            <table>
				<tr class="heading">
					<td>Jurnal</td>
					<td style="text-align: left;">Nashkah</td>
				</tr>
				<tr>
					<td>{{ $payment->journal->name }}</td>
					<td style="text-align: left;">
                        <ul>
                            @foreach ($naskah as $item)
                                <li>{{ $item->name }}</li>
                            @endforeach
                        </ul>
                    </td>
				</tr>
			</table>
		</div>
	</body>
</html>

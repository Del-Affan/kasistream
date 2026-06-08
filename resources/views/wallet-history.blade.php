<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Riwayat Wallet - KAistream</title>

<link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

<link
    rel="stylesheet"
    href="{{ asset('css/kasistream.css') }}"
>

<link
    rel="stylesheet"
    href="{{ asset('css/wallet-history.css') }}"
>

</head>
<body>

<div class="container-fluid">

    <div class="row">

        @include('layouts.sidebar')

        <div class="col-md-10 p-4">

            <!-- HEADER -->

            <div class="history-header mb-4">

                <h2>

                    <i class="fa-solid fa-clock-rotate-left"></i>

                    Riwayat Wallet

                </h2>

                <p>

                    Semua aktivitas saldo, donasi, dan withdraw tersimpan di sini.

                </p>

            </div>

            <!-- TABLE CARD -->

            <div class="history-card">

                <div class="table-header">

                    <h4>

                        <i class="fa-solid fa-receipt"></i>

                        Daftar Transaksi

                    </h4>

                </div>

                <div class="table-responsive">

                    <table class="table wallet-history-table align-middle mb-0">

                        <thead>

                            <tr>

                                <th>Tanggal</th>
                                <th>Jenis</th>
                                <th>Keterangan</th>
                                <th>Nominal</th>
                                <th>Status</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($transaksi as $item)

                                <tr>

                                    <td>

                                        {{ \Carbon\Carbon::parse($item['tanggal'])->format('d M Y H:i') }}

                                    </td>

                                    <td>

                                        <span class="transaction-type">

                                            {{ $item['jenis'] }}

                                        </span>

                                    </td>

                                    <td>

                                        {{ $item['keterangan'] }}

                                    </td>

                                    <td>

                                        <span class="amount">

                                            Rp {{ number_format($item['nominal']) }}

                                        </span>

                                    </td>

                                    <td>

                                        @if($item['status'] == 'pending')

                                            <span class="status-badge pending">

                                                Pending

                                            </span>

                                        @elseif($item['status'] == 'approved')

                                            <span class="status-badge success">

                                                Approved

                                            </span>

                                        @elseif($item['status'] == 'rejected')

                                            <span class="status-badge danger">

                                                Rejected

                                            </span>

                                        @else

                                            <span class="status-badge info">

                                                Donasi

                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="5">

                                        <div class="empty-state">

                                            <i class="fa-solid fa-wallet"></i>

                                            <h5>

                                                Belum Ada Riwayat

                                            </h5>

                                            <p>

                                                Riwayat transaksi wallet akan muncul di sini.

                                            </p>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>
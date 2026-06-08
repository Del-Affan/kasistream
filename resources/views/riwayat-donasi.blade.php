<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Donasi - KAistream</title>

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
        href="{{ asset('css/riwayat-donasi.css') }}"
    >
</head>
<body>

<div class="container-fluid">

    <div class="row">

        @include('layouts.sidebar')

        <div class="col-md-10 p-4">

            <div class="page-header mb-4">

                <div>

                    <h2>
                        <i class="fa-solid fa-hand-holding-heart"></i>
                        Riwayat Donasi Saya
                    </h2>

                    <p>
                        Semua donasi yang pernah Anda kirim kepada streamer favorit.
                    </p>

                </div>

            </div>

            <div class="donation-card">

                <div class="table-responsive">

                    <table class="table donation-table align-middle">

                        <thead>

                            <tr>
                                <th>Streamer</th>
                                <th>Nominal</th>
                                <th>Pesan</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>

                        </thead>

                        <tbody>

                            @forelse($donasi as $item)

                                <tr>

                                    <td>

                                        <div class="streamer-info">

                                            <div class="streamer-avatar">

                                                {{ strtoupper(substr($item->streamer->name ?? 'S', 0, 1)) }}

                                            </div>

                                            <span>

                                                {{ $item->streamer->name ?? 'Streamer Tidak Ditemukan' }}

                                            </span>

                                        </div>

                                    </td>

                                    <td>

                                        <span class="amount">

                                            Rp {{ number_format($item->nominal) }}

                                        </span>

                                    </td>

                                    <td>

                                        {{ $item->pesan ?: '-' }}

                                    </td>

                                    <td>

                                        @if($item->status == 'success')

                                            <span class="status-badge success">
                                                Berhasil
                                            </span>

                                        @elseif($item->status == 'pending')

                                            <span class="status-badge pending">
                                                Pending
                                            </span>

                                        @elseif($item->status == 'failed')

                                            <span class="status-badge failed">
                                                Gagal
                                            </span>

                                        @else

                                            <span class="status-badge pending">
                                                {{ ucfirst($item->status) }}
                                            </span>

                                        @endif

                                    </td>

                                    <td>

                                        {{ $item->created_at->format('d M Y H:i') }}

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="5">

                                        <div class="empty-state">

                                            <i class="fa-solid fa-receipt"></i>

                                            <h5>
                                                Belum Ada Riwayat Donasi
                                            </h5>

                                            <p>
                                                Donasi pertama Anda akan muncul di sini.
                                            </p>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="mt-4">

                    {{ $donasi->links() }}

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Streamer - KAistream</title>

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
        href="{{ asset('css/streamers-dashboard.css') }}"
    >

</head>
<body>

<div class="container-fluid">

    <div class="row">

        @include('layouts.sidebar')

        <div class="col-md-10 p-4">

            <!-- HEADER -->

            <div class="dashboard-header mb-4">

                <div>

                    <h2>
                        <i class="fa-solid fa-chart-line"></i>
                        Dashboard Streamer
                    </h2>

                    <p>
                        Pantau performa donasi dan aktivitas pendukung Anda.
                    </p>

                </div>

                <div class="user-profile">

                    @if(Auth::user()->foto)

                        <img
                            src="{{ asset('uploads/profile/' . Auth::user()->foto) }}"
                            class="profile-img"
                            alt="Profile"
                        >

                    @else

                        <img
                            src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}"
                            class="profile-img"
                            alt="Profile"
                        >

                    @endif

                    <div>

                        <h6>
                            {{ Auth::user()->name }}
                        </h6>

                        <span>
                            Streamer
                        </span>

                    </div>

                </div>

            </div>

            <!-- STATISTIK -->

            <div class="row">

                <div class="col-lg-4 col-md-6 mb-4">

                    <div class="stats-card">

                        <div class="stats-icon">

                            <i class="fa-solid fa-sack-dollar"></i>

                        </div>

                        <div>

                            <span>
                                Total Donasi
                            </span>

                            <h3>
                                Rp {{ number_format($totalDonasi) }}
                            </h3>

                        </div>

                    </div>

                </div>

                <div class="col-lg-4 col-md-6 mb-4">

                    <div class="stats-card">

                        <div class="stats-icon">

                            <i class="fa-solid fa-users"></i>

                        </div>

                        <div>

                            <span>
                                Total Donatur
                            </span>

                            <h3>
                                {{ number_format($totalDonatur) }}
                            </h3>

                        </div>

                    </div>

                </div>

                <div class="col-lg-4 col-md-12 mb-4">

                    <div class="stats-card">

                        <div class="stats-icon">

                            <i class="fa-solid fa-arrow-trend-up"></i>

                        </div>

                        <div>

                            <span>
                                Total Transaksi
                            </span>

                            <h3>
                                {{ number_format($totalTransaksi) }}
                            </h3>

                        </div>

                    </div>

                </div>

            </div>

            <!-- TABEL -->

            <div class="table-card">

                <div class="table-header">

                    <h4>

                        <i class="fa-solid fa-clock-rotate-left"></i>

                        Riwayat Donasi Terbaru

                    </h4>

                </div>

                <div class="table-responsive">

                    <table class="table dashboard-table align-middle mb-0">

                        <thead>

                            <tr>

                                <th>Donatur</th>
                                <th>Nominal</th>
                                <th>Pesan</th>
                                <th>Tanggal</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($donasiTerbaru as $donasi)

                                <tr>

                                    <td>

                                        <div class="donatur-info">

                                            <div class="donatur-avatar">

                                                {{ strtoupper(substr(optional($donasi->user)->name ?? $donasi->guest_name,0,1)) }}

                                            </div>

                                            <span>

                                                {{ optional($donasi->user)->name ?? $donasi->guest_name }}

                                            </span>

                                        </div>

                                    </td>

                                    <td>

                                        <span class="amount">

                                            Rp {{ number_format($donasi->nominal) }}

                                        </span>

                                    </td>

                                    <td>

                                        {{ $donasi->pesan ?: '-' }}

                                    </td>

                                    <td>

                                        {{ $donasi->created_at->format('d M Y') }}

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4">

                                        <div class="empty-state">

                                            <i class="fa-solid fa-hand-holding-heart"></i>

                                            <h5>
                                                Belum Ada Donasi
                                            </h5>

                                            <p>
                                                Donasi dari pendukung Anda akan muncul di sini.
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik Streamer - KAistream</title>

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
        href="{{ asset('css/streamers-statistic.css') }}"
    >

</head>
<body>

<div class="container-fluid">

    <div class="row">

        @include('layouts.sidebar')

        <div class="col-md-10 p-4">

            <!-- HEADER -->

            <div class="statistics-header">

                <h2>
                    <i class="fa-solid fa-chart-pie"></i>
                    Statistik Streamer
                </h2>

                <p>
                    Analisis performa donasi dan aktivitas pendukung Anda.
                </p>

            </div>

            <!-- STATISTICS -->

            <div class="row mt-4">

                <div class="col-lg-4 col-md-6 mb-4">

                    <div class="stats-card">

                        <div class="stats-icon">

                            <i class="fa-solid fa-sack-dollar"></i>

                        </div>

                        <h6>
                            Total Donasi
                        </h6>

                        <h3>
                            Rp {{ number_format($totalDonasi) }}
                        </h3>

                    </div>

                </div>

                <div class="col-lg-4 col-md-6 mb-4">

                    <div class="stats-card">

                        <div class="stats-icon">

                            <i class="fa-solid fa-trophy"></i>

                        </div>

                        <h6>
                            Donasi Terbesar
                        </h6>

                        <h3>
                            Rp {{ number_format($donasiTerbesar) }}
                        </h3>

                    </div>

                </div>

                <div class="col-lg-4 col-md-12 mb-4">

                    <div class="stats-card">

                        <div class="stats-icon">

                            <i class="fa-solid fa-chart-line"></i>

                        </div>

                        <h6>
                            Rata-rata Donasi
                        </h6>

                        <h3>
                            Rp {{ number_format($rataRataDonasi) }}
                        </h3>

                    </div>

                </div>

            </div>

            <!-- TOP DONATUR -->

            <div class="top-donatur-card">

                <h4>

                    <i class="fa-solid fa-crown text-warning"></i>

                    Top Donatur

                </h4>

                <div class="table-responsive">

                    <table class="table statistics-table align-middle mb-0">

                        <thead>

                            <tr>

                                <th>Donatur</th>

                                <th>Total Donasi</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($topDonatur as $donatur)

                                <tr>

                                    <td>

                                        <div class="donatur-info">

                                            <div class="donatur-avatar">

                                                {{ strtoupper(substr(optional($donatur->user)->name ?? $donatur->guest_name ?? 'G', 0, 1)) }}

                                            </div>

                                            <div>

                                                <div class="donatur-name">

                                                    {{ optional($donatur->user)->name ?? $donatur->guest_name }}

                                                </div>

                                                @if(!$donatur->user)

                                                    <span class="guest-badge">

                                                        Guest

                                                    </span>

                                                @endif

                                            </div>

                                        </div>

                                    </td>

                                    <td>

                                        <span class="amount">

                                            Rp {{ number_format($donatur->total) }}

                                        </span>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="2">

                                        <div class="empty-state">

                                            <i class="fa-solid fa-users"></i>

                                            <h5>
                                                Belum Ada Data Donatur
                                            </h5>

                                            <p>
                                                Data top donatur akan muncul setelah menerima donasi.
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
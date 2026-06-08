<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donasi Masuk - KAistream</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/kasistream.css') }}">
    <link rel="stylesheet" href="{{ asset('css/streamers-donations.css') }}">
</head>
<body>

<div class="container-fluid">

    <div class="row">

        @include('layouts.sidebar')

        <div class="col-md-10 p-4">

            <!-- HEADER -->

            <div class="donation-header mb-4">

                <div>

                    <h2>
                        <i class="fa-solid fa-money-bill-wave"></i>
                        Donasi Masuk
                    </h2>

                    <p>
                        Semua dukungan yang diterima dari para penonton dan penggemar.
                    </p>

                </div>

            </div>

            <!-- TABLE CARD -->

            <div class="donation-card">

                <div class="table-header">

                    <h4>
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        Riwayat Donasi
                    </h4>

                </div>

                <div class="table-responsive">

                    <table class="table donation-table align-middle mb-0">

                        <thead>

                            <tr>

                                <th>Donatur</th>
                                <th>Nominal</th>
                                <th>Pesan</th>
                                <th>Tanggal</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($donasi as $item)

                                <tr>

                                    <td>

                                        <div class="donatur-info">

                                            <div class="donatur-avatar">

                                                {{ strtoupper(substr(optional($item->user)->name ?? $item->guest_name ?? 'G',0,1)) }}

                                            </div>

                                            <div>

                                                <div class="donatur-name">

                                                    {{ optional($item->user)->name ?? $item->guest_name }}

                                                </div>

                                                @if(!$item->user)

                                                    <span class="guest-badge">
                                                        Guest
                                                    </span>

                                                @endif

                                            </div>

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

                                        {{ $item->created_at->format('d M Y H:i') }}

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4">

                                        <div class="empty-state">

                                            <i class="fa-solid fa-hand-holding-heart"></i>

                                            <h5>
                                                Belum Ada Donasi Masuk
                                            </h5>

                                            <p>
                                                Donasi dari pendukung akan muncul di sini.
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
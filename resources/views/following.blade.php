<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Mengikuti</title>

<link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/kasistream.css') }}">
<link rel="stylesheet" href="{{ asset('css/following.css') }}">


</head>
<body>

<div class="row g-0">

    @include('layouts.sidebar')

    <div class="col-md-10 p-4">

        <div class="page-card shadow-sm mb-4">

            <h2>
                <i class="fa-solid fa-star text-warning"></i>
                Streamer Yang Saya Ikuti
            </h2>

            <p class="mb-0">
                Daftar streamer favorit yang Anda dukung dan ikuti.
            </p>

        </div>

        <div class="row">

            @forelse($streamers as $streamer)

                <div class="col-lg-4 col-md-6 mb-4">

                    <div class="streamer-card">

                        @if($streamer->foto)

                            <img
                                src="{{ asset('uploads/profile/'.$streamer->foto) }}"
                                class="streamer-img"
                                alt="{{ $streamer->name }}"
                            >

                        @else

                            <img
                                src="https://via.placeholder.com/110"
                                class="streamer-img"
                                alt="Streamer"
                            >

                        @endif

                        <h4>{{ $streamer->name }}</h4>

                        <div class="game-badge">
                            🎮 {{ $streamer->game }}
                        </div>

                        <div class="streamer-stats">

                            <div class="stat-box">
                                <i class="fa-solid fa-users"></i>
                                <span class="stat-number">
                                    {{ number_format($streamer->followers) }}
                                </span>
                                <span class="stat-label">
                                    Followers
                                </span>
                            </div>

                            <div class="stat-box">
                                <i class="fa-solid fa-sack-dollar"></i>
                                <span class="stat-number">
                                    Rp {{ number_format($streamer->total_donasi) }}
                                </span>
                                <span class="stat-label">
                                    Donasi
                                </span>
                            </div>

                        </div>

                        <a
                            href="/streamer/{{ $streamer->id }}"
                            class="btn btn-profile w-100"
                        >
                            <i class="fa-solid fa-user"></i>
                            Lihat Profil
                        </a>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="empty-state">

                        <i class="fa-solid fa-heart-circle-plus"></i>

                        <h4>Belum Mengikuti Streamer</h4>

                        <p class="text-secondary mb-0">
                            Cari streamer favorit Anda dan mulai mengikuti mereka.
                        </p>

                    </div>

                </div>

            @endforelse

        </div>

        <div class="mt-4">
            {{ $streamers->links() }}
        </div>

    </div>

</div>

</body>
</html>
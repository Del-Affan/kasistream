<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - KAistream</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/kasistream.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>
<body>

<div class="container-fluid">

    <div class="row">

        @include('layouts.sidebar')

        <div class="col-md-10 p-4">

            <!-- HEADER -->

            <div class="profile-header mb-4">

                <h2>
                    <i class="fa-solid fa-user"></i>
                    Profil Saya
                </h2>

                <p>
                    Kelola informasi akun dan pengaturan streamer Anda.
                </p>

            </div>

            <!-- PROFILE CARD -->

            <div class="profile-card">

                @if(session('success'))

                    <div class="custom-alert success">

                        <i class="fa-solid fa-circle-check"></i>

                        {{ session('success') }}

                    </div>

                @endif

                <!-- PROFILE IMAGE -->

                <div class="profile-avatar-section">

                    @if(Auth::user()->foto)

                        <img
                            src="{{ asset('uploads/profile/' . Auth::user()->foto) }}"
                            class="profile-img"
                            alt="Profile"
                        >

                    @else

                        <div class="profile-avatar">

                            {{ strtoupper(substr(Auth::user()->name,0,1)) }}

                        </div>

                    @endif

                    <h4>

                        {{ Auth::user()->name }}

                    </h4>

                    <span>

                        {{ Auth::user()->email }}

                    </span>

                </div>

                <!-- FORM -->

                <form
                    action="/profile"
                    method="POST"
                    enctype="multipart/form-data"
                >

                    @csrf

                    <div class="mb-3">

                        <label class="form-label">

                            Nama Lengkap

                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control custom-input"
                            value="{{ Auth::user()->name }}"
                        >

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Email

                        </label>

                        <input
                            type="email"
                            class="form-control custom-input"
                            value="{{ Auth::user()->email }}"
                            readonly
                        >

                    </div>

                    <div class="mb-4">

                        <label class="form-label">

                            Foto Profil

                        </label>

                        <input
                            type="file"
                            name="foto"
                            class="form-control custom-input"
                        >

                    </div>

                    <!-- STREAMER STATUS -->

                    <div class="streamer-section">

                        <h5>

                            <i class="fa-solid fa-tower-broadcast"></i>

                            Status Streamer

                        </h5>

                        @if(Auth::user()->is_streamer)

                            <div class="streamer-status active">

                                <i class="fa-solid fa-circle-check"></i>

                                Akun Streamer Aktif

                            </div>

                        @else

                            <div class="streamer-status inactive">

                                <i class="fa-solid fa-triangle-exclamation"></i>

                                Belum Menjadi Streamer

                            </div>

                            <a
                                href="/become-streamer"
                                class="btn-streamer"
                            >

                                <i class="fa-solid fa-tower-broadcast"></i>

                                Menjadi Streamer

                            </a>

                        @endif

                    </div>

                    <!-- LIVE SCHEDULE -->

                    @if(Auth::user()->is_streamer)

                        <div class="live-section">

                            <h5>

                                <i class="fa-solid fa-calendar-days"></i>

                                Jadwal Live Stream

                            </h5>

                            <textarea
                                name="jadwal_Live"
                                rows="6"
                                class="form-control custom-input"
                                placeholder="Masukkan jadwal live streaming Anda..."
                            >{{ Auth::user()->jadwal_Live }}</textarea>

                        </div>

                    @endif

                    <!-- BUTTON -->

                    <button
                        type="submit"
                        class="save-btn"
                    >

                        <i class="fa-solid fa-floppy-disk"></i>

                        Simpan Perubahan

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

</body>
</html>
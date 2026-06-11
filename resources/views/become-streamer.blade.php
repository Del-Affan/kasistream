<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menjadi Streamer - KAistream</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link
        rel="stylesheet"
        href="{{ asset('css/kasistream.css') }}"
    >
        <link
    rel="stylesheet"
    href="{{ asset('css/become-streamer.css?v=' . time()) }}"
>

</head>
<body>

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card shadow">

                <div class="card-header">

                    <h3>Daftar Menjadi Streamer</h3>

                </div>

                <div class="card-body">

                    <div class="streamer-info">

    <strong>🚀 Mulai Karir Streaming Anda</strong>

    <br><br>

    Lengkapi profil streamer untuk menerima donasi,
    menampilkan jadwal live, dan membangun komunitas
    penggemar Anda di KAistream.

</div>

                    <form action="/become-streamer" method="POST">

                        @csrf

                        <div class="mb-3">

                            <label class="form-label">
                                Bio Streamer
                            </label>

                            <textarea
                                name="bio"
                                class="form-control"
                                rows="4"
                                required
                            ></textarea>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Game Utama
                            </label>

                            <input
                                type="text"
                                name="game"
                                class="form-control"
                                required
                            >

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Instagram
                            </label>

                            <input
                                type="text"
                                name="instagram"
                                class="form-control"
                            >

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Youtube
                            </label>

                            <input
                                type="text"
                                name="youtube"
                                class="form-control"
                            >

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                TikTok
                            </label>

                            <input
                                type="text"
                                name="tiktok"
                                class="form-control"
                            >

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Discord
                            </label>

                            <input
                                type="text"
                                name="discord"
                                class="form-control"
                            >

                        </div>

                        <button
                            type="submit"
                            class="btn btn-success"
                        >
                            Menjadi Streamer
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>

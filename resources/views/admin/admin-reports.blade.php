
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Laporan Admin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

<style>

body{
    background:#f4f6f9;
}

.sidebar{
    min-height:100vh;
    background:linear-gradient(
        180deg,
        #0f172a,
        #111827
    );
}

.logo{
    color:white;
    font-size:24px;
    font-weight:bold;
}

.menu-item{
    display:block;
    color:white;
    text-decoration:none;
    padding:12px 15px;
    border-radius:10px;
    margin-bottom:8px;
}

.menu-item:hover{
    background:rgba(255,255,255,.1);
    color:white;
}

.active-menu{
    background:rgba(255,255,255,.15);
}

.stat-card{
    border:none;
    border-radius:15px;
}

.content-card{
    background:white;
    border-radius:15px;
    padding:20px;
}

</style>

</head>
<body>

<div class="container-fluid">

<div class="row">

@include('admin.layouts.sidebar')

<div class="col-md-10 p-4">

    <h2 class="mb-4">
        Laporan Sistem
    </h2>

    <div class="row">

        <div class="col-md-3 mb-3">
            <div class="card stat-card shadow">
                <div class="card-body">
                    <h6>Total User</h6>
                    <h3>{{ $totalUser }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card stat-card shadow">
                <div class="card-body">
                    <h6>Total Streamer</h6>
                    <h3>{{ $totalStreamer }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card stat-card shadow">
                <div class="card-body">
                    <h6>Total Donasi</h6>
                    <h3>Rp {{ number_format($totalDonasi) }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card stat-card shadow">
                <div class="card-body">
                    <h6>Total Withdraw</h6>
                    <h3>Rp {{ number_format($totalWithdraw) }}</h3>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-md-6">

            <div class="content-card shadow">

                <h4 class="mb-3">
                    Ringkasan Platform
                </h4>

                <table class="table">

                    <tr>
                        <th>Total Transaksi</th>
                        <td>{{ $totalTransaksi }}</td>
                    </tr>

                    <tr>
                        <th>Total Donasi Masuk</th>
                        <td>Rp {{ number_format($totalDonasi) }}</td>
                    </tr>

                    <tr>
                        <th>Total Withdraw</th>
                        <td>Rp {{ number_format($totalWithdraw) }}</td>
                    </tr>

                    <tr>
                        <th>Saldo Platform</th>
                        <td>
                            Rp {{ number_format($totalDonasi - $totalWithdraw) }}
                        </td>
                    </tr>

                </table>

            </div>

        </div>

        <div class="col-md-6">

            <div class="content-card shadow">

                <h4 class="mb-3">
                    Top Streamer
                </h4>

                <table class="table table-hover">

                    <thead>

                        <tr>
                            <th>Nama</th>
                            <th>Game</th>
                            <th>Total Donasi</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach($topStreamer as $streamer)

                            <tr>

                                <td>
                                    {{ $streamer->name }}
                                </td>

                                <td>
                                    {{ $streamer->game }}
                                </td>

                                <td>
                                    Rp {{ number_format($streamer->total_donasi) }}
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</div>

</div>

</body>
</html>


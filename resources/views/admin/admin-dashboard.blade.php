<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin Dashboard - KAistream</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
    transition:.3s;
}

.menu-item:hover{
    background:rgba(255,255,255,.1);
    color:white;
}

.active-menu{
    background:rgba(255,255,255,.15);
}

.card-stat{
    border:none;
    border-radius:15px;
}

.card-stat .icon{
    font-size:28px;
}

.content-card{
    background:white;
    border-radius:15px;
    padding:20px;
}

.donasi-item{
    border-bottom:1px solid #eee;
    padding:15px 0;
}

.donasi-item:last-child{
    border-bottom:none;
}

</style>

</head>
<body>

<div class="container-fluid">

<div class="row">

<!-- SIDEBAR -->

@include('admin.layouts.sidebar')

<!-- CONTENT -->

<div class="col-md-10 p-4">

    <h2 class="fw-bold mb-4">
        Dashboard
    </h2>

    <!-- STAT CARD -->

    <div class="row">

        <div class="col-md-3 mb-4">

            <div class="card card-stat shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small>Total User</small>

                            <h2>
                                {{ number_format($totalUser) }}
                            </h2>

                        </div>

                        <i class="fa-regular fa-user icon"></i>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="card card-stat shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small>Total Streamer</small>

                            <h2>
                                {{ number_format($totalStreamer) }}
                            </h2>

                        </div>

                        <i class="fa-solid fa-hourglass-half icon"></i>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="card card-stat shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small>Total Donasi</small>

                            <h3>
                                Rp {{ number_format($totalDonasi) }}
                            </h3>

                        </div>

                        <i class="fa-solid fa-sack-dollar icon"></i>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="card card-stat shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small>Transaksi Hari Ini</small>

                            <h2>
                                {{ number_format($transaksiHariIni) }}
                            </h2>

                        </div>

                        <i class="fa-solid fa-users icon"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- GRAFIK + DONASI -->

    <div class="row">

        <div class="col-md-6 mb-4">

            <div class="content-card shadow-sm">

                <h4 class="mb-4">
                    Grafik Donasi
                </h4>

                <canvas id="donasiChart"></canvas>

            </div>

        </div>

        <div class="col-md-6 mb-4">

            <div class="content-card shadow-sm">

                <h4 class="mb-4">
                    Donasi Terbaru
                </h4>

                @forelse($donasiTerbaru as $item)

                    <div class="donasi-item">

                        <div class="d-flex justify-content-between">

                            <div>

                                <strong>
    {{ optional($item->user)->name ?? $item->guest_name }}
</strong>

@if(!$item->user)

    <span class="badge bg-secondary ms-1">
        Guest
    </span>

@endif

                                →

                                <strong>
                                    {{ $item->streamer->name }}
                                </strong>

                                <br>

                                <small>
                                    {{ $item->created_at->format('d M Y H:i') }}
                                </small>

                            </div>

                            <strong>

                                Rp {{ number_format($item->nominal) }}

                            </strong>

                        </div>

                    </div>

                @empty

                    <p>
                        Belum ada donasi.
                    </p>

                @endforelse

            </div>

        </div>

    </div>

</div>

</div>

</div>

<script>

new Chart(
document.getElementById('donasiChart'),
{
    type:'line',

    data:{
        labels:[
            'Sen',
            'Sel',
            'Rab',
            'Kam',
            'Jum',
            'Sab',
            'Min'
        ],

        datasets:[
        {
            label:'Donasi',
            data:[
                10,
                20,
                15,
                35,
                25,
                40,
                30
            ],
            tension:.4
        }]
    }
});

</script>

</body>
</html>
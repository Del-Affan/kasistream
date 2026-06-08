<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Data Donasi - KAistream</title>

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

.content-card{
    background:white;
    border-radius:15px;
    padding:20px;
}

.badge-success{
    background:#198754;
}

.badge-warning{
    background:#ffc107;
    color:black;
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

    <div class="content-card shadow-sm">

        <h3 class="mb-4">

            Data Donasi Platform

        </h3>

        <table class="table table-hover">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Donatur</th>
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
                            #{{ $item->id }}
                        </td>

                        <td>

    {{ optional($item->user)->name ?? $item->guest_name }}

    @if(!$item->user)

        <span class="badge bg-secondary">
            Guest
        </span>

    @endif

</td>

                        <td>
                            {{ $item->streamer->name }}
                        </td>

                        <td>
                            Rp {{ number_format($item->nominal) }}
                        </td>

                        <td>
                            {{ $item->pesan }}
                        </td>

                        <td>

                            @if($item->status == 'success')

                                <span class="badge bg-success">

                                    Success

                                </span>

                            @else

                                <span class="badge bg-warning">

                                    Pending

                                </span>

                            @endif

                        </td>

                        <td>

                            {{ $item->created_at->format('d M Y H:i') }}

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7"
                            class="text-center">

                            Belum ada transaksi.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

        <div class="mt-3">

            {{ $donasi->links() }}

        </div>

    </div>

</div>

</div>

</div>

</body>
</html>
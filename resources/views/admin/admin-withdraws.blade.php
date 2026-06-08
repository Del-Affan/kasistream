
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Withdraw Request</title>

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
    transition:.3s;
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

</style>

</head>
<body>

<div class="container-fluid">

<div class="row">

@include('admin.layouts.sidebar')

<div class="col-md-10 p-4">

    <div class="content-card shadow-sm">

        <h3 class="mb-4">

            Withdraw Request

        </h3>

        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif

        <table class="table table-hover">

            <thead>

                <tr>

                    <th>Streamer</th>
                    <th>Nominal</th>
                    <th>Bank</th>
                    <th>Rekening</th>
                    <th>Status</th>
                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

                @foreach($withdraws as $withdraw)

                    <tr>

                        <td>
                            {{ $withdraw->user->name }}
                        </td>

                        <td>
                            Rp {{ number_format($withdraw->nominal) }}
                        </td>

                        <td>
                            {{ $withdraw->bank }}
                        </td>

                        <td>
                            {{ $withdraw->rekening }}
                        </td>

                        <td>

                            @if($withdraw->status == 'pending')

                                <span class="badge bg-warning">

                                    Pending

                                </span>

                            @elseif($withdraw->status == 'approved')

                                <span class="badge bg-success">

                                    Approved

                                </span>

                            @else

                                <span class="badge bg-danger">

                                    Rejected

                                </span>

                            @endif

                        </td>

                        <td>

                            @if($withdraw->status == 'pending')

                                <form
                                    action="/admin-withdraws/{{ $withdraw->id }}/approve"
                                    method="POST"
                                    class="d-inline">

                                    @csrf

                                    <button
                                        class="btn btn-success btn-sm">

                                        Approve

                                    </button>

                                </form>

                                <form
                                    action="/admin-withdraws/{{ $withdraw->id }}/reject"
                                    method="POST"
                                    class="d-inline">

                                    @csrf

                                    <button
                                        class="btn btn-danger btn-sm">

                                        Reject

                                    </button>

                                </form>

                            @endif

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

        {{ $withdraws->links() }}

    </div>

</div>

</div>

</div>

</body>
</html>
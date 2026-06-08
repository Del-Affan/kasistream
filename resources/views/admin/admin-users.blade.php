<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Data User - KAistream</title>

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

.profile-img{
    width:40px;
    height:40px;
    border-radius:50%;
    object-fit:cover;
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

        <div class="d-flex justify-content-between mb-4">

            <h3>Data User</h3>

        </div>

        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif

        @if(session('error'))

            <div class="alert alert-danger">

                {{ session('error') }}

            </div>

        @endif

        <table class="table table-hover">

            <thead>

                <tr>

                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Streamer</th>
                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

                @foreach($users as $user)

                    <tr>

                        <td>

                            @if($user->foto)

                                <img
                                    src="{{ asset('uploads/profile/'.$user->foto) }}"
                                    class="profile-img"
                                >

                            @endif

                        </td>

                        <td>
                            {{ $user->name }}
                        </td>

                        <td>
                            {{ $user->email }}
                        </td>

                        <td>
                            {{ $user->role }}
                        </td>

                        <td>

                            @if($user->is_streamer)

                                <span class="badge bg-success">
                                    Ya
                                </span>

                            @else

                                <span class="badge bg-secondary">
                                    Tidak
                                </span>

                            @endif

                        </td>

                        <td>

                            <form
                                action="/admin-users/{{ $user->id }}"
                                method="POST"
                                onsubmit="return confirm('Hapus user ini?')">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="btn btn-danger btn-sm">

                                    Hapus

                                </button>

                            </form>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

        {{ $users->links() }}

    </div>

</div>

</div>

</div>

</body>
</html>
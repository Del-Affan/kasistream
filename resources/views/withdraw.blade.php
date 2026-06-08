<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Withdraw - KAistream</title>

<link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/kasistream.css') }}">
<link rel="stylesheet" href="{{ asset('css/withdraw.css') }}">

</head>
<body>

<div class="container-fluid">

    <div class="row">

        @include('layouts.sidebar')

        <div class="col-md-10 p-4">

            <!-- HEADER -->

            <div class="wallet-header">

                <h2>
                    <i class="fa-solid fa-money-bill-transfer"></i>
                    Tarik Dana
                </h2>

                <p>
                    Ajukan pencairan saldo wallet ke rekening bank atau e-wallet Anda.
                </p>

            </div>

            <div class="row justify-content-center mt-4">

                <div class="col-xl-8">

                    <div class="withdraw-card">

                        @if(session('error'))

                            <div class="alert alert-danger">

                                <i class="fa-solid fa-circle-exclamation me-2"></i>

                                {{ session('error') }}

                            </div>

                        @endif

                        <!-- INFORMASI -->

                        <div class="info-card mb-4">

                            <h6>

                                <i class="fa-solid fa-circle-info me-2"></i>

                                Ketentuan Withdraw

                            </h6>

                            <ul class="mb-0">

                                <li>Minimal withdraw Rp 10.000</li>

                                <li>Permintaan akan diverifikasi oleh admin</li>

                                <li>Dana akan dikirim ke rekening atau e-wallet yang didaftarkan</li>

                                <li>Pastikan nomor rekening dan nama penerima sudah benar</li>

                            </ul>

                        </div>

                        <!-- FORM -->

                        <form
                            action="/withdraw"
                            method="POST"
                            onsubmit="return cekWithdraw()"
                        >

                            @csrf

                            <div class="mb-3">

                                <label class="form-label">

                                    <i class="fa-solid fa-wallet me-1"></i>

                                    Nominal Withdraw

                                </label>

                                <input
                                    type="number"
                                    name="nominal"
                                    id="nominal"
                                    class="form-control"
                                    placeholder="Minimal Rp 10.000"
                                    onkeyup="updateNominal()"
                                    required
                                >

                            </div>

                            @error('nominal')

                                <div class="text-danger mb-3">

                                    {{ $message }}

                                </div>

                            @enderror

                            <div class="mb-3">

                                <label class="form-label">

                                    <i class="fa-solid fa-building-columns me-1"></i>

                                    Bank / E-Wallet

                                </label>

                                <select
                                    name="bank"
                                    class="form-select"
                                    required
                                >

                                    <option value="">
                                        Pilih Bank / E-Wallet
                                    </option>

                                    <option>BCA</option>
                                    <option>BRI</option>
                                    <option>BNI</option>
                                    <option>Mandiri</option>
                                    <option>SeaBank</option>
                                    <option>DANA</option>
                                    <option>OVO</option>
                                    <option>GoPay</option>

                                </select>

                            </div>

                            <div class="mb-3">

                                <label class="form-label">

                                    <i class="fa-solid fa-credit-card me-1"></i>

                                    Nomor Rekening / Nomor E-Wallet

                                </label>

                                <input
                                    type="text"
                                    name="rekening"
                                    class="form-control"
                                    placeholder="Masukkan nomor rekening"
                                    required
                                >

                            </div>

                            <div class="mb-4">

                                <label class="form-label">

                                    <i class="fa-solid fa-user me-1"></i>

                                    Nama Pemilik Rekening

                                </label>

                                <input
                                    type="text"
                                    name="nama_rekening"
                                    class="form-control"
                                    placeholder="Masukkan nama pemilik rekening"
                                    required
                                >

                            </div>

                            <!-- PREVIEW -->

                            <div class="summary-card mb-4">

                                <small>

                                    Jumlah yang Akan Ditarik

                                </small>

                                <div
                                    class="amount-preview"
                                    id="previewNominal"
                                >

                                    Rp 0

                                </div>

                            </div>

                            <!-- BUTTON -->

                            <button
                                type="submit"
                                class="btn btn-withdraw w-100"
                            >

                                <i class="fa-solid fa-paper-plane me-2"></i>

                                Kirim Permintaan Withdraw

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

function updateNominal()
{
    let nominal =
        document.getElementById('nominal').value;

    nominal = nominal || 0;

    document.getElementById('previewNominal').innerHTML =
        'Rp ' +
        Number(nominal).toLocaleString('id-ID');
}

function cekWithdraw()
{
    let nominal =
        parseInt(
            document.getElementById('nominal').value
        );

    if(nominal < 10000)
    {
        alert(
            'Minimal withdraw adalah Rp 10.000'
        );

        return false;
    }

    return true;
}

</script>

</body>
</html>
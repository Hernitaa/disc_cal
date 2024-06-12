<!DOCTYPE html>
<html>
<head>
    <title>Discount Result</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Hasil Penghitungan Diskon</h1>
        
        <h3>Total Harga Barang</h3>
        <p>Rp{{ number_format($result['total_price'], 0, ',', '.') }}</p>

        @if ($result['discount'] > 0)
        <h6>Jumlah Diskon</h6>
        <p>Rp{{ number_format($result['discount'], 0, ',', '.') }}</p>
        @endif

        <h6>Harga yang Harus Dibayar</h6>
        <p>Rp{{ number_format($result['final_price'], 0, ',', '.') }}</p>

        <h6>Keterangan Pembayaran</h6>
        @if ($result['final_price'] > 0 && $result['final_price'] <= 400000)
        <p>Pembayaran: Cash</p>
        @elseif ($result['final_price'] > 400000 && $result['final_price'] <= 1000000)
        <p>Pembayaran: Debet</p>
        @elseif ($result['final_price'] > 1000000 && $result['final_price'] <= 2000000)
        <p>Pembayaran: Credit</p>
        @else
        <p>Pembayaran: QRIS</p>
        @endif

        <h4>Daftar Barang</h4>
        <ul class="list-group">
            @foreach ($items as $item)
            <li class="list-group-item">{{ $item['name'] }} - Rp{{ number_format($item['price'], 0, ',', '.') }}</li>
            @endforeach
        </ul>

        <a href="{{ route('discount.form') }}" class="btn btn-primary mt-3">Kembali</a>
    </div>
</body>
</html>

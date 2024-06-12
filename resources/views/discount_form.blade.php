<!DOCTYPE html>
<html>
<head>
    <title>Amazon.co.id</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Amazon.co.id</h1>
        <form id="item-form">
            <div class="form-group">
                <label for="item_name">Nama Barang:</label>
                <input type="text" class="form-control" id="item_name" name="item_name" required>
            </div>
            <div class="form-group">
                <label for="price">Harga Barang (Rp):</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="payment_method">Jenis Bayar:</label>
                <select class="form-control" id="payment_method" name="payment_method" required>
                    <option value="Debit">Debet</option>
                    <option value="Credit">Credit</option>
                    <option value="QRIS">QRIS</option>
                    <option value="Cash">Cash</option>
                </select>
            </div>
            <button type="button" class="btn btn-secondary" id="add-item">Tambah Barang</button>
        </form>
        
        <h2 class="mt-5">Daftar Barang</h2>
        <ul id="item-list" class="list-group">
        </ul>

        <form action="{{ route('calculate.discount') }}" method="POST" id="discount-form">
            @csrf
            <input type="hidden" name="items" id="items">
            <button type="submit" class="btn btn-primary mt-3">Hitung Diskon</button>
        </form>
    </div>

    <script>
        $(document).ready(function(){
            var itemList = [];

            $('#add-item').click(function(){
                var itemName = $('#item_name').val();
                var price = $('#price').val();
                var paymentMethod = $('#payment_method').val();

                if(itemName && price && paymentMethod) {
                    var item = {
                        name: itemName,
                        price: price,
                        payment_method: paymentMethod
                    };

                    itemList.push(item);
                    updateItemList();
                    $('#item-form')[0].reset();
                }
            });

            $(document).on('click', '.remove-item', function(){
                var index = $(this).data('index');
                itemList.splice(index, 1);
                updateItemList();
            });

            function updateItemList() {
                $('#item-list').empty();
                itemList.forEach(function(item, index){
                    $('#item-list').append('<li class="list-group-item">' + item.name + ' - Rp' + item.price + ' (' + item.payment_method + ') <button type="button" class="btn btn-danger btn-sm float-right remove-item" data-index="' + index + '">X</button></li>');
                });
                $('#items').val(JSON.stringify(itemList));
            }
        });
    </script>
</body>
</html>

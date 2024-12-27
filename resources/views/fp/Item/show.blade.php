@extends('layout.template')

@section('title', 'Detail item')

@section('content')
    <div class="card">
        <div class="card-body">
        <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <img src="{{ asset('storage/' . $data['item']->image) }}" id="image" width="200" height="200">
                    </div>
                </div>
        </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="id">ID</label>
                        <p id="id">{{ $data['item']->id }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama">nama</label>
                        <p id="nama">{{ $data['item']->nama }}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="penjual">penjual</label>
                        <p id="penjual">{{ $data['item']->users->name }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="harga">harga</label>
                        <p id="harga" value="{{ $data['item']->harga }}">{{ $data['item']->harga }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="stok">stok</label>
                        <p id="stok">{{ $data['item']->stok }}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <br>
                        @foreach ($data['item']->kategoris as $k)
                            <span class="badge badge-primary">{{ $k->nama }}</span>
                            <!-- Adjust field name as needed -->
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <p id="deskripsi">{{ $data['item']->deskripsi }}</p>
            </div>

            <div class="row">
                <div class="col-md-6">
                    @role('pembeli')
                    <form action="{{ route('wishlist.store') }}" method="POST">
                        @csrf
                        <button class="btn btn-secondary" type="submit" id="item_id" value="{{ $data['item']->id }}">Add to Wishlist</button>
                    </form>
                    <form action="{{ route('keranjang.store') }}" method="POST">
                        @csrf
                        <button class="btn btn-info" type="submit" id="item_id" value="{{ $data['item']->id }}">Add to Cart</button>
                    </form>
                    <div class="form-group">
                        <form action="{{ route('order.store') }}" method="POST">
                            @csrf
                            <input type="hidden" id="users_id" name="users_id" value="{{ Auth::id() }}">
                            <input type="hidden" id="status" name="status" value="pending">
                            <label for="quantity">Quantity</label>
                            <div class="input-group">
                                <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $data['item']->stok }}" onchange="updateTotal()">
                            </div>
                            <label for="total">Total</label>
                            <div class="input-group">
                                <input type="number" id="total" name="total" value="{{ $data['item']->harga }}" readonly>
                            </div>
                            <button class="btn btn-success" type="submit" name="item_id" id="item_id" value="{{ $data['item']->id }}">Place Order</button>
                        </form>
                    </div>
                    @endrole
                </div>
            </div>
            @role('admin|penjual')
            <a href="{{ route('item.edit', $data['item']->id) }}" class="btn btn-warning">Edit item</a>
            <form class="border-0" action="{{ route('item.destroy', $data['item']->id) }}" method="POST"
                style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Hapus item</button>
            </form>
            @endrole
            <a href="{{ route('item.index') }}" class="btn btn-primary">Kembali ke Daftar item</a>
        </div>
    </div>
@push('scripts')
<script>
    function updateTotal() {
        // Get the price per item from the price input field
        let harga = parseFloat(document.getElementById('harga').innerHTML);

        // Get the quantity value from the quantity input field
        let quantity = parseInt(document.getElementById('quantity').value);

        // Calculate the total
        let total = harga * quantity;

        console.log(harga);
        console.log(quantity);
        console.log(total);
        // Update the total input field with the new value
        document.getElementById('total').value = total;
    }
</script>
@endpush
@endsection
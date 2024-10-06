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
                        <label for="harga">harga</label>
                        <p id="harga">{{ $data['item']->harga }}</p>
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

            <a href="{{ route('item.index') }}" class="btn btn-primary">Kembali ke Daftar item</a>
            <a href="{{ route('item.edit', $data['item']->id) }}" class="btn btn-warning">Edit item</a>
            <form class="border-0" action="{{ route('item.destroy', $data['item']->id) }}" method="POST"
                style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Hapus item</button>
            </form>
        </div>
    </div>
@endsection

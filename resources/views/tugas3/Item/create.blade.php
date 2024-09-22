@extends('layout.template')
@section('title', 'Tambah Item')
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('item.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama">nama</label>
                    <textarea class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
                        value="{{ old('nama') }}" required></textarea>
                    @error('nama')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="harga">harga</label>
                            <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga"
                                name="harga" value="{{ old('harga') }}" required>
                            @error('harga')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stok">stok</label>
                            <input type="text" class="form-control @error('stok') is-invalid @enderror"
                                id="stok" name="stok" value="{{ old('stok') }}" required>
                            @error('stok')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kategori">Kategori</label><br>
                            <select class="selectpicker w-100" id="kategori" name="kategori[]"
                                class="form-control @error('kategori') is-invalid @enderror" multiple>
                                @foreach ($data['kategori'] as $k)
                                    <option value="{{ $k->id }}"
                                        {{ in_array($k->id, old('kategori', [])) ? 'selected' : '' }}>
                                        {{ $k->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Tambah Item</button>
                <a href="{{ route('item.index') }}" class="btn btn-warning">Kembali</a><a href="#"></a>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="/js/bootstrap-select.min.js"></script>
@endpush

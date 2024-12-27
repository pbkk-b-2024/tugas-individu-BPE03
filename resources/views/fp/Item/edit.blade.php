@extends('layout.template')

@section('title', 'Edit item')

@section('content')
    <div class="card">
        <div class="card-body">
            <form id="updateForm" action="{{ route('item.update', $data['item']->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Menandakan bahwa ini adalah request untuk update -->

                <div class="form-group">
                    <label for="nama">nama</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                        name="nama" value="{{ old('nama', $data['item']->nama) }}" required>
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
                                name="harga" value="{{ old('harga', $data['item']->harga) }}" required>
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
                                id="stok" name="stok" value="{{ old('stok', $data['item']->stok) }}"
                                required>
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
                            <label for="kategori">Kategori</label>
                            <select class="selectpicker w-100 @error('kategori') is-invalid @enderror" id="kategori"
                                name="kategori[]" multiple>
                                @foreach ($data['kategori'] as $k)
                                    <option value="{{ $k->id }}"
                                        {{ in_array($k->id, old('kategori', $data['item-kategori'])) ? 'selected' : '' }}>
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

                    {{-- <div class="col-md-6">
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <input type="text" class="form-control @error('kategori') is-invalid @enderror"
                                id="kategori" name="kategori" value="{{ old('kategori', $data['item']->kategori) }}">
                            @error('kategori')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> --}}
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $data['item']->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Foto</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                @if (Auth::check() && Auth::user()->hasRole('penjual'))
                <input type="hidden" id="users_id" name="users_id" value="{{ Auth::id() }}">
                <p>You are the seller</p>
                @else
                <div class="form-group">
                    <label for="users_id">Penjual</label><br>
                    <select class="form-control selectpicker w-100" id="users_id" name="users_id"
                        class="form-control @error('users_id') is-invalid @enderror" multiple>
                            @foreach ($data['penjual'] as $penjual)
                                <option value="{{ old('users_id', $data['item']->users_id) }}">
                                    {{ $penjual->name }}
                                </option>
                            @endforeach
                    </select>
                </div>
                @endif
                <button id="submitBtn" type="submit" class="btn btn-primary">Update item</button>
                
            </form>
            <div class="mt-3">
                <a href="{{ route('item.index') }}" class="btn btn-warning">Kembali ke Daftar item</a>
                <a href="{{ route('item.show', $data['item']->id) }}" class="btn btn-warning">
                Kembali ke Detail item</a>
                <a href="{{ route('item.destroy', $data['item']->id) }}" method="POST"
                    style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                        Hapus item</button>
                </a>
            </div>
            
        </div>
    </div>
@endsection
@push('scripts')
    <script src="/js/bootstrap-select.min.js"></script>
@endpush
@push('scripts')
    <script>
        document.getElementById('submitBtn').addEventListener('click', function() {
            document.getElementById('updateForm').submit();
        });
    </script>
@endpush

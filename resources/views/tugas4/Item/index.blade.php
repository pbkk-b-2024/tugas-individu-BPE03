@extends('layout.template')


@section('title', 'List Item')

@section('content')

    <div class="card p-3">
        <div class="">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
        <div class="d-flex flex-column flex-md-row gap-2 mb-md-0 mb-2">
            <form action="{{ route('item.index') }}" method="GET" class="mr-md-2 mr-0 mb-2 mb-md-0 flex-grow-1">
                <div class="input-group ">
                    <input type="text" name="search" class="form-control" id="search"
                        placeholder="Nama item, deskripsi item, harga, stok, kategori"
                        value="{{ request()->get('search') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </form>
            <div class="d-flex">
            {{ $data['item']->appends(['search' => request()->get('search'), 'limit' => request()->get('limit')])->links() }}
                <div class="ml-2">
                    <a href="{{ route('item.create') }}" class="text-white">
                        <button class="btn btn-success">
                            Tambah Item
                        </button>
                    </a>
                </div>
            </div>

        </div>
        <div class="overflow-auto">`
            <table id="itemTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Kategori</th>
                        <th>Gambar</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data['item'] as $b)
                        <tr>
                            <td>
                                {{ $b->id }}
                            </td>
                            <td>
                                <a href="{{ route('item.show', $b->id) }}">
                                    {{ Str::limit($b->nama, 20, '...') }}
                                </a>
                            </td>
                            <td>{{ $b->harga }}</td>
                            <td>{{ $b->stok }}</td>
                            <td>
                                @foreach ($b->kategoris as $kategori)
                                    <span class="badge badge-primary">{{ $kategori->nama }}</span>
                                    <!-- Adjust field name as needed -->
                                @endforeach
                            </td>
                            @if ($b->image)
                            <td>
                                <img src="{{ asset('storage/' . $b->image) }}"  alt="{{ $b->nama }}" width="100px" height="100px">
                            </td>
                            @else
                                <td>No image</td>
                            @endif
                            <td>{{ Str::limit($b->deskripsi, 30, '...') }}</td>
                            <td class="d-flex">
                                @can('manage-items')
                                <a href="{{ route('item.edit', $b->id) }}"
                                    class="btn btn-primary btn-sm mr-2">Edit</a>
                                <form class="border-0" action="{{ route('item.destroy', $b->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure?')">Hapus</button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No records found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
        
@endsection

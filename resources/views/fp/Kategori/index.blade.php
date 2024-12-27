@extends('layout.template')


@section('title', 'List Kategori')

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
            <form action="{{ route('kategori.index') }}" method="GET" class="mr-md-2 mr-0 mb-2 mb-md-0 flex-grow-1">
                <div class="input-group ">
                    <input type="text" name="search" class="form-control" id="search" placeholder="nama kategori"
                        value="{{ request()->get('search') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </form>
            <div class="d-flex">
                {{ $data['kategori']->appends(['search' => request()->get('search'), 'limit' => request()->get('limit')])->links() }}
                @role('admin')
                <div class="ml-2">
                    <a href="{{ route('kategori.create') }}" class="text-white">
                        <button class="btn btn-success">
                            Tambah Kategori
                        </button>
                    </a>
                </div>
                @endrole
            </div>

        </div>
        <div class="overflow-auto">`
            <table id="kategoriTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nama Kategori</th>
                        <th>Jumlah Item</th>
                        @role('admin')
                        <th>Action</th>
                        @endrole
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data['kategori'] as $kategori)
                        <tr>
                            <td>
                                {{ $kategori->id }}
                            </td>
                            <td>
                                <a href="{{ route('kategori.show', $kategori->id) }}">
                                    {{ Str::limit($kategori->nama, 20, '...') }}
                                </a>
                            </td>
                            @if(auth()->user()->hasRole('penjual'))
                            <td>{{ $kategori->items_count }}</td>
                            @else
                            <td>{{ count($kategori->items) }}</td>
                            @endif
                            @role('admin')
                            <td class="d-flex">
                                <a href="{{ route('kategori.edit', $kategori->id) }}"
                                    class="btn btn-primary btn-sm mr-2">Edit</a>
                                <form class="border-0" action="{{ route('kategori.destroy', $kategori->id) }}"
                                    method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure?')">Hapus</button>
                                </form>
                            </td>
                            @endrole
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

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#kategoriTable').DataTable({
                paging: true,
                searching: true,
                ordering: true
            });
        });
    </script>
@endpush

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
            <form action="{{ route('order.index') }}" method="GET" class="mr-md-2 mr-0 mb-2 mb-md-0 flex-grow-1">
                <div class="input-group ">
                    <input type="text" name="search" class="form-control" id="search"
                        placeholder="Nama item"
                        value="{{ request()->get('search') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </form>
            <div class="d-flex">
            {{ $data['order']->appends(['search' => request()->get('search'), 'limit' => request()->get('limit')])->links() }}
            </div>

        </div>
        @role('penjual')
        <div class="overflow-auto">`
            <table id="itemTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nama Barang</th>
                        <th>Pembeli</th>
                        <th>Harga</th>
                        <th>Kuantitas
                        <th>Total</th>
                        <th>Gambar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data['order'] as $b)
                        @if ($b->items->users_id == Auth::id())
                        <tr>
                            <td>
                                {{ $b->id }}
                            </td>
                            <td>
                                <a href="{{ route('item.show', $b->item_id) }}">
                                    {{ Str::limit($b->items->nama, 20, '...') }}
                                </a>
                            </td>
                            <td>{{ $b->users->name }}</td>
                            <td>{{ $b->items->harga }}</td>
                            <td>{{ $b->quantity }}</td>
                            <td>{{ $b->total }}</td>
                            @if ($b->items->image)
                            <td>
                                <img src="{{ asset('storage/' . $b->items->image) }}"  alt="{{ $b->items->nama }}" width="100px" height="100px">
                            </td>
                            @else
                                <td>No image</td>
                            @endif
                            <td>{{ $b->status }}</td>
                            @if ($b->status == 'pending')
                            <td class="d-flex">
                                <form class="border-0" action="{{ route('order.update', $b->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" id="users_id" name="users_id" value="{{ old('users_id', $b->users_id) }}">
                                    <input type="hidden" id="item_id" name="item_id" value="{{ old('item_id', $b->item_id) }}">
                                    <input type="hidden" id="quantity" name="quantity" value="{{ old('quantity', $b->quantity) }}">
                                    <input type="hidden" id="total" name="total" value="{{ old('total', $b->total) }}">
                                    <button type="submit" class="btn btn-primary btn-sm mr-2" id="status" name="status"
                                        value="Selesai"
                                        onclick="return confirm('Are you sure?')">Selesaikan Order</button>
                                </form>
                                <form class="border-0" action="{{ route('order.update', $b->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" id="users_id" name="users_id" value="{{ old('users_id', $b->users_id) }}">
                                    <input type="hidden" id="item_id" name="item_id" value="{{ old('item_id', $b->item_id) }}">
                                    <input type="hidden" id="quantity" name="quantity" value="{{ old('quantity', $b->quantity) }}">
                                    <input type="hidden" id="total" name="total" value="{{ old('total', $b->total) }}">
                                    <button type="submit" class="btn btn-danger btn-sm" id="status" name="status"
                                        value="Dibatalkan"
                                        onclick="return confirm('Are you sure?')">Batalkan Order</button>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @endif
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">No records found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @endrole
        @role('pembeli')
        <div class="overflow-auto">`
            <table id="itemTable" class="table table-bordered">
                <thead>
                <tr>
                        <th>id</th>
                        <th>Nama Barang</th>
                        <th>Penjual</th>
                        <th>Harga</th>
                        <th>Kuantitas
                        <th>Total</th>
                        <th>Gambar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data['order'] as $b)
                        @if ($b->users_id == Auth::id())
                        <tr>
                            <td>
                                {{ $b->id }}
                            </td>
                            <td>
                                <a href="{{ route('item.show', $b->item_id) }}">
                                    {{ Str::limit($b->items->nama, 20, '...') }}
                                </a>
                            </td>
                            <td>{{ $b->items->users->name }}</td>
                            <td>{{ $b->items->harga }}</td>
                            <td>{{ $b->quantity }}</td>
                            <td>{{ $b->total }}</td>
                            @if ($b->items->image)
                            <td>
                                <img src="{{ asset('storage/' . $b->items->image) }}"  alt="{{ $b->items->nama }}" width="100px" height="100px">
                            </td>
                            @else
                                <td>No image</td>
                            @endif
                            <td>{{ $b->status }}</td>
                            @if($b->status == 'pending')
                            <td>
                            <form class="border-0" action="{{ route('order.update', $b->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" id="users_id" name="users_id" value="{{ old('users_id', $b->users_id) }}">
                                    <input type="hidden" id="item_id" name="item_id" value="{{ old('item_id', $b->item_id) }}">
                                    <input type="hidden" id="quantity" name="quantity" value="{{ old('quantity', $b->quantity) }}">
                                    <input type="hidden" id="total" name="total" value="{{ old('total', $b->total) }}">
                                    <button type="submit" class="btn btn-danger btn-sm" id="status" name="status"
                                        value="Dibatalkan"
                                        onclick="return confirm('Are you sure?')">Batalkan Order</button>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @endif
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">No records found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @endrole
        @role('admin')
        <div class="overflow-auto">`
            <table id="itemTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nama Barang</th>
                        <th>Pembeli</th>
                        <th>Penjual</th>
                        <th>Harga</th>
                        <th>Kuantitas
                        <th>Total</th>
                        <th>Gambar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data['order'] as $b)
                        <tr>
                            <td>
                                {{ $b->id }}
                            </td>
                            <td>
                                <a href="{{ route('item.show', $b->item_id) }}">
                                    {{ Str::limit($b->items->nama, 20, '...') }}
                                </a>
                            </td>
                            <td>{{ $b->users->name }}</td>
                            <td>{{ $b->items->users->name }}</td>
                            <td>{{ $b->items->harga }}</td>
                            <td>{{ $b->quantity }}</td>
                            <td>{{ $b->total }}</td>
                            @if ($b->items->image)
                            <td>
                                <img src="{{ asset('storage/' . $b->items->image) }}"  alt="{{ $b->items->nama }}" width="100px" height="100px">
                            </td>
                            @else
                                <td>No image</td>
                            @endif
                            <td>{{ $b->status }}</td>
                            @if ($b->status == 'pending')
                            <td class="d-flex">
                                <form class="border-0" action="{{ route('order.update', $b->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" id="users_id" name="users_id" value="{{ old('users_id', $b->users_id) }}">
                                    <input type="hidden" id="item_id" name="item_id" value="{{ old('item_id', $b->item_id) }}">
                                    <input type="hidden" id="quantity" name="quantity" value="{{ old('quantity', $b->quantity) }}">
                                    <input type="hidden" id="total" name="total" value="{{ old('total', $b->total) }}">
                                    <button type="submit" class="btn btn-primary btn-sm mr-2" id="status" name="status"
                                        value="Selesai"
                                        onclick="return confirm('Are you sure?')">Selesaikan Order</button>
                                </form>
                                <form class="border-0" action="{{ route('order.update', $b->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" id="users_id" name="users_id" value="{{ old('users_id', $b->users_id) }}">
                                    <input type="hidden" id="item_id" name="item_id" value="{{ old('item_id', $b->item_id) }}">
                                    <input type="hidden" id="quantity" name="quantity" value="{{ old('quantity', $b->quantity) }}">
                                    <input type="hidden" id="total" name="total" value="{{ old('total', $b->total) }}">
                                    <button type="submit" class="btn btn-danger btn-sm" id="status" name="status"
                                        value="Dibatalkan"
                                        onclick="return confirm('Are you sure?')">Batalkan Order</button>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">No records found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @endrole
    </div>
        
@endsection

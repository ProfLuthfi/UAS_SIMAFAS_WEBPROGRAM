@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @elseif (session('failed'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('failed') }}
                    </div>
                @endif
                <div class="card-header">{{ __('Table Bookings') }}</div>

                <div class="card-body">
                    <a href="{{ route('bookings.create') }}" class="btn btn-sm btn-secondary">
                        Tambah Booking
                    </a>
                    <table class="table" id="bookings">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Booking Date</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Customer Address</th>
                                <th scope="col">Facility</th>
                                <th scope="col">Price</th>
                                <th scope="col">Long Rent</th>
                                <th scope="col">Total Rent</th>
                                <th scope="col">Cashier Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; ?>
                            @foreach($bookings as $row)
                            <?php $no++ ?>
                            <tr>
                                <th scope="row">{{ $no }}</th>
                                <td>{{$row->tgl_transaksi}}</td>
                                <td>{{$row->nama_customer}}</td>
                                <td>{{$row->alamat_customer}}</td>
                                <td>{{$row->facility?->nama_fasilitas}}</td>
                                <td>{{$row->harga_sewa}}</td>
                                <td>{{$row->lama_sewa}}</td>
                                <td>{{$row->total_sewa}}</td>
                                <td>{{$row->nama_kasir}}</td>
                                <td>
                                    <a href="{{ route('bookings.edit', $row->id) }}" class="btn btn-sm btn-warning">
                                        Edit
                                    </a>
                                    <form action="{{ route('bookings.destroy',$row->id) }}" method="POST"
                                    style="display: inline" onsubmit="return confirm('Do you really want to delete transaksi?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><span class="text-muted">
                                        Delete
                                    </span></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    new DataTable('#bookings');
</script>
@endsection

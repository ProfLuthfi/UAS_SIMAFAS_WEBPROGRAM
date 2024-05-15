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
                <div class="card-header">{{ __('Table Facilities') }}</div>

                <div class="card-body">
                    <a href="{{ route('facilities.create') }}" class="btn btn-sm btn-secondary">
                        Tambah Booking
                    </a>
                    <table class="table" id="facilities">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">nama_fasilitas</th>
                                <th scope="col">alamat</th>
                                <th scope="col">pj_fasilitas</th>
                                <th scope="col">harga_kelola</th>
                                <th scope="col">harga_sewa</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; ?>
                            @foreach($facilities as $row)
                            <?php $no++ ?>
                            <tr>
                                <th scope="row">{{ $no }}</th>
                                <td>{{$row->nama_fasilitas}}</td>
                                <td>{{$row->alamat}}</td>
                                <td>{{$row->pj_fasilitas}}</td>
                                <td>{{$row->harga_kelola}}</td>
                                <td>{{$row->harga_sewa}}</td>
                                <td>
                                    <a href="{{ route('facilities.edit', $row->id) }}" class="btn btn-sm btn-warning">
                                        Edit
                                    </a>
                                    <form action="{{ route('facilities.destroy',$row->id) }}" method="POST"
                                    style="display: inline" onsubmit="return confirm('Do you really want to delete fasilitas?');">
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
    $(document).ready(function() {
        $('#facilities').DataTable();
    });
</script>
@endsection

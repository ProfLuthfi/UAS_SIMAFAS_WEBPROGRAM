@extends('layout')

@section('content')
<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Add Bookings</div>
                    <div class="card-body">

                        <form action="{{ route('bookings.store') }}" method="POST">
                            @csrf
                            <div class="form-group row mt-3">
                                <label for="tgl_transaksi" class="col-md-4 col-form-label text-right">Tanggal Transaksi</label>
                                <div class="col-md-6">
                                    <input type="date" id="tgl_transaksi" class="form-control" name="tgl_transaksi" required autofocus>
                                    @if ($errors->has('tgl_transaksi'))
                                    <span class="text-danger">{{ $errors->first('tgl_transaksi') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="nama_customer" class="col-md-4 col-form-label text-right">Nama Customer</label>
                                <div class="col-md-6">
                                    <input type="text" id="nama_customer" class="form-control" name="nama_customer" required autofocus>
                                    @if ($errors->has('nama_customer'))
                                    <span class="text-danger">{{ $errors->first('nama_customer') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="alamat_customer" class="col-md-4 col-form-label text-right">Alamat Customer</label>
                                <div class="col-md-6">
                                    <input type="text" id="alamat_customer" class="form-control" name="alamat_customer" required autofocus>
                                    @if ($errors->has('alamat_customer'))
                                    <span class="text-danger">{{ $errors->first('alamat_customer') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="facility" class="col-md-4 col-form-label text-right">Fasilitas</label>
                                <div class="col-md-6">
                                    <select class="form-select" id="facility" name="facility" aria-label="facility">
                                        <option value="" data-val="{}">Choose</option>
                                        @foreach($facilities as $val)
                                        <option value="{{$val->id}}" data-val="{{$val}}">{{$val->nama_fasilitas}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('facility'))
                                    <span class="text-danger">{{ $errors->first('facility') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="harga_sewa" class="col-md-4 col-form-label text-right">Harga Sewa</label>
                                <div class="col-md-6">
                                    <input type="number" id="harga_sewa" class="form-control" name="harga_sewa" required>
                                    @if ($errors->has('harga_sewa'))
                                    <span class="text-danger">{{ $errors->first('harga_sewa') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="harga_kelola" class="col-md-4 col-form-label text-right">Harga Kelola</label>
                                <div class="col-md-6">
                                    <input type="number" id="harga_kelola" class="form-control" name="harga_kelola" required>
                                    @if ($errors->has('harga_kelola'))
                                    <span class="text-danger">{{ $errors->first('harga_kelola') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="lama_sewa" class="col-md-4 col-form-label text-right">Lama Sewa</label>
                                <div class="col-md-6">
                                    <input type="number" id="lama_sewa" class="form-control" name="lama_sewa" required>
                                    @if ($errors->has('lama_sewa'))
                                    <span class="text-danger">{{ $errors->first('lama_sewa') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="total_sewa" class="col-md-4 col-form-label text-right">Total Sewa</label>
                                <div class="col-md-6">
                                    <input type="number" id="total_sewa" class="form-control" name="total_sewa" required>
                                    @if ($errors->has('total_sewa'))
                                    <span class="text-danger">{{ $errors->first('total_sewa') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="nama_kasir" class="col-md-4 col-form-label text-right">Nama Kasir</label>
                                <div class="col-md-6">
                                    <input type="text" id="nama_kasir" class="form-control" name="nama_kasir" required>
                                    @if ($errors->has('nama_kasir'))
                                    <span class="text-danger">{{ $errors->first('nama_kasir') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4 mt-3 p-2 d-grid">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#facility").on('change', function() {
                var _this = JSON.parse($(this).find(':selected').attr('data-val'));
                if ($(this).find(':selected').val() > 0) {

                    $("#harga_sewa").val(_this.harga_sewa);
                    $("#harga_kelola").val(_this.harga_kelola);
                }else{
                    $("#harga_sewa").val(0);
                    $("#harga_kelola").val(0);
                }
            });

            $("#lama_sewa").on('input', function() {
                var _this = $(this).val();
                var total = parseInt($("#harga_sewa").val()) * parseInt(_this);
                console.log(total);
                $("#total_sewa").val(total);
            });
        });
    </script>
</main>
@endsection
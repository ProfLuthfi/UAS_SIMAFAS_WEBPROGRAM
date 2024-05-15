@extends('layout')

@section('content')
<main class="login-form">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Edit Booking</div>
                    <div class="card-body">

                        <form action="{{ route('bookings.update', $bookingFacility->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group row mt-3">
                                <label for="tgl_transaksi" class="col-md-4 col-form-label text-right">Tanggal Transaksi</label>
                                <div class="col-md-6">
                                    <input type="date" id="tgl_transaksi" class="form-control" name="tgl_transaksi" value="{{ $bookingFacility->tgl_transaksi }}" required autofocus>
                                    @if ($errors->has('tgl_transaksi'))
                                    <span class="text-danger">{{ $errors->first('tgl_transaksi') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="nama_customer" class="col-md-4 col-form-label text-right">Nama Customer</label>
                                <div class="col-md-6">
                                    <input type="text" id="nama_customer" class="form-control" name="nama_customer" value="{{ $bookingFacility->nama_customer }}" required autofocus>
                                    @if ($errors->has('nama_customer'))
                                    <span class="text-danger">{{ $errors->first('nama_customer') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="alamat_customer" class="col-md-4 col-form-label text-right">Alamat Customer</label>
                                <div class="col-md-6">
                                    <input type="text" id="alamat_customer" class="form-control" name="alamat_customer" value="{{ $bookingFacility->alamat_customer }}" required autofocus>
                                    @if ($errors->has('alamat_customer'))
                                    <span class="text-danger">{{ $errors->first('alamat_customer') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="facility" class="col-md-4 col-form-label text-right">Nama Fasilitas</label>
                                <div class="col-md-6">
                                    <select class="form-select" id="facility" name="facility" disabled>
                                        <option value="{{ $bookingFacility->facility->id }}" data-val="{{ $bookingFacility->facility }}">{{ $bookingFacility->facility->nama_fasilitas }}</option>
                                    </select>
                                    @if ($errors->has('facility'))
                                    <span class="text-danger">{{ $errors->first('facility') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="harga_sewa" class="col-md-4 col-form-label text-right">Harga Sewa</label>
                                <div class="col-md-6">
                                    <input type="number" id="harga_sewa" class="form-control" name="harga_sewa" value="{{ $bookingFacility->harga_sewa }}" required autofocus>
                                    @if ($errors->has('harga_sewa'))
                                    <span class="text-danger">{{ $errors->first('harga_sewa') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="harga_kelola" class="col-md-4 col-form-label text-right">Harga Kelola</label>
                                <div class="col-md-6">
                                    <input type="number" id="harga_kelola" class="form-control" name="harga_kelola" value="{{ $bookingFacility->harga_kelola }}" required autofocus>
                                    @if ($errors->has('harga_kelola'))
                                    <span class="text-danger">{{ $errors->first('harga_kelola') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="lama_sewa" class="col-md-4 col-form-label text-right">Lama Sewa</label>
                                <div class="col-md-6">
                                    <input type="number" id="lama_sewa" class="form-control" name="lama_sewa" value="{{ $bookingFacility->lama_sewa }}" required autofocus>
                                    @if ($errors->has('lama_sewa'))
                                    <span class="text-danger">{{ $errors->first('lama_sewa') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="total_sewa" class="col-md-4 col-form-label text-right">Total Sewa</label>
                                <div class="col-md-6">
                                    <input type="number" id="total_sewa" class="form-control" name="total_sewa" value="{{ $bookingFacility->total_sewa }}" required autofocus>
                                    @if ($errors->has('total_sewa'))
                                    <span class="text-danger">{{ $errors->first('total_sewa') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="nama_kasir" class="col-md-4 col-form-label text-right">Nama Kasir</label>
                                <div class="col-md-6">
                                    <input type="text" id="nama_kasir" class="form-control" name="nama_kasir" value="{{ $bookingFacility->nama_kasir }}" required autofocus>
                                    @if ($errors->has('nama_kasir'))
                                    <span class="text-danger">{{ $errors->first('nama_kasir') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4 mt-3 p-2 d-grid">
                                <button type="submit" class="btn btn-primary">
                                    Update
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
                var selectedOption = $(this).find(':selected');
                var facilityData = selectedOption.data('val') ? JSON.parse(selectedOption.attr('data-val')) : null;

                if (facilityData && selectedOption.val() > 0) {
                    $("#harga_sewa").val(facilityData.harga_sewa);
                    $("#harga_kelola").val(facilityData.harga_kelola);
                } else {
                    $("#harga_sewa").val(0);
                    $("#harga_kelola").val(0);
                }
                updateTotalSewa();
            });

            $("#lama_sewa").on('input', function() {
                updateTotalSewa();
            });

            function updateTotalSewa() {
                var lamaSewa = parseInt($("#lama_sewa").val()) || 0;
                var hargaSewa = parseInt($("#harga_sewa").val()) || 0;
                var totalSewa = hargaSewa * lamaSewa;
                $("#total_sewa").val(totalSewa);
            }

            updateTotalSewa();
        });
    </script>
</main>
@endsection

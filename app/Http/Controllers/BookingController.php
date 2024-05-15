<?php

namespace App\Http\Controllers;

use App\Models\BookingFacility;
use App\Models\Facility;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = BookingFacility::all();
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $facilities = Facility::all();
        return view('bookings.create', compact('facilities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tgl_transaksi' => 'required|date',
            'nama_customer' => 'required|string|max:255',
            'alamat_customer' => 'required|string|max:255',
            'harga_sewa' => 'required|numeric',
            'harga_kelola' => 'required|numeric',
            'lama_sewa' => 'required|integer',
            'total_sewa' => 'required|numeric',
            'nama_kasir' => 'required|string|max:255',
            'facility' => 'required|exists:facilities,id',
        ]);

        $already = BookingFacility::where(['tgl_transaksi' => $request->tgl_transaksi, 'id_facility' => $request->facility]);

        if ($already->count() > 0) {
            return redirect()->route('bookings.index')->with('error', $already->first()->facility->nama_fasilitas . ' already booked!');
        }

        try {
            $check = BookingFacility::create([
                'tgl_transaksi' => $request->tgl_transaksi,
                'nama_customer' => $request->nama_customer,
                'alamat_customer' => $request->alamat_customer,
                'harga_sewa' => $request->harga_sewa,
                'harga_kelola' => $request->harga_kelola,
                'lama_sewa' => $request->lama_sewa,
                'total_sewa' => $request->total_sewa,
                'nama_kasir' => $request->nama_kasir,
                'id_facility' => $request->facility,
            ]);

            return redirect()->route('bookings.index')->withSuccess('Great! You have booked ' . $check->facility->nama_fasilitas);
        } catch (\Throwable $th) {
            return redirect()->route('bookings.index')->withFailed('Failed to book: ' . $th->getMessage());
        }
    }

    public function edit($id)
    {
        $facilities = Facility::all();
        $bookingFacility = BookingFacility::find($id);
        return view('bookings.edit', compact('bookingFacility', 'facilities'));
    }

    public function update(Request $request, $id)
    {
        $bookingFacility = BookingFacility::find($id);

        $request->validate([
            'tgl_transaksi' => 'required|date',
            'nama_customer' => 'required|string|max:255',
            'alamat_customer' => 'required|string|max:255',
            'harga_sewa' => 'required|numeric',
            'harga_kelola' => 'required|numeric',
            'lama_sewa' => 'required|integer',
            'total_sewa' => 'required|numeric',
            'nama_kasir' => 'required|string|max:255',
            'facility' => 'nullable|exists:facilities,id',
        ]);

        try {
            $data = [
                'tgl_transaksi' => $request->tgl_transaksi,
                'nama_customer' => $request->nama_customer,
                'alamat_customer' => $request->alamat_customer,
                'harga_sewa' => $request->harga_sewa,
                'harga_kelola' => $request->harga_kelola,
                'lama_sewa' => $request->lama_sewa,
                'total_sewa' => $request->total_sewa,
                'nama_kasir' => $request->nama_kasir,
            ];

            if ($request->filled('facility')) {
                $data['id_facility'] = $request->facility;
            }

            $bookingFacility->update($data);

            return redirect()->route('bookings.index')->withSuccess('Booking updated successfully!');
        } catch (\Throwable $th) {
            return redirect()->route('bookings.index')->withFailed('Failed to update booking: ' . $th->getMessage());
        }
    }

    public function destroy($id)
    {
        $bookingFacility = BookingFacility::find($id);
        if ($bookingFacility->delete()) {
            return redirect()->route('bookings.index')->withSuccess('Booking deleted successfully!');
        } else {
            return redirect()->route('bookings.index')->withFailed('Failed to delete booking.');
        }
    }
}

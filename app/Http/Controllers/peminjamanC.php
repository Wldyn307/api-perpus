<?php

namespace App\Http\Controllers;

use App\Models\peminjamanM;
use Illuminate\Http\Request;
use App\Http\Resources\peminjamanR;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class peminjamanC extends Controller
{
    public function index()
    {
        $peminjaman = peminjamanM::all();
        return new peminjamanR(true, 'List data peminjaman', $peminjaman);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'id_buku' => 'required',
            'id_user' => 'required',
            'tanggal_peminjaman' => 'required',
            'tanggal_kembali' => 'required',
            'denda' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $peminjaman = peminjamanM::create([
            'id_buku' => $request->id_buku,
            'id_user' => $request->id_user,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'tanggal_kembali' => $request->tanggal_kembali,
            'denda' => $request->denda,
        ]);

        return new peminjamanR(true,'Data peminjaman Berhasil Di Tambahkan!', $peminjaman);
    }

    public function show(peminjamanM $peminjaman){
        return new peminjamanR(true, 'Data peminjaman Di Temukan!', $peminjaman);
    }
    public function update(Request $request, peminjamanM $peminjaman){
        $validator = Validator::make($request->all(), [
            'id_buku' => 'required',
            'id_user' => 'required',
            'tanggal_peminjaman' => 'required',
            'tanggal_kembali' => 'required',
            'denda' => 'required',
        ]);
        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
            $peminjaman->update([
                'id_buku' => $request->id_buku,
                'id_user' => $request->id_user,
                'tanggal_peminjaman' => $request->tanggal_peminjaman,
                'tanggal_kembali' => $request->tanggal_kembali,
                'denda' => $request->denda,
            ]);
        return new peminjamanR(true, 'Data peminjaman Berhasil Diubah!', $peminjaman);
    }

    public function destroy(peminjamanM $peminjaman){
        $peminjaman->delete();

        return new peminjamanR(true, 'Data peminjaman Berhasil Dihapus!', null);
    }
}
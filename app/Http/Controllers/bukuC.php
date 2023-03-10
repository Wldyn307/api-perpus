<?php

namespace App\Http\Controllers;

use App\Models\bukuM;
use Illuminate\Http\Request;
use App\Http\Resources\bukuR;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class bukuC extends Controller
{
    public function index()

    {
        $buku = bukuM::latest()->paginate(5);

        return new bukuR(true, 'List Data buku', $buku);
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'cover' => 'required|mimes:jpeg,png,jpg,gif,svg,webm',
            'nama_buku' => 'required',
            'penerbit' => 'required',
            'jumlah_halaman' => 'required',
            'summary' => 'required',
            'qty' => 'required',
            'tahun_rilis' => 'required',

        ]);
        
        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $cover = $request->file('cover');
        $cover -> storeAS('public/buku', $cover->hashName());

        $buku = bukuM::create([
            'cover' => $cover->hashName(),
            'nama_buku' => $request->nama_buku,
            'penerbit' => $request->penerbit,
            'jumlah_halaman' => $request->jumlah_halaman,
            'summary' => $request->summary,
            'qty' => $request->qty,
            'tahun_rilis' => $request->tahun_rilis,
        ]);
        return new bukuR(true, 'Data buku Berhasil Ditambahkan!', $buku);
    }

    public function show(bukuM $buku){
        return new bukuR(true, 'Data buku Ditemukan!', $buku);
    }

    public function update(Request $request, bukuM $buku){
        $validator = Validator::make($request->all(),[
            'nama_buku' => 'required',
            'penerbit' => 'required',
            'jumlah_halaman' => 'required',
            'summary' => 'required',
            'qty' => 'required',
            'tahun_rilis' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('cover')){
            $cover = $request->file('cover');
            $cover->storeAs('public/buku', $cover->hashName());

            Storage::delete('public/buku/'.$buku->$cover);

            $buku->update([
                'cover' => $cover->hashName(),
                'nama_buku' => $request->nama_buku,
                'penerbit' => $request->penerbit,
                'jumlah_halaman' => $request->jumlah_halaman,
                'summary' => $request->summary,
                'qty' => $request->qty,
                'tahun_rilis' => $request->tahun_rilis,
            ]);

        }else{

            $buku->update([
              
                'nama_buku' => $request->nama_buku,
                'penerbit' => $request->penerbit,
                'jumlah_halaman' => $request->jumlah_halaman,
                'summary' => $request->summary,
                'qty' => $request->qty,
                'tahun_rilis' => $request->tahun_rilis,
            ]);
        }

        return new bukuR(true, 'Data buku Berhasil Diubah!', $buku);
    }

    public function destroy(bukuM $buku){
        Storage::delete('public/buku/'.$buku->cover);

        $buku->delete();

        return new bukuR(true, 'Data buku Berhasil Dihapus!', null);
    }

}
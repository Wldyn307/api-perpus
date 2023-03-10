<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bukuM extends Model
{
    use HasFactory;

    protected $table = 'buku';
    protected $fillable = [
            'cover'    ,    
            'nama_buku' ,                 
            'penerbit'  ,               
            'jumlah_halaman',            
            'summary',    
            'qty',        
            'tahun_rilis'
    ];
}
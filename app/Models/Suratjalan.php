<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suratjalan extends Model
{
    use HasFactory;
    protected $table = 'suratjalan';
    protected $primaryKey = 'id_suratjalan'; 
    protected $fillable = [
        'kode_Suratjalan',
        'tanggal_kirim',
        'keterangan',
    ];


    public function barangSuratJalan()
{
    return $this->belongsToMany(BarangSuratPO::class, 'suratjalan_barang', 'id_suratjalan', 'id_barang_suratpo');
}
}

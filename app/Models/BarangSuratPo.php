<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangSuratPo extends Model
{
    use HasFactory;
    protected $table = 'barang_suratpo';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function jadwalBarang()
    {
        return $this->belongsTo(Suratpo::class, 'id_suratpo', 'kode_po');
    }

    public function suratpo()
    {
        return $this->belongsTo(Suratpo::class, 'id_suratpo', 'kode_po');
    }

    public function suratjalan()
    {
        return $this->belongsToMany(SuratJalan::class, 'suratjalan_barang', 'id_barang_suratpo', 'id_suratjalan')
            ->withPivot('quantity_kirim'); 
    }

}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Suratpo;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'id_barang';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'quantity',
    ];

    public function suratpos()
{
    return $this->belongsToMany(Suratpo::class, 'barang_suratpo', 'id_suratpo','id_barang')
        ->withPivot('quantity_po', 'price', 'total_price', 'jadwal_barang', 'status_deliv')
        ->withTimestamps();
}

public function barangSuratPo()
    {
        return $this->hasMany(BarangSuratPo::class, 'id_barang');
    }

    public function suratjalan()
    {
        return $this->hasMany(Suratjalan::class, 'nama_supplier', 'nama_supplier');
    }

    public function penerimaan()
    {
        return $this->hasMany(Penerimaan::class, 'nama_supplier', 'nama_supplier');
    }
}

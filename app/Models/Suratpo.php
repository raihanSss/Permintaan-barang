<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suratpo extends Model
{
    use HasFactory;
    protected $table = 'suratpo';
    protected $primaryKey = 'kode_po';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'kode_po',
        'id_supplier',
        'periode',
        'tanggal_po',
        'status',
        'keterangan_po'
    ];

    public function supplier()
{
    return $this->belongsTo(Supplier::class, 'id_supplier');
}

public function barangs()
{
    return $this->belongsToMany(Barang::class, 'barang_suratpo', 'id_suratpo', 'id_barang')
        ->withPivot('quantity_po', 'quantity_kirim', 'price', 'total_price', 'jadwal_barang', 'status_deliv')
        ->withTimestamps();
}

}

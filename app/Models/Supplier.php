<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'suppliers';
    protected $primaryKey = 'id_supplier';
    protected $fillable = [
        'nama_supplier',
        'alamat_supplier',
        'no_telp_supplier',
    ];

    public function suratpo()
    {
        return $this->hasMany(Suratpo::class, 'nama_supplier', 'nama_supplier');
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

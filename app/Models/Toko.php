<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    public $primaryKey = 'id';

    protected $table = 'toko';

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_toko',
        'kode_toko',
        'alamat',
        'kecamatan',
        'kelurahan',
        'kota',
        'provinsi',
        'lng',
        'lat',
        'proses_menjual',
        'terjual',
        'dikembalikan',
        'dibuat_oleh'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'dibuat_oleh'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}

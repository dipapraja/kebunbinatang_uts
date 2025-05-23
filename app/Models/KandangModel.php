<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KandangModel extends Model
{
    use HasFactory;
    protected $table = 'kandang';
    protected $primaryKey = 'id_kandang';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nama_kandang', 'tipe_kandang', 'kapasitas'];

    // KandangModel.php
    public function hewan()
    {
        return $this->hasMany(HewanModel::class, 'id_kandang');
    }
}
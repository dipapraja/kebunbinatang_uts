<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HewanModel extends Model
{
    use HasFactory;
    protected $table = 'hewan';
    protected $primaryKey = 'id_hewan';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nama_hewan', 'spesies', 'jenis_kelamin', 'tanggal_lahir', 'id_kandang'];
    public $timestamps = false; 
    
    
        public function kandang()
    {
        return $this->belongsTo(KandangModel::class, 'id_kandang');
    }
}

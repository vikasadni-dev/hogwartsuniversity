<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dosen extends Model
{
    protected $fillable = [
        'nip',
        'nama',
        'email',
        'jenis_kelamin',
        'departemen',
    ];
    use HasFactory;

    public function MataKuliah()
    {
        return $this->hasMany(MataKuliah::class);
    }
}

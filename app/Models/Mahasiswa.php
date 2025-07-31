<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model
{
    protected $fillable = [
    'nim',
    'nama',
    'email',
    'asrama',
    'jenis_kelamin',
    'tanggal_lahir',
    'alamat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

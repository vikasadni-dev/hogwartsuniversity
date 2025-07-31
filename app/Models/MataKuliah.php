<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MataKuliah extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'kode', 'sks', 'semester', 'jurusan_id', 'dosen_id'];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

}

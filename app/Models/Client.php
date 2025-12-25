<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients'; // pastikan sesuai nama tabel di database
    protected $fillable = ['name', 'logo', 'status']; // sesuaikan kolom yang kamu punya

}

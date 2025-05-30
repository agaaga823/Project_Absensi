<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kantor extends Model
{
    use HasFactory;

    protected $table = 'kantor'; // karena nama tabel kamu "kantor"
    protected $fillable = ['nama', 'latitude', 'longitude', 'radius'];
}
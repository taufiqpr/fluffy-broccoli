<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userModels extends Model {

    use HasFactory;

    protected $table = 'userModels';

    protected $fillable = [
        'nama', 'tanggal_lahir', 'jenis_kelamin', 'agama', 'alamat', 'no_hp', 'email'
    ];

    public $timestamps = false; 
}

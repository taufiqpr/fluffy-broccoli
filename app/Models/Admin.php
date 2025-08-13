<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable {
    protected $table = 'admins';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'email', 'passsword', 'role']
}

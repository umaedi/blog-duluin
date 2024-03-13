<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Setting extends Model
{
    use HasRoles;
    protected $table = 'setting';
    protected $guarded = [];	
}

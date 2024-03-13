<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Dashboard\Articles;

class Categories extends Model
{
    use HasFactory, LogsActivity;
	
	protected $table = 'categories';
	protected $guarded = [];
    public $incrementing = true;

	
	public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                ->logOnly(['name','created_by'])
                ->setDescriptionForEvent(fn(string $eventName) => "This category has been {$eventName}")
                ->useLogName('Category');
    }
	
	public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
	
	public function articles()
    {
        return $this->hasMany(Articles::class, 'category_id');
    }
	
}

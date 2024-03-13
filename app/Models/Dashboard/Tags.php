<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\User;

class Tags extends Model
{
    use HasFactory, LogsActivity;
	
	protected $table = 'tags';
	protected $guarded = [];
    public $incrementing = true;

	
	public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                ->logOnly(['name','created_by'])
                ->setDescriptionForEvent(fn(string $eventName) => "This tags has been {$eventName}")
                ->useLogName('Tags');
    }
	
	public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
	
	
}

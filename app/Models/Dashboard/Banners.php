<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Str;

class Banners extends Model
{
    use HasFactory, LogsActivity;
	
	protected $table = 'banners';
	protected $keyType = 'string';
	protected $guarded = [];
    public $incrementing = false;

	
	public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                ->logOnly(['name','created_by'])
                ->setDescriptionForEvent(fn(string $eventName) => "This banners has been {$eventName}")
                ->useLogName('Banners');
    }
	
	public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
	
}

<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Str;
use App\Models\Dashboard\Careers;

class Applicants extends Model
{
    use HasFactory, LogsActivity;
	
	protected $table = 'applicants';
	protected $keyType = 'string';
	protected $guarded = [];
    public $incrementing = false;

	
	public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                //->logOnly(['name','created_by'])
                ->setDescriptionForEvent(fn(string $eventName) => "This applicants has been {$eventName}")
                ->useLogName('Applicants');
    }
	
	public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
	
	public function careers()
    {
        return $this->hasMany(Careers::class);
    }
	
	public function career()
    {
        return $this->belongsTo(Careers::class);
    }
	
}

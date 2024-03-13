<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Dashboard\Categories;

class Articles extends Model
{
    use HasFactory, LogsActivity;
	
	protected $table = 'articles';
	protected $keyType = 'string';
	protected $guarded = [];
    public $incrementing = false;

	
	public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
				->dontLogIfAttributesChangedOnly(['viewer'])
                ->logOnly(['name','created_by'])
                ->setDescriptionForEvent(fn(string $eventName) => "This articles has been {$eventName}")
                ->useLogName('Article');
				
    }
	
	public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
	
	public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
	
	public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
	
	public function publisher()
    {
        return $this->belongsTo(User::class, 'publish_by');
    }
	
}

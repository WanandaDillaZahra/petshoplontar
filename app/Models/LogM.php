<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class LogM extends Model
{
    use HasFactory, Searchable;
    protected $table = "log";
    protected $fillable = ["id", "id_user", "activity"];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['id_user', 'activity']);
    }

    public function searchableAs()
    {
        return 'log';
    }

    public function toSearchableArray()
    {
        return [
            'created_at'     => $this->created_at,
        ];
    }
}

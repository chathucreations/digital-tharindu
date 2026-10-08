<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Setting extends Model
{
    use LogsActivity;

    protected $fillable = [
        'key',
        'value',
        'group',
    ];

    public $timestamps = true;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('settings')
            ->setDescriptionForEvent(fn (string $eventName) => match ($eventName) {
                'created' => 'Setting created',
                'updated' => 'Setting updated',
                'deleted' => 'Setting deleted',
                default => $eventName,
            });
    }
}

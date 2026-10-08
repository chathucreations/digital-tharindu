<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ContactMessage extends Model
{
    use LogsActivity;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('contact')
            ->setDescriptionForEvent(fn (string $eventName) => match ($eventName) {
                'created' => 'Contact message received',
                'updated' => 'Contact message updated',
                'deleted' => 'Contact message deleted',
                default => $eventName,
            });
    }
}

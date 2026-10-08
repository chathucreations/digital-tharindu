<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Slider extends Model
{
    /** @use HasFactory<\Database\Factories\SliderFactory> */
    use HasFactory, LogsActivity;

    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'link',
        'button_text',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('slider')
            ->setDescriptionForEvent(fn (string $eventName) => match ($eventName) {
                'created' => 'Slider created',
                'updated' => 'Slider updated',
                'deleted' => 'Slider deleted',
                default => $eventName,
            });
    }
}

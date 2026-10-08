<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Invoice extends Model
{
    /** @use HasFactory<\Database\Factories\InvoiceFactory> */
    use HasFactory, LogsActivity;

    protected $fillable = [
        'order_id',
        'invoice_number',
        'pdf_path',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('invoice')
            ->setDescriptionForEvent(fn (string $eventName) => match ($eventName) {
                'created' => 'Invoice generated',
                'updated' => 'Invoice updated',
                'deleted' => 'Invoice deleted',
                default => $eventName,
            });
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'name', 'phone', 'email', 'event_type', 'event_date',
        'event_location', 'needs', 'is_read', 'read_at', 'ip_address',
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_read'    => 'boolean',
        'read_at'    => 'datetime',
    ];

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function markAsRead(): void
    {
        $this->update(['is_read' => true, 'read_at' => now()]);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'address', 'archived_at'];

    protected $casts = [
        'archived_at' => 'datetime',
    ];

    public function measurements()
    {
        return $this->hasMany(Measurement::class);
    }

    public function scopeActive($query)
    {
        return $query->whereNull('archived_at');
    }

    public function scopeArchived($query)
    {
        return $query->whereNotNull('archived_at');
    }
}
// the Archiving feature is a soft delete feature that allows you to mark a client as archived without actually deleting the record from the database. This is useful for keeping historical data and for restoring clients if needed.
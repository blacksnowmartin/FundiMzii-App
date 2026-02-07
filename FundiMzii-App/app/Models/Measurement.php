<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Measurement extends Model
{
    protected $fillable = [
        'client_id',
        'chest',
        'waist',
        'hip',
        'length',
        'sleeve_length',
        'shoulder_width',
        'inseam',
        'notes',
        'measurement_date',
        'photo_path'
    ];

    protected $casts = [
        'measurement_date' => 'date',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
?>

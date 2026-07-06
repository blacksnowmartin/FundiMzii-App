<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    protected $fillable = [
        'client_id', 'measurement_date', 'chest', 'waist', 'hips', 'shoulder', 'sleeve', 'inseam', 'notes', 'photos'
    ];

    protected $casts = [
        'measurement_date' => 'date',
        'photos' => 'array',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
// remember to run the migration for the measurements table after creating this model. You can do this by running the following command:
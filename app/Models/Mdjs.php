<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mdj extends Model
{
    use HasFactory;

    protected $table = 'mdjs';

    protected $fillable = [
        'name',
        'location',
        'objective',
        'tagline',
        'street',
        'dispositif_particulier',
        'number',
        'postal_code',
        'city',
        'email',
        'site',
        'facebook',
        'instagram',
        'tel',
        'slug',
        'region',
        'active'
    ]; // Attributs assignables en masse

    public function dispositifParticulier()
    {
        return $this->belongsTo(DispositifParticulier::class, 'dispositif_particulier');
    }
}

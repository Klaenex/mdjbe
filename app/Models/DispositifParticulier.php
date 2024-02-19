<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DispositifParticulier extends Model
{
    use HasFactory;

    protected $table = 'dispositif_particulier';

    protected $fillable = [
        'name',
        'desc',
    ];
}

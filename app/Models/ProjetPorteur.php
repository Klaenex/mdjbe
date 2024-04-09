<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjetPorteur extends Model
{
    use HasFactory;

    protected $table = 'projet_porteur';

    protected $fillable = [
        'name'
    ];
    public function mdjs()
    {
        return $this->belongsTo(Mdjs::class, 'mdj_id');
    }
}

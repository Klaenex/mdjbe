<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    /**
     * La table associée au modèle.
     *
     * @var string
     */
    protected $table = 'images';

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'path',
        'logo',
        'desc',
        'ext',
        'mdj_id',
    ];

    /**
     * Les attributs qui doivent être cachés pour l'array.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * Les attributs qui doivent être castés en types natifs.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'logo' => 'boolean',
    ];

    /**
     * Obtenez la maison de jeune associée à l'image.
     */
    public function mdj()
    {
        return $this->belongsTo(Mdj::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Plante extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'image',
        'prix',
        'categories_id'
    ];

    // protected static function booted()
    // {
    //     static::creating(function ($plante) {
    //         if (empty($plante->slug)) {
    //             $plante->slug = Str::slug($plante->nom);
    //         }
    //     });

    //     static::updating(function ($plante) {
    //         if (empty($plante->slug)) {
    //             $plante->slug = Str::slug($plante->nom);
    //         }
    //     });
    // }
    use HasSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nom')
            ->saveSlugsTo('slug');
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categories_id');
    }

}

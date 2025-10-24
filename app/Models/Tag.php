<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    protected $fillable = ['name','slug'];

    protected static function booted()
    {
        static::saving(function ($tag) {
            if (blank($tag->slug)) {
                $tag->slug = Str::slug($tag->name);
            }
        });
    }

    // Quando avremo gli articoli:
    // public function articles() { return $this->belongsToMany(\App\Models\Article::class); }
}

<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = ['name','slug'];

    // genera slug automaticamente se non fornito
    protected static function booted()
    {
        static::saving(function ($cat) {
            if (blank($cat->slug)) {
                $cat->slug = Str::slug($cat->name);
            }
        });
    }

    // (per quando avremo gli articoli)
    public function articles()
    {
        return $this->hasMany(\App\Models\Article::class);
    }
}

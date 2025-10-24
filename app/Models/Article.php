<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    protected $fillable = [
        'user_id','category_id','title','subtitle','slug','body',
        'cover_image','reading_minutes','status'
    ];

    // relazioni
    public function user()     { return $this->belongsTo(User::class); }
    public function category() { return $this->belongsTo(Category::class); }
    public function tags()     { return $this->belongsToMany(Tag::class); }

    // boot: slug + reading_minutes
    protected static function booted()
    {
        static::saving(function ($a) {
            if (blank($a->slug)) {
                $a->slug = Str::slug($a->title);
            }
            // calcolo minuti lettura ~200 parole/min
            $words = str_word_count(strip_tags($a->body));
            $a->reading_minutes = max(1, (int)ceil($words / 200));
        });
    }

    // helper stato
    public function scopeInRevisione($q){ return $q->where('status','in_revisione'); }
}

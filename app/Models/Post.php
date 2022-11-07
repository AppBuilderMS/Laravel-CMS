<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = [
        'published_at'
    ];

    protected $guarded = [];

    public function deleteImage()
    {
        Storage::disk('public')->delete($this->image);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    //Check if post has tag
    public function hasTag($tagId)
    {
        return in_array($tagId, $this->tags->pluck('id')->toArray());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //published scope
    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', now());
    }

    //serch scope
    public function scopeSearched($query)
    {
        $search = request()->query('search');
        if(!$search){
            return $query->published();
        }

        return $query->published()->where('name', 'LIKE', "%{$search}%");
    }
}

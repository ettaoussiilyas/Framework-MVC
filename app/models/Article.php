<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Core\Database;

class Article extends Model
{
    protected $table = 'articles';
    
    protected $fillable = [
        'title',
        'content',
        'slug',
        'published_at'
    ];

    // Enable timestamps (created_at & updated_at)
    public $timestamps = true;

    protected static $db;

    public static function init()
    {
        self::$db = new Database();
    }

    public static function all($columns = ['*'])
    {
        return parent::all($columns);
    }

    public static function deleteArticle($id)
    {
        return static::where('id', $id)->delete();
    }

    // Get article's author (if we add relationship later)
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Auto-generate slug from title
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = $this->createSlug($value);
    }

    // Helper method to create unique slug
    protected function createSlug($title)
    {
        $slug = strtolower(str_replace(' ', '-', $title));
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
        
        // Check if slug exists
        $count = static::where('slug', 'LIKE', $slug . '%')->count();
        
        return $count ? "{$slug}-{$count}" : $slug;
    }

    // Scope for published articles
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
                    ->where('published_at', '<=', now());
    }
} 
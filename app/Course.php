<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Public URL for the course card image.
     * Supports absolute URLs (e.g. seeded placeholders) and paths under public/images/.
     */
    public function getThumbnailUrlAttribute(): string
    {
        return self::resolveThumbnailUrl($this->attributes['thumbnail'] ?? null);
    }

    public static function resolveThumbnailUrl(?string $thumbnail): string
    {
        if ($thumbnail === null || $thumbnail === '') {
            return asset('images/learning.jpg');
        }

        if (Str::startsWith($thumbnail, ['http://', 'https://', '//'])) {
            return $thumbnail;
        }

        return asset('images/'.ltrim($thumbnail, '/'));
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeVisibleInCatalog($query)
    {
        return $query->where('visibility', true);
    }

    public function review()
    {
        $user = auth()->user();
        if ($user === null) {
            return null;
        }

        return $this->reviews()->whereUserId($user->id)->whereCourseId($this->id)->first();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getAverageAttribute(): int
    {
        $user = auth()->user();
        if ($user === null) {
            return 0;
        }

        $avg = $this->reviews()->where('user_id', $user->id)->avg('rating');

        return (int) ($avg ?? 0);
    }
}

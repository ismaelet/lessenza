<?php

namespace App\Models;

use App\Helpers\FileHelper;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'text',
        'video_url',
    ];

    public function hasVideo(): Attribute
    {
        return Attribute::make(
            get: fn (): bool => ! empty($this->video_url)
        );
    }

    /**
     * Get the date the post was created in a human-readable format
     */
    public function date(): string
    {
        return $this->created_at->translatedFormat('j F Y');
    }

    /**
     * Get the URL of the post
     */
    public function url(): string
    {
        return route('posts.show', ['post' => $this->id]);
    }

    /**
     * Get the URL for the post image
     */
    public function image(string $size = 'full'): ?string
    {
        $imagePath = 'blog/'.$this->id.'-'.$size.'.webp';

        if (! FileHelper::exists($imagePath)) {
            return null;
        }

        $fileTime = @filemtime(storage_path('app/public/'.$imagePath));

        return public_asset($imagePath.($fileTime ? '?v='.$fileTime : ''));
    }

    /**
     * Get a short version of the post text
     */
    public function snippet(int $charLimit = 100): string
    {
        if (strlen($this->text) > $charLimit + 3) {
            return substr($this->text, 0, $charLimit).'...';
        }

        return $this->text;
    }

    /**
     * Get the related posts.
     * This method retrieves the latest 5 posts excluding the current one.
     */
    public function relatedPosts(): Collection
    {
        return self::where('id', '!=', $this->id)
            ->latest()
            ->take(5)
            ->get();
    }
}

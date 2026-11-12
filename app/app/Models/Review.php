<?php

namespace App\Models;

use App\Helpers\FileHelper;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'location',
        'text',
        'rating',
        'website',
    ];

    /**
     * Get the image URL for the review.
     */
    public function image(): ?string
    {
        $imagePath = 'reviews/'.$this->id.'.webp';

        if (! FileHelper::exists($imagePath)) {
            return null;
        }

        return '/storage/app/public/'.$imagePath;
    }

    /**
     * Check if the review has an image.
     */
    public function hasImage(): bool
    {
        return FileHelper::exists('reviews/'.$this->id.'.webp');
    }

    /**
     * Get the icon URL for the review.
     */
    public function icon(): ?string
    {
        $imagePath = 'reviews/'.$this->id.'-icon.webp';

        if (! FileHelper::exists($imagePath)) {
            return null;
        }

        return '/storage/app/public/'.$imagePath;
    }

    /**
     * Check if the review has an image.
     */
    public function hasIcon(): bool
    {
        return FileHelper::exists('reviews/'.$this->id.'-icon.webp');
    }
}

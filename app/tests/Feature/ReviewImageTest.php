<?php

use App\Models\Review;
use Illuminate\Support\Facades\Storage;

it('uses public storage URLs for review images and logos', function () {
    Storage::fake('public');
    Storage::disk('public')->put('reviews/8.webp', 'image');
    Storage::disk('public')->put('reviews/8-icon.webp', 'logo');

    $review = new Review;
    $review->id = 8;

    expect($review->hasImage())->toBeTrue()
        ->and($review->hasIcon())->toBeTrue()
        ->and($review->image())->toBe(asset('storage/reviews/8.webp'))
        ->and($review->icon())->toBe(asset('storage/reviews/8-icon.webp'));
});

it('omits review images and logos when their files are missing', function () {
    Storage::fake('public');

    $review = new Review;
    $review->id = 8;

    expect($review->hasImage())->toBeFalse()
        ->and($review->hasIcon())->toBeFalse()
        ->and($review->image())->toBeNull()
        ->and($review->icon())->toBeNull();
});

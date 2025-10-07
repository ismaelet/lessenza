<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser {

    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast
     */
    protected function casts(): array {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Attribute: Get the username
     */
    public function name(): Attribute {
        return Attribute::make(
            get: fn(?string $value): string => $value ?: $this->email,
        );
    }

    /**
     * Attribute: Get the user's full name
     */
    public function fullName(): Attribute {
        return Attribute::make(
            get: fn(): string => trim("{$this->first_name} {$this->last_name}")
        );
    }

    /**
     * Attribute: Get whether the user is an admin
     */
    public function isAdmin(): Attribute {
        return Attribute::make(
            get: fn(): bool => $this->admin,
        );
    }

    /**
     * Relationship: Get the user's main address
     */
    public function main_address(): HasOne {
        return $this->hasOne(Address::class)->latest();
    }

    /**
     * Relationship: Get the user's ongoing cart
     */
    public function cart(): HasOne {
        return $this->hasOne(Order::class)->where('status', false)->latest();
    }

    /**
     * Relationship: Get the user's completed orders
     */
    public function orders(): HasMany {
        return $this->hasMany(Order::class)->whereNot('status', false);
    }

    /**
     * Whether the user can access the Filament admin panel
     */
    public function canAccessPanel(Panel $panel): bool {
        return $this->is_admin;
    }
}

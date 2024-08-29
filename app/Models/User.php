<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'user_type',
        'email',
        'password',
        'last_login',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get cleaned up User data for API response
     * Change field names to hide db fields
     * Format datetime to readable format
     */
    public function getCleanUserData(): object
    {

        $cleanUser = (object) array();
        $cleanUser->forename = $this->first_name;
        $cleanUser->surname = $this->last_name;
        $cleanUser->emailAddress = $this->email;
        $cleanUser->userLevel = $this->user_type;
        $cleanUser->creationDatetime = $this->created_at->format("d/m/Y H:i");

        return $cleanUser;
    }
}

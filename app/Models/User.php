<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    use HasFactory, Notifiable;

    // Point to your existing tuser table
    protected $table = 'tuser';  

    // Define the primary key if it's different from the default `id`
    protected $primaryKey = 'iduser'; 

    // Disable timestamps if your table doesn't use them
    public $timestamps = false;  

    // You can also define other fields such as 'name' if they're different
    protected $fillable = [
        'user_id', 'user_password',
    ];

}

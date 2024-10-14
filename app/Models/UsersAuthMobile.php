<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Str;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UsersAuthMobile extends Model
{
    protected $table = 'users_auth_mobile';
    public $timestamps = false;
    protected $fillable = [
		'bearer',
        'users_id',
    ];

	//******************************************************************
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }

    //******************************************************************
    public static function createToken(): string
    {
        return sha1(Str::random(40)).sha1(Str::random(40));
    }
}

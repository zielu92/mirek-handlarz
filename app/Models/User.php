<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'is_admin', 'photo_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * checking if admin is an admin
     * @return bool
     */
    public function isAdmin() {
        return $this->is_admin==1 ? true : false;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function photo() {
        return $this->belongsTo('App\Models\Photo');
    }
}

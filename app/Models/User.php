<?php

namespace Lago\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $table = 'users';

    // fields in db that are fillable
    protected $fillable = [
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getName() {

        // check db if both first and last name exist
        // model->database column
        if ($this->first_name && $this->last_name) {
            return "{$this->first_name} {$this->last_name}";
        }

        if ($this->first_name) {
            return $this->first_name;
        }

        // if nothing found then return null
        return null;

    }

    public function getNameOrUsername() {
        // if getName() fails then get username
        return $this->getName() ?: $this->username;
    }

    public function getFirstNameOrUsername() {
        return $this->first_name ?: $this->username;
    }

}

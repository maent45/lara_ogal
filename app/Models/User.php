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

    // set belongs to many relationship between this user and friends
    // 'friendsOfMine' finds the friends of this particular user, regardless if they have accepted or not
    public function friendsOfMine() {
        // '$this' is the User model and we tie it to 'Lago\Models\User'
        // 'friends' is the pivot table, now match by the 'user_id'
        // and 'friend_id' is the foreign key
        return $this->belongsToMany('Lago\Models\User', 'friends', 'user_id', 'friend_id');
    }

    // now find users who have this 'user' as their friend
    public function friendOf() {
        return $this->belongsToMany('Lago\Models\User', 'friends', 'friend_id', 'user_id');
    }

    // friends of this user that have accepted friend requests only
    public function friends() {
        // now call 'friendsOfMine()' to find friends but filter by 'accepted' column
        // also merge both sides of the relationship otherwise friends who haven't accepted are not marked as friends of those who requested
        // hopefully this all makes sense :/
        return $this->friendsOfMine()->wherePivot('accepted', true)->get()->merge($this->friendOf()->wherePivot('accepted', true)->get());
    }

    public function friendRequests() {
        // return all friends that haven't yet accepted a request
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }

    public function friendRequestsPending() {
        return $this->friendOf()->wherePivot('accepted', false)->get();
    }

}

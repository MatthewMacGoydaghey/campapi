<?php

namespace App\Models;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use Database\Factories\UserFactory;
use GuzzleHttp\Psr7\Response;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Support\Arr;
use Laravel\Sanctum\HasApiTokens;
use Symfony\Component\HttpKernel\Exception\HttpException;

class User extends Model
{
    use HasFactory;
    use HasApiTokens;
    Use Authorizable;
    public $timestamps = false;
    protected $fillable = ['login', 'password'];
    protected $with = ['profile'];

    static function createProfile(StoreUserRequest $request) {
        try {
        Profile::create($request->all());
        return response("User created", 200);
    } catch (\Throwable $th) {
        User::find($request->user)->delete();
        return response($th->getMessage(), 400);
    }
    }

    static function attemptAuth(LoginUserRequest $request) {
        $foundUser = User::query()->where('login', $request->login)->first();
        if (!$foundUser) abort(404, "User $request->login not found");
        if ($foundUser->password !== $request->password) abort(403, "Incorrect password");
        $foundUser->tokens()->delete();
        return $foundUser->createToken($foundUser->login)->plainTextToken;
    }

    static function createFakeUsers(int $quantity) {
        User::factory()->count($quantity)
        ->has(Profile::factory()->count(1)->state(function (array $attributes, User $user) {
            return ['user' => $user->id];
        }))->create();
    }

    static function getRole(User $user) {
        return $user->profile->position;
    }

    public function profile(): HasOne {
        return $this->hasOne(Profile::class, "user");
    }

    public function receivedQuests(): HasMany {
        return $this->hasMany(PersonalQuest::class, "sent_to");
    }

    public function sentQuests(): HasMany {
        return $this->hasMany(PersonalQuest::class, "sent_by");
    }
}

<?php

namespace App\Http\Controllers\v1;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!$request->user()->can("viewAny", User::class)) return abort(403);
        User::createFakeUsers(10);
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $createdUser = User::create($request->all());
        $request['user'] = $createdUser->id;
        $result = User::createProfile($request);
        return $result;
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, User $user)
    {
        if ($request->user()->cannot('view', $user)) return abort(403);
        return $user;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if ($request->user()->cannot('update', $user)) return abort(403);
         $user->profile->update($request->all());
         return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, User $user)
    {
        if ($request->user()->cannot('delete', $user)) return abort(403);
         return $user->delete();
    }
}

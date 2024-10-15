<?php

namespace App\Http\Controllers\v1;

use App\Http\Requests\PersonalQuest\StorePersonalQuestRequest;
use App\Models\PersonalQuest;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class PersonalQuestController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->user()->cannot("viewAny", PersonalQuest::class)) return abort(403);
        return PersonalQuest::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonalQuestRequest $request)
    {
        if ($request->user()->cannot("create", PersonalQuest::class)) return abort(403);
        $request["sent_by"] = $request->user()->id;
        $request["status"] = "Active";
        $createdQuest = PersonalQuest::create($request->all());
        return $createdQuest;
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, PersonalQuest $personalQuest)
    {
        if ($request->user()->cannot("view", $personalQuest)) return abort(403);
        return $personalQuest;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PersonalQuest $personalQuest)
    {
        if ($request->user()->cannot("update", $personalQuest)) return abort(403);
        $personalQuest->update($request->all());
        return $personalQuest;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, PersonalQuest $personalQuest)
    {
        if ($request->user()->cannot("delete", $personalQuest)) return abort(403);
        return $personalQuest->delete();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\invitationTheme;
use App\Http\Requests\StoreinvitationThemeRequest;
use App\Http\Requests\UpdateinvitationThemeRequest;
use App\Models\invitation;

class InvitationThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return invitationTheme::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreinvitationThemeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreinvitationThemeRequest $request)
    {
        $this->authorize('create', invitationTheme::class);
        invitationTheme::create($request->safe()->all());
        return response()->json(["message" => "Invitation Theme created successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invitationTheme  $invitationTheme
     * @return \Illuminate\Http\Response
     */
    public function show(invitationTheme $invitationTheme)
    {
        return $invitationTheme;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateinvitationThemeRequest  $request
     * @param  \App\Models\invitationTheme  $invitationTheme
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateinvitationThemeRequest $request, invitationTheme $invitationTheme)
    {
        $this->authorize('update', $invitationTheme);
        $invitationTheme->fill($request->safe()->all());
        return $invitationTheme->save() ?
            response()->json(['message' => 'Invitation Theme successfuly updated']) : response()->json(['message' => 'Fail to update Invitation Theme']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invitationTheme  $invitationTheme
     * @return \Illuminate\Http\Response
     */
    public function destroy(invitationTheme $invitationTheme)
    {
        $this->authorize('delete', $invitationTheme);
        return $invitationTheme->delete() ?
            response()->json(['message' => 'Invitation Theme successfuly deleted']) : response()->json(['message' => 'Fail to delete Invitation Theme']);

    }
}

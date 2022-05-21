<?php

namespace App\Http\Controllers;

use App\Models\invitation;
use Illuminate\Http\Request;
use App\Http\Requests\StoreinvitationRequest;
use App\Http\Requests\UpdateinvitationRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', invitation::class);
        return invitation::all();
    }

    public function myInvitation()
    {
        return invitation::where('user_id', Auth::user()->id)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreinvitationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreinvitationRequest $request)
    {
        $this->authorize('create', invitation::class);
        $request->safe()->merge(['user_id' => Auth::user()->id]);
        invitation::create($request->safe()->all());
        return response()->json(["message" => "Invitation created successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function show(invitation $invitation)
    {
        return $invitation;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateinvitationRequest  $request
     * @param  \App\Models\invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateinvitationRequest $request, invitation $invitation)
    {
        $this->authorize('update', $invitation);
        $invitation->fill($request->safe()->all());
        return $invitation->save() ?
            response()->json(['message' => 'Invitation successfuly updated']) : response()->json(['message' => 'Fail to update Invitation']);
    }

    /**
     * Set theme for invitation.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\invitation $invitation
     * @return \Illuminate\Http\Resources
     */
    public function setTheme(Request $request, invitation $invitation)
    {
        $this->authorize('update', $invitation);
        $validator = Validator::make($request->all(), ['theme_id' => 'required|exists:invitation_theme,id']);
        if($validator->fails()){
            return response()->json(["message" => "Invalid theme"])->setStatusCode(400);
        }
        $safe = $validator->validated();
        $invitation->theme_id = $safe['theme_id'];
        return $invitation->save() ?
            response()->json(['message' => 'Theme set successfuly']) : response()->json(['message' => "Fail to set set theme"]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function destroy(invitation $invitation)
    {
        $this->authorize('delete', $invitation);
        return $invitation->delete() ?
            response()->json(['message' => 'Invitation successfuly deleted']) : response()->json(['message' => 'Fail to delete Invitation']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\invitation;
use Illuminate\Http\Request;
use App\Http\Requests\StoreinvitationRequest;
use App\Http\Requests\UpdateinvitationRequest;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
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
        $result = invitation::all();
        return response()->json(['invitations' => $result]);
    }

    public function myInvitation()
    {
        $result = invitation::where('user_id', Auth::user()->id)->get();
        return response()->json([
            'invitations' => $result
        ]);
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
        $result = $request->safe()->all();
        $bride_photo_path = $request->file('bride_photo_url')->store('invitation');
        $bride_photo_url = Storage::url($bride_photo_path);
        $groom_photo_path = $request->file('groom_photo_url')->store('invitation');
        $groom_photo_url = Storage::url($groom_photo_path);
        if($request->hasFile('thumbnail_url')){
            $thumbnail_path = $request->file('thumbnail_url')->store('invitation');
            $thumbnail_url = Storage::url($thumbnail_path);
            $result = array_merge($result, [
                'thumbnail_url' => $thumbnail_url
            ]);
        }
        $result = array_merge($result, [
            'user_id' => Auth::user()->id,
            'bride_photo_url' => $bride_photo_url,
            'groom_photo_url' => $groom_photo_url,
        ]);
        invitation::create($result);
        return response()->json(["message" => "Invitation created successfully"]);
    }


    public function invitationDetail(invitation $invitation)
    {
        return [
            'cover.event.title' => $invitation->ref,
            'cover.event.couple_name' => $invitation->bride_first ?
                    $invitation->bride_nickname.' & '.$invitation->groom_nickname :
                    $invitation->groom_nickname.' & '.$invitation->bride_nickname,
            'cover.event.date' => $invitation->date,
            'quote' => $invitation->quote,
            'couple.groom.name' => $invitation->groom_name,
            'couple.groom.child_nth' => $invitation->groom_child_nth,
            'couple.groom.parents.name' => $invitation->groom_father.' dan '.$invitation->groom_mother,
            'couple.bride.name' => $invitation->bride_name,
            'couple.bride.child_nth' => $invitation->bride_child_nth,
            'couple.bride.parents.name' => $invitation->bride_father.' dan '.$invitation->bride_mother,
            'events.main.datetime' => $invitation->main_event_datetime,
            'events.main.location' => $invitation->main_event_location,
            'events' => $invitation->events()
        ];
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function show(invitation $invitation)
    {
        $theme  = $invitation->theme();
        return response()->json([
            'theme' => $theme,
            'invitation' => $this->invitationDetail($invitation)
        ]);
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
        $result = $request->safe()->all();
        if($request->hasFile('bride_photo_url')){
            $bride_photo_path = $request->file('bride_photo_url')->store('invitation');
            $bride_photo_url = Storage::url($bride_photo_path);
            $result = array_merge($result, [
                'bride_photo_url' => $bride_photo_url
            ]);
        }
        if($request->hasFile('groom_photo_url')){
            $groom_photo_path = $request->file('groom_photo_url')->store('invitation');
            $groom_photo_url = Storage::url($groom_photo_path);
            $result = array_merge($result, [
                'groom_photo_url' => $groom_photo_url
            ]);
        }
        if($request->hasFile('thumbnail_url')){
            $thumbnail_path = $request->file('thumbnail_url')->store('invitation');
            $thumbnail_url = Storage::url($thumbnail_path);
            $result = array_merge($result, [
                'thumbnail_url' => $thumbnail_url
            ]);
        }
        $invitation->fill($result);
        return $invitation->save() ?
            response()->json(['message' => 'Invitation successfuly updated']) : response()->json(['message' => 'Fail to update Invitation']);
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
            response()->json(['message' => 'Invitation successfuly deleted'])->setStatusCode(204) : response()->json(['message' => 'Fail to delete Invitation']);
    }
}

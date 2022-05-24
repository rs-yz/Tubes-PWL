<?php

namespace App\Http\Controllers;

use App\Models\event;
use App\Http\Requests\StoreeventRequest;
use App\Http\Requests\UpdateeventRequest;
use App\Models\invitation;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\invitation $invitation
     * @return \Illuminate\Http\Response
     */
    public function index(invitation $invitation)
    {
        $this->authorize('view', [$invitation, event::class]);
        $result = $invitation->events;
        return response()->json([
            'events' => $result
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allEvents()
    {
        $this->authorize('viewAny', event::class);
        $result = event::all();
        return response()->json([
            'events' => $result
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreeventRequest  $request
     * @param \App\Models\invitation $invitation
     * @return \Illuminate\Http\Response
     */
    public function store(StoreeventRequest $request, invitation $invitation)
    {
        $this->authorize('create', $invitation);
        event::create(
            array_merge($request->safe()->all(), ['invitation_id' => $invitation->id])
        );
        return response()->json(["message" => "event created successfully"]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateeventRequest  $request
     * @param  \App\Models\event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateeventRequest $request, event $event)
    {
        $this->authorize('update', $event);
        $event->fill(array_merge($request->safe()->all(), ['invitation_id' => $event->invitation_id]));
        return $event->save() ?
            response()->json(['message' => 'event successfuly updated']) : response()->json(['message' => 'Fail to update event']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(event $event)
    {
        $this->authorize('delete', $event);
        return $event->delete() ?
            response()->json(['message' => 'event successfuly deleted']) : response()->json(['message' => 'Fail to delete event'])->setStatusCode(204);
    }
}

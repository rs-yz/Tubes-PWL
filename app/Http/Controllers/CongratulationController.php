<?php

namespace App\Http\Controllers;

use App\Models\congratulation;
use App\Http\Requests\StorecongratulationRequest;
use App\Http\Requests\UpdatecongratulationRequest;
use App\Models\invitation;

class CongratulationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\invitation $invitation
     * @return \Illuminate\Http\Response
     */
    public function index(invitation $invitation)
    {
        return congratulation::where('invitation_id', $invitation->id)->get();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorecongratulationRequest  $request
     * @param \App\Models\invitation $invitation
     * @return \Illuminate\Http\Response
     */
    public function store(StorecongratulationRequest $request, invitation $invitation)
    {
        congratulation::create(array_merge($request->safe()->all(), ['invitation_id' => $invitation->id]));
        return response()->json(["message" => "Congratulation created successfully"]);
    }

    /**
     * Display all congratulations for specific invitation.
     *
     * @param \App\Models\invitation $invitation
     * @return \Illuminate\Http\Response
     */
    public function allCongratulations(){
        return congratulation::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\congratulation  $congratulation
     * @return \Illuminate\Http\Response
     */
    public function show(congratulation $congratulation)
    {
        return $congratulation;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecongratulationRequest  $request
     * @param  \App\Models\congratulation  $congratulation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecongratulationRequest $request, congratulation $congratulation)
    {
        $this->authorize('update', $congratulation);
        $congratulation->fill(array_merge($request->safe()->all(), ['invitation_id' => $congratulation->invitation_id]));
        return $congratulation->save() ?
            response()->json(['message' => 'Congratulation successfuly updated']) : response()->json(['message' => 'Fail to update Congratulation']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\congratulation  $congratulation
     * @return \Illuminate\Http\Response
     */
    public function destroy(congratulation $congratulation)
    {
        $this->authorize('delete', $congratulation);
        return $congratulation->delete() ?
            response()->json(['message' => 'Congratulation successfuly deleted']) : response()->json(['message' => 'Fail to delete Congratulation']);
    }
}

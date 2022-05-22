<?php

namespace App\Http\Controllers;

use App\Models\expression;
use App\Http\Requests\StoreexpressionRequest;
use App\Http\Requests\UpdateexpressionRequest;
use App\Models\invitation;

class ExpressionController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @param \App\Models\invitation $invitation
     * @return \Illuminate\Http\Response
     */
    public function index(invitation $invitation)
    {
        $result = expression::where('invitation_id', $invitation->id)->get();
        return response()->json(['expressions' => $result]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreexpressionRequest  $request
     * @param \App\Models\invitation $invitation
     * @return \Illuminate\Http\Response
     */
    public function store(StoreexpressionRequest $request, invitation $invitation)
    {
        expression::create(array_merge($request->safe()->all(), ['invitation_id' => $invitation->id]));
        return response()->json(["message" => "expression created successfully"]);
    }

    /**
     * Display all expressions for specific invitation.
     *
     * @param \App\Models\invitation $invitation
     * @return \Illuminate\Http\Response
     */
    public function allExpressions(){
        $this->authorize('viewAny', expression::class);
        $result =  expression::all();
        return response()->json(['expressions' => $result]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\expression  $expression
     * @return \Illuminate\Http\Response
     */
    public function show(expression $expression)
    {
        return $expression;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateexpressionRequest  $request
     * @param  \App\Models\expression  $expression
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateexpressionRequest $request, expression $expression)
    {
        $this->authorize('update', $expression);
        $expression->fill(array_merge($request->safe()->all(), ['invitation_id' => $expression->invitation_id]));
        return $expression->save() ?
            response()->json(['message' => 'expression successfuly updated']) : response()->json(['message' => 'Fail to update expression']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\expression  $expression
     * @return \Illuminate\Http\Response
     */
    public function destroy(expression $expression)
    {
        $this->authorize('delete', $expression);
        return $expression->delete() ?
            response()->json(['message' => 'expression successfuly deleted']) : response()->json(['message' => 'Fail to delete expression'])->setStatusCode(204);
    }
}

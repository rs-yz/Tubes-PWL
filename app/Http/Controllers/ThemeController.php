<?php

namespace App\Http\Controllers;

use App\Models\theme;
use App\Http\Requests\StorethemeRequest;
use App\Http\Requests\UpdatethemeRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = theme::all();
        return response()->json(['themes' => $result]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorethemeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorethemeRequest $request)
    {
        $this->authorize('create', theme::class);
        $thumbnail_path = $request->file('thumbnail')->store('thumbnail');
        $thumbnail_url = Storage::url($thumbnail_path);
        theme::create(array_merge(
            $request->safe()->all(),
            ['thumbnail' => $thumbnail_url
            ]
        ));
        return response()->json(["message" => "Theme created successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function show(theme $theme)
    {
        return $theme;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatethemeRequest  $request
     * @param  \App\Models\theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatethemeRequest $request, theme $theme)
    {
        $this->authorize('update', $theme);
        $thumbnail = [];
        if($request->hasFile('thumbnail')){
            $thumbnail_path = $request->file('thumbnail')->store('thumbnail');
            $thumbnail_url = Storage::url($thumbnail_path);
            array_push($thumbnail, $thumbnail_url);
        }
        $theme->fill(array_merge(
            $request->safe()->all(),
            $thumbnail
        ));
        return $theme->save() ?
            response()->json(['message' => ' theme successfuly updated']) : response()->json(['message' => 'Fail to update  theme']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function destroy(theme $theme)
    {
        $this->authorize('delete', $theme);
        return $theme->delete() ?
            response()->json(['message' => ' theme successfuly deleted'])->setStatusCode(204) : response()->json(['message' => 'Fail to delete  theme']);

    }
}

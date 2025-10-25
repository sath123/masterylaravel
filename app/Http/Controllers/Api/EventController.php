<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\EventResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Event;


class EventController extends Controller
{

    public function __constructor(){
        $this->middleware('auth:sanctum')->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return \App\Models\Event::all();
        //return EventResource::collection(\App\Models\Event::all());
        return EventResource::collection(\App\Models\Event::with('user')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time'
        ]);

        $validatedData['user_id'] = $request->user()->id;

        $event = Event::create($validatedData);
        
        return response()->json([
        'message' => 'Event created successfully',
        'event' => $event
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(\App\Models\Event $event)
    {
        $event->load('user','attendees');
        return new EventResource($event);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Step 1: Validate the request
        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'sometimes|date',
            'end_time' => 'sometimes|date|after:start_time'
        ]);

        // Step 2: Find the event
        $event = Event::findOrFail($id);

        // Step 3: Update the event
        $event->update($validatedData);

        // Step 4: Return a response
        return response()->json([
            'message' => 'Event updated successfully',
            'event' => $event
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Step 1: Find the event
        $event = Event::findOrFail($id);
        // Step 2: Delete the event
        $event->delete();
        // Step 3: Return a response
        return response()->json([
            'message' => 'Event deleted successfully'
        ], 200);

    }
}

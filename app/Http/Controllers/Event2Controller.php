<?php

namespace App\Http\Controllers;
use App\Models\Event;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events =  Event::get();
        return Response::json($events, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
  
        try {
            $validated = $request->validate([
                'title' => 'required|string',
                'description' => 'required|string',
                'scheduled_at' => 'required|date',
                'location' => 'required|string',
                'max_attendees' => 'required|integer',
            ]);
           $event = new Event();
           $event->title =$request->title;
           $event->description =$request->description;
           $event->scheduled_at =$request->scheduled_at;
           $event->location =$request->location;
           $event->max_attendees =$request->max_attendees;
           $performed = $event->save();
           return Response::json($performed, 200);

        } catch (Throwable $ex) {
            Log::error($ex->getTraceAsString());
            return Response::json($ex->getMessage(), 500);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $events =  Event::find($request->id);
        return Response::json($events, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
    
        try {
            $validated = $request->validate([
                'title' => 'required|string',
                'description' => 'required|string',
                'scheduled_at' => 'required|date',
                'location' => 'required|string',
                'max_attendees' => 'required|integer',
            ]);
            $event =  Event::find($request->id);
            $event->title =$request->title;
            $event->description =$request->description;
            $event->scheduled_at =$request->scheduled_at;
            $event->location =$request->location;
            $event->max_attendees =$request->max_attendees;
            $performed = $event->update();
            return Response::json($performed, 200);
        } catch (Throwable $ex) {
            Log::error($ex->getTraceAsString());
            return Response::json($ex->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $event =  Event::find($request->id);
            if($event){
                $deleted = $event->delete();
            }else{
                return Response::json("Evento non trovato", 500);
            }
            return Response::json($deleted, 200);
        } catch (Throwable $ex) {
            Log::error($ex->getTraceAsString());
            return Response::json($ex->getMessage(), 500);
        }
    }
}

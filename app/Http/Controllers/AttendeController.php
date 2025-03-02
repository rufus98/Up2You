<?php

namespace App\Http\Controllers;
use App\Models\Attende;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Event;

use Illuminate\Support\Facades\Mail;



class AttendeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attende =  Attende::get();
        return Response::json($attende, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
       
        try {
            $validated = $request->validate([
                'firstname' => 'required|string',
                'lastname' => 'required|string',
                'email' => 'required|email',
                'event_id' => 'required|integer',
            ]);
            $check = Attende::where("event_id",$request->event_id)->where("email",$request->email)->get();
            if($check->count()){
                return Response::json("Già iscritto", 200);
            }
            $max_attendees = Event::select("max_attendees")->where("id",$request->event_id);
            if(Attende::where("event_id",$request->event_id)->count() === $max_attendees){
                return Response::json("Numero di iscritti massimo già raggiunto", 200);
            }
           $attende = new Attende();
           $attende->firstname =$request->firstname;
           $attende->lastname =$request->lastname;
           $attende->email =$request->email;
           $attende->event_id =$request->event_id;
           $performed = $attende->save();

        $to = $request->email;
        $subject = 'Iscrizione avvenuta correttamente';
        $message = $request->firstname ." " .$request->lastname." è iscritto correttamente";
        Mail::raw($message, function ($message) use ($to, $subject) {
            $message->to($to)
                    ->subject($subject);
        });

        Mail::html($htmlMessage, function ($message) use ($to, $subject) {
            $message->to($to)
                    ->subject($subject);
        });

        return response()->json(['message' => 'Email inviata con successo!']);
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
        $attende =  Attende::find($request->id);
        return Response::json($attende, 200);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        try {
            $validated = $request->validate([
                'firstname' => 'required|string',
                'lastname' => 'required|string',
                'email' => 'required|email',
                'event_id' => 'required|number',
            ]);
            $attende =  Attende::find($request->id);
            $attende->firstname =$request->firstname;
            $attende->lastname =$request->lastname;
            $attende->email =$request->email;
            $attende->event_id =$request->event_id;
            $performed = $attende->update();
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
            $event =  Attende::find($request->id);
            if($event){
                $deleted = $event->delete();
            }else{
                return Response::json("Iscritto non trovato", 500);
            }
            return Response::json($deleted, 200);
        } catch (Throwable $ex) {
            Log::error($ex->getTraceAsString());
            return Response::json($ex->getMessage(), 500);
        }
    }
}

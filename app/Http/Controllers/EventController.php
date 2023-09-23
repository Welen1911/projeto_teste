<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{

    public function index()
    {
        $search = request('search');

        if ($search) {
            $events = Event::where([
                ['title', 'like', '%' . $search . '%'],

            ])->get();

            return view('welcome', ['events' => $events, 'search' => $search]);
        } else {
            $events = Event::all();
            return view('welcome', ['events' => $events, 'search' => $search]);
        }
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $event = new Event();

        $event->title = $request->title;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->date = $request->date;

        if ($request->items == NULL) {
            $event->items = "";
        } else {
            $event->items = $request->items;
        }

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;

            $imageName = md5($requestImage->getclientOriginalName() . strtotime("now")) . "." . $request->image->getClientOriginalExtension();

            $request->image->move(public_path('/images'), $imageName);

            $event->image = $imageName;
        } else {
            $event->image = "";
        }

        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }

    public function show($id)
    {
        $user = auth()->user();
        $userJoined = false;

        if ($user) {
            $userEvents = $user->eventsAsParticipant->toArray();

            foreach ($userEvents as $uEvent) {
                if ($uEvent['id'] == $id) {
                    $userJoined = true;
                }
            }
        }

        $event = Event::findOrFail($id);
        $eventOwner = User::where('id', $event->user_id)->first()->toArray();

        return view('events.show', ['event' => $event, 'owner' => $eventOwner, 'userJoined' => $userJoined]);
    }

    public function dashboard()
    {
        $user = auth()->user();

        $events = $user->events;
        $eventsParticipant = $user->eventsAsParticipant;

        return view('events.dashboard', ['events' => $events, 'eventsAsParticipants' => $eventsParticipant]);
    }

    public function edit($id)
    {
        $user = auth()->user();

        $event = Event::findOrFail($id);

        if ($user->id != $event->user_id) {
            return redirect('/');
        } else {
            return view('events.update', ['event' => $event]);
        }
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $event = Event::findOrFail($request->id);

        if ($request->items == NULL) {
            $data['items'] = "";
        } else {
            $data['items'] = $request->items;
        }

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            unlink(public_path('images/' . $event->image));
            $requestImage = $request->image;

            $imageName = md5($requestImage->getclientOriginalName() . strtotime("now")) . "." . $request->image->getClientOriginalExtension();

            $request->image->move(public_path('/images'), $imageName);

            $data['image'] = $imageName;
        } else {
            $data['image'] = $event->image;
        }

        $event->update($data);

        return redirect('/dashboard')->with('msg', 'Evento editado com sucesso!');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $users = user::all();
        $uEvents = [];

        foreach ($users as $user) {
            $user->eventsAsParticipant()->detach($id);
        }

        if ($event->image != "") {
            unlink(public_path('images/' . $event->image));
        }

        $event->delete();

        return redirect('/dashboard')->with('msg', 'Evento excluído com sucesso!');
    }

    public function joinEvent($id)
    {
        $user = auth()->user();

        $user->eventsAsParticipant()->attach($id);

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Presença confirmada no evento ' . $event->title . "!");
    }

    public function leaveEvent($id) {
        $user = auth()->user();

        $user->eventsAsParticipant()->detach($id);

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('err', 'Presença removida no evento ' . $event->title . "!");
    }

    // public function PEvents() {
    //     // $users = User::all();

    //     $users = user::all();
    //     $uEvents = [];

    //     foreach ($users as $user) {
    //         $uEvents[] = $user->eventsAsParticipant()->detach(2);
    //     }

    //     return response()->json($uEvents, 200);
    // }
}

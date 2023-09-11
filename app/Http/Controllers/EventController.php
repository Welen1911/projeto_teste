<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{

    public function index()
    {
        $search = request('search');

        if ($search) {
            $events = Event::where([
                ['title', 'like', '%'.$search.'%'],

            ])->get();

            return view('welcome', ['events' => $events, 'search' => $search ]);
        } else {
            $events = Event::all();
            return view('welcome', ['events' => $events, 'search' => $search ]);
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

        $event->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);

        return view('events.show', ['event' => $event]);
    }


}

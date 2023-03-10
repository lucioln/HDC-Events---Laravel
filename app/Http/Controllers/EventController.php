<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;

class EventController extends Controller
{
    public function index(){

        $search = request('search');

        if($search){
            $events = Event::where([
                ['title','like', '%'.$search.'%']
            ])->get();
        }else{
            $events = Event::all();
        }
        return view('welcome', ['events'=>$events, 'search'=> $search]);
    }

    public function create(){
        return view('events.create');
    }

    public function store(Request $request){
        $event = new Event();

        $event->title = $request->title;
        $event->description = $request->description;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->items = $request->items;
        $event->date = $request->date;

        //Image Upload
        if($request->hasFile('image') && $request->file('image')->isValid()){

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage ->getClientOriginalName() . strtotime('now') . '.' . $extension );

            $request->image->move(public_path('img/events'),$imageName);

            $event->image = $imageName;

        }

        $user = auth()->user();

        $event->user_id = $user->id;

        $event->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso');
    }

    public function show($id){
        $event =  Event::FindOrFail($id);

        $user = auth()->user();
        $hasUserJoined = false;

        if($user){

            $userEvents = $user->eventsAsParticipant->toArray();

            foreach($userEvents as $userEvent){
                if($userEvent['id'] == $id){
                    $hasUserJoined = true;
                }
            }
        }

        return view('events.show', ['event'=> $event,
                                    'hasUserJoined'=> $hasUserJoined]);
    }

    public function dashboard(){

        $user = auth()->user();

        $events = $user->events;

        $eventsAsParticipant = $user->eventsAsParticipant;

        return view('events.dashboard', [
            'events' => $events,
            'eventsasparticipant'=>$eventsAsParticipant ]);
    }

    public function destroy($id){

        $user = auth()->user();

        $event = Event::findOrFail($id);

        if($user->id == $event->user_id){
            $event->delete();
            return redirect('/dashboard')->with('msg', 'Evento excluído com sucesso!');
        }else{
            return redirect('/dashboard')->with('msg', 'Você não pode excluir este evento!');
        }

    }

    public function edit($id){
        $event = Event::findOrFail($id);

        return view('events.edit', ['event'=>$event]);
    }

    public function update(Request $request){

        $data = $request->all();

        if($request->hasFile('image') && $request->file('image')->isValid()){

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage ->getClientOriginalName() . strtotime('now') . '.' . $extension );

            $request->image->move(public_path('img/events'),$imageName);

            $data['image'] = $imageName;

        }

        Event::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Evento editado com sucesso!');
    }


    public function joinEvent($id){
        $user = auth()->user();

        $user->eventsAsParticipant()->attach($id);

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Sua presença foi confirmada no evento: '. $event->title);
    }

    public function leaveEvent($id){
        $user = auth()->user();

        $user->eventsAsParticipant()->detach($id);

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Sua presença foi removida no evento: '. $event->title);

    }
}

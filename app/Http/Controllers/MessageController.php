<?php

namespace App\Http\Controllers;

use App\User;
use App\Message;
use App\Events\NewMessage;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.messages');
    }

    public function getContacts()
    {
        $users = User::where('id', '!=', auth()->id())->get();

        $unreadIds = Message::select(\DB::raw('`from` as sender_id, count(`from`) as messages_count'))
            ->where('to', auth()->id())
            ->where('read', false)
            ->groupBy('from')
            ->get();
        $users = $users->map(function($user) use ($unreadIds){
            $userUnread = $unreadIds->where('sender_id', $user->id)->first();
            $user->unread = $userUnread ? $userUnread->messages_count : 0;
            return $user;
        });
        return response()->json($users, 200);
    }
    
    public function getMessagesFor($id)
    {
        // Mark as read
        Message::where('from', $id)->where('to', auth()->id())->update(['read' => true]);

        // Get the messages
        $messages = Message::where(function($q) use ($id){
            $q->where('from', auth()->id());
            $q->where('to', $id);
        })->orWhere(function($q) use ($id){
            $q->where('from', $id);
            $q->where('to', auth()->id());
        })->get();

        return response()->json($messages, 200);
    }

    public function send(Request $request)
    {
        $message = Message::create([
            'from' => auth()->id(),
            'to' => $request->contact_id,
            'text' => $request->text
        ]);

        broadcast(new NewMessage($message));

        return response()->json($message, 200);
    }
}

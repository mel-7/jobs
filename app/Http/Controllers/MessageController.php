<?php

namespace App\Http\Controllers;
// use Image;
use App\User;
use App\Message;
use App\FileUpload;
use App\Events\NewMessage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


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
        $to = $request->contact_id;
        $fileArray = array();
        if($request->attachment == 1){
            // Create if does not exist
            // $userStorage = '/uploads/c/'.auth()->id().'-'.$request->contact_id;
            $userStorage = '/uploads/c';
            if( !Storage::exists($userStorage) ){
                Storage::makeDirectory($userStorage, 0777, true);
            }
            // Wrapping the files to collection
            $images = Collection::wrap(request()->file('file'));
            
            // Do something on each files uploaded
            $images->each( function($image, $key) use(&$fileArray, &$to){
                // $userStorageDir = storage_path(). '/app/uploads/c/'.auth()->id().'-'.$to;
                $userStorageDir = storage_path(). '/app/uploads/c';
                $randomName = Str::random();
                // $fname = $image->getClientOriginalName();
                // $name = pathinfo($fname, PATHINFO_FILENAME);         
                // $fileName = substr($name,0,6).'-'.auth()->id().'-'.$randomName;
                $fileName = auth()->id().'-'.$randomName;
                $extn = $image->getClientOriginalExtension();
                $imageExtensions = array('jpeg','jpg','png','JPEG','JPG','PNG');
                
                if( in_array($extn, $imageExtensions) ){
                    Image::make($image)->fit(250,250)->save($userStorageDir.'/'.$fileName.'-thumb.'.$extn);
                }
    
                // Moving the file to the created directory
                $image->move($userStorageDir, $fileName.'.'.$extn);
                
                // Add the files to message object
                $fileArray[$key]['filename'] = $fileName;
                $fileArray[$key]['extension'] = $extn;
                // $fileArray[$key]['mime'] = $image->getClientMimeType();
            });
        }
        
        // Saving to Message
        $message = Message::create([
            'from' => auth()->id(),
            'to' => $request->contact_id,
            'text' => isset($request->text) ? $request->text : '',
            'attachment' => (int) $request->attachment,
            'files' => $request->attachment ? json_encode($fileArray) : null
        ]);
        
        // Broadcast event to notify the other user
        broadcast(new NewMessage($message));

        return response()->json($message, 200);
    }

    public function sendFile(Request $request)
    {
        // Check user directory if exist, otherwise create
        $userStorage = '/uploads/c/'.auth()->id();
        if( !Storage::exists($userStorage) ){
            Storage::makeDirectory($userStorage, 0777, true);
        }

        $images = Collection::wrap(request()->file('file'));
        $images->each(function($image){

            $userStorageDir = storage_path(). '/app/uploads/c/'.auth()->id();
            $randomName = Str::random();
            $fileName = auth()->id() . '-' .$randomName. '.' .$image->getClientOriginalExtension();
            $thumbName = auth()->id() . '-' .$randomName. '-thumb.' .$image->getClientOriginalExtension();
            $imageExtensions = array('jpeg','jpg','png','JPEG','JPG','PNG');
            
            if( in_array($image->getClientOriginalExtension(), $imageExtensions) ){
                Image::make($image)->fit(250,250)->save($userStorageDir.'/'.$thumbName);
            }

            // Moving file
            $image->move($userStorageDir, $fileName);

            // Saving files to database
            FileUpload::create([
                'uploadedby' => auth()->id(),
                'filename' => $fileName
            ]);
            // Return
        });
        dd($request);
        // return response()->json($request, 200);
    }
}

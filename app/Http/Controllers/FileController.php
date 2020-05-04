<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\User;
class FileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($msgid, $extn, $filename)
    {

        $ex = strtolower($extn);
        $mime = '';
        if( substr($ex, 0, 2) == 'pd' ){
            $mime = 'application/pdf';
        }elseif (substr($ex, 0, 2) == 'pd') {
            $mime = 'application/vnd.ms-powerpoint';
        }elseif (substr($ex, 0, 2) == 'tx') {
            $mime = 'text/plain';
        }elseif (substr($ex, 0, 2) == 'jp') {
            $mime = 'image/jpeg';
        }elseif (substr($ex, 0, 2) == 'pn') {
            $mime = 'image/png';
        }

        $m = Message::where('id', '=', $msgid)->firstOrFail();    
        if( isset($m) && ( $m->from == auth()->id() || $m->to == auth()->id() ) ){
            $image = storage_path(). '/app/uploads/c/'.$filename;
            return response()->file($image, array('Content-Type' => $mime));
        }else{
            return abort('403');
        }
    }
}

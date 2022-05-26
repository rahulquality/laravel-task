<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\Message;
use App\Http\Controllers\Controller;

class ChatsController extends Controller
{
    public function chat(Request $request)
    {
        broadcast(new Message($request->text))->toOthers();
        
        return [
            "status" => "Success"
        ];
    }
}
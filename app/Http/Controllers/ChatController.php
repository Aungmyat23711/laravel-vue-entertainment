<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\ChatEvent;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\team;
use App\Models\room;
use App\Models\pchat;

class ChatController extends Controller
{
    //
   public function chatting(Request $req)
   {
        $user=$req->user;
        $message=$req->message;
        $userId=$req->userId;
       event(new ChatEvent($message,$user,$userId));
   }
   function addprivate(Request $req)
   {
       $data=new team;
       $data->room_id=$req->room_id;
       $data->save();
   }
   function addroom(Request $req)
   {
       $data=new room;
       $data->room=$req->room;
       $data->host_id=$req->host_id;
       $data->save();
   }
   function getroom($id)
   {
       $data=room::where('host_id',$id)->get();
       return $data;
   }
   function getroombyid($id)
   {
       $data=room::where('id',$id)->get();
       return $data;
   }
   function getTeam($id)
   {   $data=room::where('host_id',$id)->get();
       $team=team::where('id','!=',$id)->get();
    //    dd($id);
      return [$data,$team];
   }
   function senduser(Request $req,pchat $p)
   {
       $rid=$req->room_id;
       $user_id=$req->user_id;
       $req->validate([
           'user_id'=>[Rule::unique('pchats')->where(function ($query) use($rid,$user_id) {
            return $query->where('room_id', $rid)
            ->where('user_id', $user_id);
        }),
        ]
    ]);
       $data=new pchat;
       $data->room_id=$req->room_id;
       $data->host_id=$req->host_id;
       $data->user_id=$req->user_id;
       $data->status='added';
       $data->save();
   }
   function getroomuser($id)
   {
      $data=DB::table('pchats')
      ->join('teams','pchats.user_id','teams.id')
      ->where('pchats.room_id',$id)
      ->select('teams.*','pchats.*')
      ->get();
       return $data;
   }
   
}

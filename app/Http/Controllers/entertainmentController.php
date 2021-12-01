<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\animedata;
use Illuminate\Support\Facades\DB;
use App\Models\team;
use App\Models\season;
use App\Models\episode;
use App\Models\type;
use App\Models\aframeuser;
use App\Models\contact;
use App\Events\ChatEvent;
use Illuminate\Validation\Rule;
class entertainmentController extends Controller
{
    //
    function createdata(Request $req)
    {
        $req->validate([
            'photo'=>['required']
        ]);
       $file=$req->photo;
       $ext=$file->getClientOriginalExtension();
       $photo=time().'.'.$ext;
       $path=$file->move('anime/',$photo);
       $data=new animedata;
       $data->name=$req->name;
       $data->tag=$req->tag;
       $data->total=$req->total;
       $data->total_episode=$req->tepisode;
       $data->photo=$photo;
       $data->date=$req->date;
       $data->story=$req->story;
       $data->type1=$req->type1;
       $data->type2=$req->type2;
       $data->type3=$req->type3;
       $data->type4=$req->type4;
       $data->type5=$req->type5;
       $data->admin_id=$req->admin_id;
       $data->save();
       dd($data);

    }
    function getdata()
    {
        $data=animedata::orderBy('id','desc')->paginate(8);
        return $data;
    }
    function deleteitem($id)
    {
         DB::delete('delete from animedatas where id=?',[$id]);
         return response()->json(['message',"You have deleted data!"]);
    }
    function teamregister(Request $req)
    {
        $req->validate([
            'memberavatar'=>['required']
        ]);
        $file=$req->memberavatar;
        $ext=$file->getClientOriginalExtension();
        $avatar=time().'.'.$ext;
        $path=$file->move('anime/',$avatar);
        $data=new team;
        $data->name=$req->membername;
        $data->avatar=$avatar;
        $data->password=$req->memberpassword;
        $data->email=$req->memberemail;
        $data->role=$req->memberRole;
        $data->save();
    }
    function login(Request $req)
    {
        $user=team::where(['email'=>$req->email])->first();
        if(!$user || $req->password!=$user->password)
        {
            return response()->json(['message'=>'User Name or Password not match!']);
        }
        else{
            return $user;
        }
    }
    function edit($id,Request $req)
    {
        // $req->validate([
        //     'photo'=>['required']
        // ]);
        $data=animedata::find($id);
        if($req->photo==null)
        {
            $data->name=$req->name;
            $data->tag=$req->tag;
            $data->date=$req->date;
            $data->total=$req->total;
            $data->total_episode=$req->tepisode;
            $data->story=$req->story;
            $data->type1=$req->type1;
            $data->type2=$req->type2;
            $data->type3=$req->type3;
            $data->type4=$req->type4;
            $data->type5=$req->type5;
            $data->save();
        }
        else{
            $file=$req->photo;
            $ext=$file->getClientOriginalExtension();
            $photo=time().'.'.$ext;
            $path=$file->move('anime/',$photo);
            $data->name=$req->name;
            $data->tag=$req->tag;
            $data->date=$req->date;
            $data->total=$req->total;
            $data->total_episode=$req->tepisode;
            $data->story=$req->story;
            $data->photo=$photo;
            $data->save();
        }
    }
    function getTeam()
    {
        $data=team::all();
        return $data;
    }
    function getproject($id)
    {
        $data=animedata::where('admin_id',$id)->get();
        return $data;
    }
    function addseason(Request $req,$id)
    {
        $data=new season;
        $data->main_id=$id;
        $data->season=$req->season;
        $data->save();
    }
    function getseason($id)
    {
        $data=season::where('main_id',$id)->get();
        return $data;
    }
    function getanimedata($id)
    {
        $data=animedata::where('id',$id)->get();
        return $data;
    }
    function geteachseason($id)
    {
        $data=season::where('id',$id)->get();
        return $data;
    }
    function addepisode(Request $req)
    {
        $data=new episode;
        $data->episode=$req->episode;
        $data->link=$req->link;
        $data->ep_name=$req->ep_name;
        $data->anime_id=$req->anime_id;
        $data->season_id=$req->season_id;
        $data->save();
        
    }
    function getepisode($id)
    {
        $data=episode::where('season_id',$id)->get();
        return $data;
    }
    function addtype(Request $req)
    {
        $data=new type;
        $data->type_name=$req->type;
        $data->save();
    }
    function getType()
    {
        $data=type::get();
        return $data;
    }
    function getaframedata()
    {  
        $data=animedata::orderBy('id','desc')->paginate(6);
        return $data;
    }
    function getsearchdata()
    {  
        $data=animedata::when(request('search'),function($query){
            $query->where('name','like','%'.request('search').'%')
                  ->orWhere('type1','like','%'.request('search').'%')
                  ->orWhere('type2','like','%'.request('search').'%')
                  ->orWhere('type3','like','%'.request('search').'%')
                  ->orWhere('type4','like','%'.request('search').'%')
                  ->orWhere('type4','like','%'.request('search').'%');
        })->paginate(6);
        return $data;
    }
    function geteachinfo($id)
    {
        $data=animedata::where('id',$id)->get();
        return $data;
    }
    function getseasoninfo($id)
    {
        $data=season::where('main_id',$id)->get();
        return $data;
    }
    function calldata($id)
    {
        $data=episode::where('season_id',$id)->get();
        return $data;
    }
    function getaframeType()
    {
        $data=type::orderBy('type_name')->get();
        return $data;
    }
    function getdatabytype($name)
    {
        $data=animedata::where('type1',$name)
                       ->orWhere('type2',$name)
                       ->orWhere('type3',$name)
                       ->orWhere('type4',$name)
                       ->orWhere('type5',$name)
                       ->paginate(6);
        return $data;
    }
    function adduser(Request $req,aframeuser $user)
    {
        $req->validate([
            'email'=>[Rule::unique('aframeusers')],
        ]);
        if($req->useravatar==null)
        {
        $data=new aframeuser;
        $data->first_name=$req->first_name;
        $data->last_name=$req->last_name;
        $data->password=$req->password;
        $data->email=$req->email;
        $data->useravatar='user.png';
        $data->save();
        }else{
            $file=$req->useravatar;
            $ext=$file->getClientOriginalExtension();
            $photo=time().'.'.$ext;
            $path=$file->move('anime/',$photo);
            $data=new aframeuser;
            $data->first_name=$req->first_name;
            $data->last_name=$req->last_name;
            $data->password=$req->password;
            $data->email=$req->email;
            $data->useravatar=$photo;
            $data->save();
        }
      
    }
    function aframelogin(Request $req)
    { 
        $req->validate([
            'password'=>['required'],
            'email'=>['required','email']
        ]);
      $data=aframeuser::where(['email'=>$req->email])->first();
      if(!$data || $req->password!=$data->password)
      {
          return response()->json(['message'=>'User name or password not match']);
      }else{
          return $data;
      }  
    }
    function getTypedata($name)
    {
        $data=animedata::where('type1',$name)
        ->orWhere('type2',$name)
        ->orWhere('type3',$name)
        ->orWhere('type4',$name)
        ->orWhere('type5',$name)
        ->get();
        return $data;
    }
    function addfeedback(Request $req)
    {
       $data=new contact;
       $data->fname=$req->fname;
       $data->email=$req->email;
       $data->message=$req->message;
       $data->save();
    }
    function delep($id)
    {
        return DB::delete('delete from episodes where id=?',[$id]);
    }
    function epupdate($id,Request $req)
    {
        $data=episode::find($id);
        $data->episode=$req->episode;
        $data->link=$req->link;
        $data->ep_name=$req->ep_name;
        $data->anime_id=$req->anime_id;
        $data->season_id=$req->season_id;
        $data->save();
    }
    function chatting(Request $req)
    {
        $message=$req->message;
        $main_id=$req->main_id;
        $user=$req->user;
        $time=$req->time;
        $this->saveToSession($req,$main_id);
        event(new ChatEvent($message,$main_id,$user,$time));
      
    }
    function saveToSession(Request $req,$id)
    {
         $req->session()->put("chat$id",$req->chat);
    }
    function getOldMessage($id)
    {
        return session("chat$id");
    }
    function delsession($id)
    {
        return session()->forget("chat$id");
    }
}

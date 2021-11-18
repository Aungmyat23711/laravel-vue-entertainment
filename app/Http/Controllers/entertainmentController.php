<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\animedata;
use Illuminate\Support\Facades\DB;
use App\Models\team;
use App\Models\season;
use App\Models\episode;
use App\Models\type;
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
       return response()->json(['message','You have added data']);

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
        $user=team::where('email',$req->email)->first();
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
        $data=animedata::paginate(12);
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
}

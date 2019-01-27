<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;
use App\Movie;
use Validator;
use Datatables;
class HomeController extends Controller
{
    //
    use FileUploadTrait;
    
    public function index(){
        $years = getYears();
        return view('movie.create',compact('years'));
    }

    public function create(Request $request){
        //dd($request->all());ew
        $validaton = Validator::make($request->all(),
            [
                'image' => 'mimes:jpeg,png,jpg,gif|max:2048',
                'title' => 'required',
                'year' =>'required|integer',
                'description' =>'required|min:5'
            ]);
       if($validaton->fails()){
           return response()->json([
               'status'=>'failed',
               'message'=>$validaton->errors()->all(),
               'image'=>'',
               'class'=>'alert alert-danger',
               'from'=>'validation'
           ]);
       }
       $data = $request->all();
       if ($request->hasFile('image')) 
        {$res = $this->saveFiles($request);
        $data['image'] = $res->image;
        }
        //dd($data);
       // dd($request->id);
        if($request->id){
           $resp = Movie::find($request->id)->update($data);
           $message="Updated";
        }else{
            $resp =Movie::create($data);
            $message = "Inserted";
        }
        if($resp){
            return response()->json([
                'status'=>'success','message'=> $message. " Successfully",'class'=>'alert alert-success',
                ]);
        }else{
            return response()->json([
                'status'=>'failed','message'=>"Something went Wrong",'class'=>'alert alert-danger',
                ]);
        }
       
      
    }


    public function getmovielist(){
        $movies = Movie::select(['id','title','year','description','image']);

        return Datatables::of($movies)
        ->addColumn('action', function ($movie) {
            return '<a  onclick="edit('.$movie->id.')" class="btn btn-xs btn-primary text-white"><i class="glyphicon glyphicon-edit"></i> Edit</a>
            <a  onclick="delete_rec('.$movie->id.')" class="btn btn-xs btn-primary text-white"><i class="glyphicon glyphicon-edit"></i> Delete</a>    
            ';
        })
        ->editColumn('image', '@if($image != "")<img src="uploads/{{ $image }}" class="img-thumbnail" width="30" height="30">@else No image @endif')
        ->removeColumn('id')
            ->rawColumns(['image', 'action'])
        ->make();
    }

    public function edit(Request $request){
        $data = Movie::find($request->id);
        $o_data = json_encode($data,true);
        
        if($data = Movie::find($request->id)){
           // $data = json_encode($data,true);
            $o_data = ['status'=>'success','data'=>$data];
        }else{
            $o_data = ['status'=>'failed'];
        }
         return response()->json($o_data);
    }

    public function delete_rec(Request $request){
        if($data = Movie::find($request->id)->delete()){
            $o_data = ['status'=>'success','message'=>'Deleted Successfully','class'=>'alert alert-success'];
        }else{
            $o_data = ['status'=>'failed','message'=>'Something went Wrong','class'=>'alert alert-danger'];
        }
         return response()->json($o_data);
    }
}




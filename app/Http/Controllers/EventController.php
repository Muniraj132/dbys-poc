<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use DateTime;

class EventController extends Controller
{
    public function index(){
       
        return view('admin-backend.includes.listevent');
    }
    public function addevent(){
        return view('admin-backend.includes.event');
    }
    public function EventStore(Request $request){
       
        // change start date formate
        $originalDate = $request->start_datetime;
        $dateTime = new DateTime($originalDate); 
        $newFormat = $dateTime->format('Y-m-d\TH:i');
         
        // change end date formate
        $endtimedate =$request->end_datetime;
        $enddateTime = new DateTime($endtimedate); 
        $newendFormat = $enddateTime->format('Y-m-d\TH:i');
        $request->merge([
            'start_datetime' => $newFormat,
            'end_datetime' =>$newendFormat
        ]);

        $file = $request->file('image');
        if($file != null){
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $location = 'Eventresource_files';
    
        $input_image = ([
            'image' => $file->getClientOriginalName()
        ]);
        $input = $request->except('_token','image');
        $data = new Event(array_merge($input, $input_image));
        $data->save();
        $file->move($location,$filename);
        // get file path
        $filepath = url('Eventresource_files/'.$filename);
        }else{
        $input = $request->except('_token');
        $data = new Event($input);
        $data->save();
        }
        
        return response()->json(['success'=> "Event Created Successfully!"]);


    }
    public function EditEventdata($id){
        $event =Event::where('id',$id)->first();
        return view('admin-backend.includes.event',compact('event'));
    }
    public function EventUpdate(Request $request){
       
        $file = $request->file('image');
        $id= $request->id;
        
        // change start date formate
        $originalDate = $request->start_datetime;
        $dateTime = new DateTime($originalDate); 
        $newFormat = $dateTime->format('Y-m-d\TH:i');
         
        // change end date formate
        $endtimedate =$request->end_datetime;
        $enddateTime = new DateTime($endtimedate); 
        $newendFormat = $enddateTime->format('Y-m-d\TH:i');
        $request->merge([
            'start_datetime' => $newFormat,
            'end_datetime' =>$newendFormat
        ]);

        if ($file != null) {
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $location = 'Eventresource_files';
    
        $input_image = ([
            'image' => $file->getClientOriginalName()
        ]);
        $input = $request->except('_token','image');
        $data = Event::where('id',$id)->first();
        $data->update(array_merge($input, $input_image));
        $file->move($location,$filename); 
        $filepath = url('Eventresource_files/'.$filename);
        }else{
        $input = $request->except('_token');
        $data = Event::where('id',$id)->first();
        $data->update($input);
        }
        return response()->json(['success'=> "Event Updated Successfully!"]);
    }
    public function geteventdata(Request $request){
        if ($request->ajax()) {

            $data = Event::all();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image',function($row){
                    $img = '';
                    $img = $img . '<img src="' . asset('/Eventresource_files/' . $row->image) . '" class="listimages" alt="" />';
                    $img = $img.''.$row->image.'';
                    return $img;
                })
                ->addColumn('Action', function($row){
                    $btn = '';
                    $btn = $btn.'<a href="/Dbys/Edit-Event/'.$row->id.'" class="activeedit" id="activeedit'.$row->id.'" data-id="'.$row->id.'" data-original-title="view" title="edit" ><i class="fa fa-edit"></i></a>';
                    $btn = $btn.'   <a href="javascript:void(0)"
                    class="activedatedel"  id="activedatedel'.$row->id.'"  data-id="'.$row->id.'" section-id="main" data-original-title="Delete" data-bs-toggle="modal" data-bs-target="#delete-section">
                    <i class="fa fa-trash"></i>
                    </a>';
                    return $btn;
                })
                ->rawColumns(['Action','image'])
                ->make(true);
        }
    }
    public function deleteevent(Request $request){
        $id = $request->id;
        $data = Event::where('id',$id)->delete();

        return response()->json(['success'=> "Deleted Successfully!"]);
    }

    public function notifycount(Request $request){
        $count ='2';
        $data = [
            'title' => 'title of the notification',
            'description'=> 'description of the notification',
            'time'=>'30 min ago'
        ];
        return response()->json([
            'count'=>$count,
            'data'=>$data,
            
        ]);
    }
}


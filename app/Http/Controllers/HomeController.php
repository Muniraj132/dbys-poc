<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {  
        
        $user=  Auth::user()->usertype;
       return view('admin-backend.includes.dashboard');
    }
    public function userdata(Request $request){
        if ($request->ajax()) {

            $data = User::all();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('actioncheck', function($row){
                    $check = '';
                     $check =$check.'<a href="javascript:void(0)" data-original-title="view"  style="padding: 0px 0px 0px 19px;" ><input class="form-check-input" type="checkbox"  name="export" id="export" value="'.$row->id.'" data-val="'.$row->id.'" ></a>';
                    return $check;
                })
                ->addColumn('Action', function($row){
                    $btn = '';
                    $btn = $btn.'<a href="javascript:void(0)" class="activeedit" id="activeedit'.$row->id.'" data-id="'.$row->id.'" data-original-title="view" title="edit" ><i class="fa fa-edit"></i></a>';
                    $btn = $btn.'   <a href="javascript:void(0)"
                    class="userdel"  id="userdel'.$row->id.'"  data-id="'.$row->id.'" section-id="main" data-original-title="Delete" data-bs-toggle="modal" data-bs-target="#delete-section">
                    <i class="fa fa-trash"></i>
                    </a>';
                    return $btn;
                })
                ->rawColumns(['Action','actioncheck'])
                ->make(true);
        }
    }
    public function deleteuser(Request $request){
            $id = $request->id;
            $data = User::where('id',$id)->delete();
            return response()->json(['success'=> "Deleted Successfully!"]);
    }
    public function adduser(Request $request){
        $password = [
            'password' => Hash::make($request->password)
        ];  
        $input = $request->except('_token','password');
        $data = new User(array_merge($input, $password));
        $data->save();
        return response()->json(['success'=> " Created Successfully!",'status' => "1"]);
    }
    public function getusers(Request $request){
      
        $id = $request->id;
        $user_data = User::find($id);
        return response()->json(['data'=> $user_data]);      
    }
    public function UpdateUsers(Request $request){
       
        
        $request->merge([
            'updated_at' =>Carbon::now(),
        ]);
        $input = $request->except('_token');
        $data = User::where('id',$input['id'])->first();
        $data->update($input);
        return response()->json(['success'=> " Updated Successfully!",'status' => "1"]);
    }
}

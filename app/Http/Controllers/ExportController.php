<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Response;
use File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
class ExportController extends Controller
{
   public function exportXlxs(Request $request){
    
    $id =$request->all();
    $data =$id['arr'];
    $fileName = 'DbysUserlist.csv';

    $headers = array(
       "Content-type"        => "text/csv",
       "Content-Disposition" => "attachment; filename=$fileName",
       "Pragma"              => "no-cache",
       "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
       "Expires"             => "0"
    );

    if (!File::exists(public_path()."/files")) {
        File::makeDirectory(public_path() . "/files");
     }

     $filename =  public_path("files/DbysUserlist.csv");
     $handle = fopen($filename, 'w');
     fputcsv($handle, [
        "Users Name",
        "Role",
        "Email",
        "Status",
        "comments",
     ]);
     foreach($data as $value){
        $arrdata = User::where('id',$value)->first();
     fputcsv($handle, [
        $arrdata->username,
        $arrdata->usertype,
        $arrdata->email,
        $arrdata->status,
        $arrdata->comments,
     ]);
    }
    fclose($handle);
    return Response::download($filename, "DbysUserlist.csv", $headers);
   }
}

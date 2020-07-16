<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Redirect, Response, File;
use App\Document;
use Yajra\DataTables\Facades\DataTables;

class WelcomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        return view('user.welcome.welcome');
    }

    public function upload_file()
    {

        return view('user.upload.upload');
    }
    public function submit_file(Request $request)
    {

        request()->validate([
            'file'  => 'required|mimes:txt,doc,docx,pdf,png,jpeg,jpg,gif|max:2000',
        ]);

        if ($files = $request->file('file')) {

            $destinationPath = 'file_uploads/'; // upload path
            $profilefile = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profilefile);
            $insert['title'] = "$profilefile";
        }

        $check = Document::insertGetId($insert);


        return redirect()->route('List Files')->withSuccess('Great! file has been successfully uploaded');
    }

    public function list_files()
    {
        
        $data = Document::all ();
    return view ( 'user.upload.file_list' )->withData ( $data );
      
    }
    public function show_data()
    {
        
        return DataTables::of(Document::query())->make(true);
      
    }

    public function delete_file(Request $request)
    {
        Document::find ($request->id)->delete ();
    }
}

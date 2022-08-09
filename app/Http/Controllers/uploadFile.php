<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailInfo;
use App\Models\User;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
class uploadFile extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);
        $file = file($request->file->getRealPath());
        dd($file);
        $data=array_slice($file,1);

        $parts=(array_chunk($data,1000));
        foreach($parts as $part){
            $fileName=resource_path('files/'.time().'.csv');
            file_put_contents($fileName,$part);

        }
        session()->flash('success','File Uploaded Successfully');
        return redirect()->route('admin');



        
    }
    public function sendEmail(Request $request){
        // $emails = EmailInfo::all()->pluck('email')->toArray();
        // $users = User::all();
        $message=$request->message;
        $emails = User::all()->pluck('email')->toArray();
        // send welcome email to all emails in the database
        foreach ($emails as $email) {
            Mail::to($email)->send(new WelcomeMail('John Doe'));
        }
    }
    public function show(){
        $files = scandir(public_path().'/files/');
        $files = array_diff($files,array('.','..'));
        return view('admin',compact('files'));
    }

}

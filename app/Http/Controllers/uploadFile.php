<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailInfo;
use App\Models\User;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use App\Jobs\VerifyEmail;
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
        $emailContent = $request->emails;
        
        
        $emails = User::all()->pluck('email')->toArray();
        foreach($emails as $email){
            dispatch(new VerifyEmail($email,$emailContent));
        }
        session()->flash('success','Email Sent Successfully');
        return redirect()->route('admin');

    }
    public function show(){
        $files = scandir(public_path().'/files/');
        $files = array_diff($files,array('.','..'));
        return view('admin',compact('files'));
    }

}

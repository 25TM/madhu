<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailInfo;
use App\Models\User;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use App\Jobs\VerifyEmail;
// use Spatie\SimpleExcel\SimpleExcelReader;
class uploadFile extends Controller
{
    public function store(Request $request)
    {
        // // dd('ff');
        // $request->validate([
        //     'file' => 'required|mimes:csv,txt',
        // ]);
        $file = $request->file('csv_file');
        // dd($file);
        $file_name = $file->getClientOriginalName();
        // store in files
      
        $file->move(public_path('files').'/', $file_name);
        $file_path = public_path('files/').$file_name;
        $file = fopen($file_path, 'r');
        $emails = [];
        while(($line = fgetcsv($file)) !== false){
            $emails[] = $line[0];
        }
        fclose($file);
        // dd($emails);
       // upload to EmailInfo
        foreach($emails as $email){
            $emailInfo = new EmailInfo;
            $emailInfo->email = $email;
            $emailInfo->save();
        }

        
        return redirect()->route('admin')->with('success', 'File Uploaded successfully');



         
         


         




        
    }
    public function sendEmail(Request $request){
        $emailContent = $request->email;
        $attachement= $request->file('file');
        // dd($emailContent);
        $emails = EmailInfo::all()->pluck('email')->toArray();
        // attach mail
       
        Mail::to($emails)->send(new WelcomeMail(
            $emails,
          $emailContent
        ));
        
        


        // dd($emails);
        // Mail::to($emails)->send(new WelcomeMail($emails/*$emailContent*/));
        // foreach($emails as $email){
        //     VerifyEmail::dispatch($email,$emailContent);
        // }
        session()->flash('success','Email Sent Successfully');
        return redirect()->route('admin');

    }
    public function show(){
        $files = scandir(public_path().'/files/');
        $files = array_diff($files,array('.','..'));
        return view('admin',compact('files'));
    }

}

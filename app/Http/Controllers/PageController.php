<?php

namespace App\Http\Controllers;
use Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;
use App\Mail\TestEmail;


class PageController extends Controller
{
    //
    /*public function home(){
        return view('home');
    }*/
    public function index(){
        return view('index');
    }
    public function login(Request $req){
        $msg_txt = "";$msg_type = ""; $email=""; $msg = [];
        if(!filter_var($req->email, FILTER_VALIDATE_EMAIL))// Return Error - Invalid Email
        {
            $msg_txt = 'The email you have entered is invalid, please try again.';
        }
        else{
    		$users = \DB::table('users')->whereemail($req->email)->get();
    	
            if(count($users) > 0)
            {
                if($users[0]->password == md5($req->password))
                {
                    if($users[0]->active == '1')   
                	{
                		Session::put('username',$users[0]->email);
                		Session::put('userstatus','1');
		                Session::put('userid',$users[0]->id);
                	}
                    else if($users[0]['hash'] != "") {
                    	$msg_txt = "Your account had been made, <br /> please verify it by clicking the activation linkhat had been sent to your email.";
                    	$msg_type = "success";
                    }
                    else {
                    	$msg_txt = "Your Email is not active";
                    	$msg_type = "error";
                    }
                }
                else{
                	$msg_txt = "Your password is not correct";
                	$msg_type = "error";
                }
                $email = $req->email;
            }
            else
            {
                $hash = md5( rand(0,1000) );
                $val = \DB::table('users')->insert(['email'=>$req->email,'password'=>md5($req->password),'active'=>'0','hash'=>$hash]);
                $msg_txt = "Your account has been made, please verify it by clicking the activation linkhat has been sent to your email.";
                $msg_type = "success";

			    $body = "Thanks for signing up!	Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.Please click this link to activate your account:http://localhost:8000/activation/".$req->email ."/".$hash;

				$data = array('email'=>$req->email, "body" => $body);
				Mail::send('emails.mail', $data, function($message)use ($data) {
				    $message->to($data['email'], '')->subject('Signup | Verification');
				    $message->from('zmobaraky@gmail.com','Zara Mobaraki');
				});	

            }

        }
        $msg = ['msg_txt'=>$msg_txt,'msg_type'=>$msg_type,'email'=>$email];
        return view('index',compact('msg'));
    }
    
    public function logout(){
    	Session::flush();
        return redirect('/');
    }
	
	public function activation($email,$hash){
		
        $msg_txt = "";$msg_type="";
        if (isset($email) && isset($hash)) {
 			$users = \DB::table('users')->whereemail($email)->wherehash($hash)->whereactive('0')->get();
            if(count($users) > 0)
            {
            	\DB::table('users')->whereemail($email)->update(['active'=>'1','hash'=>'']);
                Session::put('userid',$users[0]->id);
                Session::put('username',$users[0]->email);
                Session::put('userstatus','1');
                $msg_txt = "The user has been activated successfully";
                $msg_type = "success";
            }
            
            else
            {
                $msg_txt = "An error has been occured in user activation. The link is not valid";
                $msg_type = "error";
            }
        }
        $msg = ['msg_txt'=>$msg_txt,'msg_type'=>$msg_type];
        return view('index',compact('msg'));
        //return redirect('/');
	}

}

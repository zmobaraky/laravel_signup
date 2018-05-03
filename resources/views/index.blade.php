@extends('main')
@if(!empty($msg))
@section('message')
    <div id = "message" class="@if(!empty($msg['msg_type'])){{$msg['msg_type']}}@endif">
        @if(!empty($msg['msg_type'])) 
        @if ($msg['msg_type']=='success')
          <img src="/images/success.png" />
        @else
          <img src="/images/error.jpeg" />
        @endif
        @endif
        <div id="msg_txt">{{$msg['msg_txt']}}</div>
    </div>
@endsection
@endif
@if (Session::has('username') && Session::has('userid') && Session::has('userstatus'))
  @section('title','Profile')
  @section('content')
     <div class="p_box">
        email: {{Session::get('username')}}<br /><br />
        user id: {{Session::get('userid')}}<br /><br />
        status: 
        @if (Session::get('userstatus') == '1') 
        Active
        @else
        Not active
        @endif
        <br /><br /><br />
        <a href="/logout">logout</a>
    </div>
 @endsection
@else
  @section('title','Login / Sign up')
  @section('content')
     <div id="wrap">
          <h3>Login / Signup Form</h3>
          <p>Please enter your name and email addres to create your account</p>
          <div id="msg">
          </div>
          <!-- start sign up form -->
          <form id="login" action="/login" method="post">
              {{csrf_field()}}
              <label for="email">Email:</label>
              <input type="email" name="email" id="email" placeholder="example@domain.com"  value="@if(!empty($msg['email'])){{$msg['email']}}@endif" />
              <label for="password">Password:</label>
              <input type="password" name="password" id="password" value="" />
<input name="_token" type="hidden" value="{{ csrf_token() }}" />
              <input type="submit" class="submit_button" value="Login" />

          </form>
          <!-- end sign up form -->
      </div>
  @endsection
@endif
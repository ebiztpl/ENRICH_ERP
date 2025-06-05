@extends('layouts.etemplate')
@section('auth-body')
<?php 
//echo $_GET['gt'];
if(isset($_GET['gt'])){
    if($_GET['gt'] == 7 || $_GET['gt'] == 1){
        $email = 'admin@enrichapp.co.in'; 
    }elseif($_GET['gt'] == 3){
        $email = 'accountant@enrichapp.co.in'; 
     }elseif($_GET['gt'] == 0){
         $email = 'superadmin@enrichapp.co.in'; 
     
    }else{

        $email = ''; 
		$password = ''; 
    }

$password = '123456'; 
$dis = "display:none";


$geid = $_GET['br'];
	
	
	
	
$activecollege = \DB::table('branches')->where('id',$geid)->first();
	//echo $geid;
	//print_r($activecollege);die;
Session::put('branch_array',$activecollege);
// $activ = Session::get('branch_array');
// echo $activ->name;die;
$withoutlogin="display:none;";

}else{
	$withoutlogin ="";
    $email = ''; 
$password = ''; 
    $dis = "display:none";
  //   $url =  'https://enrichapp.co.in/eaccount/public/bank-cash/pagenotfound'; // this can be set based on whatever
     // no redirect
  //   header( "Location: $url" );
   // exit;
 
}


?>

    <div class="limiter" style="<?= $dis ?>">
        <div class="container-login100" style="background-image: url( '{{ asset('asset/layout/images/1.jpg') }}');">
            <div class="wrap-login100">
                <form id="sign_in" method="POST" action="{{ route('login') }}" class="login100-form validate-form">
                    @csrf
                    <span class="login100-form-logo">
                        <img class="w-50 h-50" src="{{ asset(config('settings.company_logo')) }}">
                    </span>
                    <span class="login100-form-title p-b-34 p-t-20">
                        Log in
                    </span>
                    <div class="wrap-input100 validate-input" data-validate="E-Mail Address">
                        <input placeholder="E-Mali Address" id="email" type="email" class="input100 " name="email"
                            value=" @if(old('email')) {{ old('email') }} @else {{$email}} @endif">
                        <span class="focus-input100" data-placeholder="&#xf15a;"></span>
                        @if ($errors->has('email'))
                            <span role="alert">
                                <strong class="text-black">{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <input placeholder="Password" id="password" type="password" class="input100" name="password" value="{{$password}}">
                        <span class="focus-input100" data-placeholder="&#xf191;"></span>
                        @if ($errors->has('password'))
                            <span role="alert">
                                <strong class="text-red">{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="contact100-form-checkbox">
                        <input id="ckb1" class="input-checkbox100" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="label-checkbox100" for="ckb1">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            {{ __('Login') }}
                        </button>
                    </div>
                    @if (env('DEMO_MODE') == true)
                        <div class="text-center p-t-30">
                            <table class="table table-bordered table-sm table-hover table-info">
                                <thead>
                                    <tr>
                                        <th colspan="2">Demo Login</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">Email</th>
                                        <th scope="col">Password</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>admin@eaccount.xyz</td>
                                        <td>1234</td>
                                    </tr>
                                    <tr>
                                        <td>projectmanager@eaccount.xyz</td>
                                        <td>1234</td>
                                    </tr>
                                    <tr>
                                        <td>vouchermanage@eaccount.xyz</td>
                                        <td>1234</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>





    <div class="limiter" style='<?=$withoutlogin;?>'>
        <div class="container-login100" style="background-image: url( '{{ asset('asset/layout/images/1.jpg') }}');">
            <div class="wrap-login100">
             <h3>Your Login Session has been expired Kindly go back to your website and login again.</h3>
            </div>
        </div>
    </div>




@stop
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
  $("form#sign_in").submit();
// alert('1');
});
</script>

@if(isset(Auth::user()->email) and Auth::user()->role == "Customer")
<?php
include_once(base_path() . '\resources\views\customers_nav_bar.blade.php');
?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bootstrap Simple Login Form</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
    .login-form {
        width: 340px;
        margin: 50px auto;
    }
    .login-form form {
        margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {
        font-size: 15px;
        font-weight: bold;
    }
</style>
<div class="container">
<div class="login-form">
    <form action="{{URL::asset('register/createuser')}}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <h2 class="text-center">Profile</h2>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Name" required="required" name="name" value="{{Auth::user()->name}}">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Email" required="required" name="email" value="{{Auth::user()->email}}">
        </div>

        <div class="form-group">
            <input type="text" class="form-control" placeholder="Contact Number" required="required" name="mobile" value="{{Auth::user()->mobile}}">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Only district" required="required" name="address" value="{{Auth::user()->address}}">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block" id="submit" >Register</button>
        </div>

    </form>
</div>
</div>
@else
    <script> window.location.href = "{{URL::asset('login')}}" </script>
@endif
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Simple Login Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">

        body {
            background: url("../public/assets/images/hh.jpg");
        }

        .login-form {
            width: 340px;
            margin: 50px auto;
        }
        a{
            color: silver;
        }

        .login-form form {
            margin-bottom: 15px;
           // background: #f7f7f7;
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
</head>
<body>

@if($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
        <strong>{{$message}}</strong>
    </div>
@elseif($message = Session::get('success'))
    <div class="alert-success">
        <strong>{{$message}}</strong>
    </div>
@endif


@if (count($errors)>0)
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>

@endif
<div class="login-form">
    <form action="{{URL::asset('login/checklogin')}}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <h2 class="text-center" style="color: silver;">S I T T E R S <span class="glyphicon glyphicon-heart-empty"></span> </h2>
        <p class="text-center" style="color: silver;">Log in</p>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Username" required="required" name="username">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" required="required" name="password">
        </div>
        <div class="form-group">
            <button style=" opacity: 0.5;
  filter: alpha(opacity=50); " type="submit" class="btn btn-default btn-block">Sit inside <span class="glyphicon glyphicon-menu-right"></span></button>
        </div>
       {{-- <div class="clearfix">
            <label class="pull-left checkbox-inline"><input type="checkbox"> Remember me</label>
            <a href="#" class="pull-right">Forgot Password?</a>
        </div>--}}
    </form>
    <p class="text-center"><a href="register">Create an Account</a></p>
    <p class="text-center"><a href="main/guest/home">Login as a guest <span class="glyphicon glyphicon-user"></span></a></p>
</div>
</body>
</html>                                		                            
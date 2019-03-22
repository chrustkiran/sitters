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


    <script  type="text/javascript">


        function checkmatch() {
            var password = document.getElementById("password").value;
            console.log(password);
            var confirmPassword = document.getElementById("repassword").value;
            console.log(confirmPassword);

            if (password != confirmPassword)
                $("#divCheckPasswordMatch").html("Passwords do not match!");
            else
                $("#divCheckPasswordMatch").html("Passwords match.");
        }

        $('#refresh').click(function(){
            $.ajax({
                type:'GET',
                url:'refreshcaptcha',
                success:function(data){
                    console.log(data.captcha);
                    document.getElementById('captcha').src = 'https://www.google.com/url?sa=i&source=images&cd=&ved=2ahUKEwiur86ti_rgAhUReisKHXmaAWgQjRx6BAgBEAU&url=http%3A%2F%2Fchittagongit.com%2Ficon%2Fimg-icon-14.html&psig=AOvVaw2LaKt5r7c-ddfFyHkDaW8y&ust=1552393707447736';
                    //$(".captcha span").html(data.captcha);
                }
            });
        });
    </script>
</head>
<body>

@if($message = Session::get('error'))
    <div class="aler alert-danger alert-block">
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
    <form action="{{URL::asset('register/createuser')}}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <h2 class="text-center">Register</h2>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Name" required="required" name="name">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Email" required="required" name="email">
        </div>

        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" required="required" name="password" id="password">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Re enter password" required="required" name="repassword" onkeyup="checkmatch()" id="repassword">
        </div>
        <div class="registrationFormAlert" id="divCheckPasswordMatch"></div>
        <div class="form-group">
        <div class="captcha" >
            <img src="http://localhost/laravel/public/captcha/default?Tk7WqDsi" id="captcha_img">

            <button type="button" class="btn btn-success" id="refresh"><i class="fa fa-refresh" >R</i></button>
        </div>
        </div>
        <div class="form-group">
            <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block" id="submit" >Register</button>
        </div>

    </form>
    <p class="text-center"><a href="main/guest/home">Login as a guest</a></p>
</div>
</body>


<script>
    $('#refresh').click(function(){
        $.ajax({
            type:'GET',
            url:'refreshcaptcha',
            success:function(data){
                console.log(data.captcha);
                document.getElementById("captcha_img").src = data.captcha;
                //$(".captcha span").html(data.captcha);
            }
        });
    });
</script>
</html>

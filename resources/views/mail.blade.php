<p>
    Please verify your account, use this key
    @if(Session::has('remember_token'))
        {{Session::get('remember_token')}}
    @endif

</p>
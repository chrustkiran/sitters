@if(isset(Auth::user()->email) and Auth::user()->role == "Customer")
 <?php
         include_once (base_path().'\resources\views\customers_nav_bar.blade.php');
 ?>

<div class="container">
    <h1>Customer Home</h1>
    <h2>Welcome {{Auth::user()->name}}</h2>
</div>

</body>
</html>
@else
    <script> window.location.href = "{{URL::asset('login')}}" </script>
@endif
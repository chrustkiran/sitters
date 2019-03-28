
 {{--   <?php
    require(base_path().'\resources\views\customers_nav_bar.blade.php');
    ?>--}}

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            background: url("../../assets/images/hh.jpg");
        }
        a{
            color : silver;
        }

    </style>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(document).ready(function(e){
            console.log($('#drop_down_btn').val());
            $('.dropdown-menu').find('a').click(function(e) {
                e.preventDefault();
                var param = $(this).attr("href").replace("#","");
                var concept = $(this).text();
                $('#drop_down_btn').text(concept);
                $('#drop_down_btn').val(param);
                console.log($('#drop_down_btn').val());

                $.ajax({
                    type:'POST',
                    url:'filter',
                    data: {'filter' : $('#drop_down_btn').val(),
                        'search' : $('#search').val()},
                    success:function(data) {
                        console.log(data.msg);
                        $("#main_post").html(data.msg);
                    }
                });
            });
        });

        function search() {
            $.ajax({
                type:'POST',
                url:'filter',
                data: {'filter' : $('#drop_down_btn').val(),
                    'search' : $('#search').val()},
                success:function(data) {
                    console.log(data.msg);
                    $("#main_post").html(data.msg);
                }
            });
        }


        function toggleFunc(id){
            window.location.href = "../../register";
          /*  var x = document.getElementById("post_body"+id);
            var y = document.getElementById("post_footer"+id)
            if (x.style.display === "none") {
                x.style.display = "block";
                y.style.display = "block";
                document.getElementById("show_more"+id).innerHTML = "<button> show less (-) </button>"
            } else {
                x.style.display = "none";
                y.style.display = "none";
                document.getElementById("show_more"+id).innerHTML = "<button> show more (+)</button>"
            }*/
        }


    </script>

    <div class="container">
        <h2 class="text-center" style="color: silver;">S I T T E R S <span class="glyphicon glyphicon-heart-empty"></span> - GUEST </h2>
        <!-- Search bar -->
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <button id="drop_down_btn" value="both" class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Select</button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="both">Everything</a>
                    <a class="dropdown-item" href="with">With Images</a>
                    <a class="dropdown-item" href="without">Without Images</a>
                </div>
            </div>
            <input id="search" type="text" class="form-control" onkeyup="search()" aria-label="Search...">
        </div>

        <!-- end of search bar -->

        <br>

        <h2 class="text-center" style="color: silver">You want to <a style="color:white;" href="../../login">login</a>?  </h2>
        <h3 class="text-center" style="color: silver;">These are the active posts for you</h3>
        <div id="main_post">
            @include('post')
        </div>
    </div>

    </body>
    </html>



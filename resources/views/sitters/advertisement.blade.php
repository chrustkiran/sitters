@if(isset(Auth::user()->email) and Auth::user()->role != "Customer")
    <?php
    include_once(base_path() . '\resources\views\sitters_nav_bar.blade.php');
    ?>
    <head>
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </head>
    <div class="container">
        <br>
        @if(count($data['ad']['active'])==0)
        <div  style="width:150px;margin-left: auto; margin-right: auto;">
            <img class="card-img-top" data-toggle="modal" data-target="#myModal" src="{{URL::asset('/assets/images/add_heart.jpg')}}" alt="Card image">
        </div>
        @else
            <div  style="width:150px;margin-left: auto; margin-right: auto;">
                <img class="card-img-top" data-toggle="modal" data-target="#myModalActive" src="{{URL::asset('/assets/images/add_heart.jpg')}}" alt="Card image">
            </div>
        @endif

     {{--   <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

        <!-- Modal -->--}}

    <!-- The Modal -->
        <div class="modal" id="myModalActive">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="text-center">Sorry</h2>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                        <h3>
                     There is an active advertisement of yours :)
                        </h3>

                </div>
            </div>
        </div>
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h2 class="text-center">New Advertisement</h2>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <form action="{{URL::asset('main/sitters/createad')}}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <textarea type="text" class="form-control" placeholder="Availability" required="required" name="availability"></textarea>
                        </div>
                        <div class="form-group">
                           <select class="form-control" placeholder="Type" required="required" name="roles">
                                @foreach($data['roles'] as $role)
                                    <option value="{{$role->role}}">{{$role->role}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">

                            <select class="form-control" placeholder="Postcode" required="required" name="postcode">
                                @foreach($data['postcodes'] as $postcode)
                                    <option value="{{$postcode->postcode}}">{{$postcode->postcode}} {{$postcode->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Mobile" required="required" name="mobile">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Price per hour" required="required" name="price">
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control" placeholder="Price per hour"  name="images[]" multiple accept="image/*">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" id="submit" >Add</button>
                        </div>

                    </form>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>

<div class="panel-body">
    <h3><span class="label label-success">Active</span></h3>
        <br>

    @foreach($data['ad']['active'] as $active)
        <?php $index_num = 0 ?>
        <div class="card" style=" width: 25rem;">
            @if($active->image == 1)
          <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
            @foreach($data['images'] as $image_array)
            @if($image_array->adv_id == $active->id)
                @if($index_num ==0)
                        <div class="carousel-item active">
            <img class="d-block w-100" src="{{$image_array->images}}" alt="" width="50" height="200">
                        </div>
                        @else
                            <div class="carousel-item ">
                                <img class="d-block w-100" src="{{$image_array->images}}" alt="" width="50" height="200">
                            </div>
                        @endif
                {{$index_num++}}
            @endif
            @endforeach
                </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                 <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                 <span class="sr-only">Previous</span>
             </a>
             <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                 <span class="carousel-control-next-icon" aria-hidden="true"></span>
                 <span class="sr-only">Next</span>
             </a>
             </div>
            @else
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="" alt="No Image for this advertisement" width="50" height="200">
                    </div>
                </div>

            @endif
            <div class="card-header">Price : {{$active->price}}</div>
            <div class="card-body">Availability : {{$active->availability}}   <br>
                Roles : {{$active->roles}}<br>
                Location : {{$active->location}} <br>
                Mobile : {{$active->mobile}}
            <button onclick="deleteTag({{$data['ad']['active'][0]->id}})" class="btn btn-danger" style="float: right;">delete</button>
                 <button data-toggle="modal" data-target="#myEditingModal" class="btn btn-warning" style="float: right;">edit</button>
            </div>
            <div class="card-footer">Created at : {{$active->created_at}} <br> Updated at : {{$active->updated_at}}</div>
        </div>
        @endforeach

</div>
        <br>

        <div class="container">
            <h3><span class="label label-danger">Expired</span></h3>
            <br>
            @foreach($data['ad']['expired'] as $active)
                <div class="card">
                    <div class="card-header">Price : {{$active->price}}</div>
                    <div class="card-body">Availability : {{$active->availability}}
                    <br>
                    Roles : {{$active->roles}}</div>
                    <div class="card-footer">Assigned to : <br>Created at : {{$active->created_at}}</div>
                </div>
                <br>
            @endforeach
        </div>
    </div>
    <!-- edit menu -->
    <div class="modal" id="myEditingModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h2 class="text-center">New Advertisement</h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="{{URL::asset('main/sitters/editAd')}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="{{ $data['ad']['active'][0]->id }}">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Availability" required="required"  value="{{$data['ad']['active'][0]->availability}}" name="availability">


                    </div>
                    <div class="form-group">
                        <select class="form-control" placeholder="Type" required="required"  value="{{$data['ad']['active'][0]->roles}}" name="roles">
                           <option values="{{$data['ad']['active'][0]->roles}}"> {{$data['ad']['active'][0]->roles}}</option>
                            @foreach($data['roles'] as $role)
                                @if($data['ad']['active'][0]->roles != $role->role)
                                <option value="{{$role->role}}">{{$role->role}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">

                        <select class="form-control" placeholder="Postcode" required="required"  name="postcode">
                            @foreach($data['postcodes'] as $postcode)
                                @if($postcode->name == $data['ad']['active'][0]->location)
                            <option value="{{$data['ad']['active'][0]->location}}">  {{$postcode->postcode}} {{$data['ad']['active'][0]->location}}</option>
                                @endif
                            @endforeach
                            @foreach($data['postcodes'] as $postcode)
                                    @if($postcode->name != $data['ad']['active'][0]->location)
                                <option value="{{$postcode->name}}">{{$postcode->postcode}} {{$postcode->name}}</option>
                                    @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Mobile" value="{{$data['ad']['active'][0]->mobile}}" required="required" name="mobile">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Price per hour" value="{{$data['ad']['active'][0]->price}}" required="required" name="price">
                    </div>
                    <div class="form-group">
                        @if($data['ad']['active'][0]->image== false)
                            <span>You have no image</span>
                        @else
                            <span>You have selected some images, change it here</span>
                        @endif
                        <input type="file" class="form-control" placeholder=""  name="images[]" multiple accept="image/*">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block" id="submit" >Update</button>
                    </div>

                </form>
                <!-- Modal footer -->
                <script>
                    function deleteTag(id){

                        if (confirm("Are you sure to delete this?")) {
                            
                        } else {
                            txt = "You pressed Cancel!";
                        }
                    }

                </script>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>


            </div>
        </div>
    </div>


@endif

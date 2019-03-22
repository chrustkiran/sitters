<html>
<div class="panel-body">
    <div class="row">

        @foreach($data['posts'] as $active)

            <div class="col-sm-3">
                <?php $index_num = 0 ?>
                <div class="card" style=" width: 18rem;">

                    @if($active->image == 1)
                        <div id="ref{{$active->id}}" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($data['images'] as $image_array)
                                    @if($image_array->adv_id == $active->id)
                                        @if($index_num ==0)
                                            <div class="carousel-item active">
                                                <img class="d-block w-100" src="{{$image_array->images}}" alt="Card image cap" width="50" height="150">
                                            </div>
                                        @else
                                            <div class="carousel-item ">
                                                <img class="d-block w-100" src="{{$image_array->images}}" alt="Card image cap" width="50" height="150">
                                            </div>
                                        @endif
                                        {{$index_num++}}
                                    @endif
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#ref{{$active->id}}" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#ref{{$active->id}}" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    @else
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="" alt="No Image for this advertisement" width="50" height="150">
                            </div>
                        </div>

                    @endif
                    <div class="card-header" style="font-weight:bold">Type : {{$active->roles}} <br>
                        Location : {{$active->location}}</div>

                    <div style="display: none;" id="post_body{{$active->id}}"class="card-body">By {{$active->username}} <br>
                        Availability : {{$active->availability}} <br>
                        Price : {{$active->price}} <br>
                        Contact Number : {{$active->mobile}}
                    </div>
                    <div style="display: none;" id="post_footer{{$active->id}}"class="card-footer">Created at : {{$active->created_at}}</div>

                    <div id="show_more{{$active->id}}" onclick="toggleFunc({{$active->id}});" class="card-footer"><button>show more (+)</button></div>
                </div><br><br>
            </div>

        @endforeach
    </div>
</div>

</html>
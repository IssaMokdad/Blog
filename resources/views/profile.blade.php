@extends('layouts.app')

@section('content')
<div class='container'>
    <div class='row'>
        <div class='col-3'>
            <h1>{{$user->first_name}} {{$user->last_name}}</h1>
            @if(Auth::id()===$user->id)
            @if(Auth::user()->image)
            <img class='rounded' width='200' height='200' src='{{asset ('uploads')}}/{{$user->image}}'>
            @else
            <img class='rounded' width='200' height='200' src='{{asset ('uploads/nophoto.png')}}'>
            @endif
            <form enctype="multipart/form-data" method='post' action='{{url('home/profile')}}'>
                @csrf
                <div class='form-group'>
                    <input required type='file' id="image"
                        class="border-0 form-control @error('image') is-invalid @enderror" name="image"
                        autocomplete="name" autofocus>

                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button type='submit' class='btn btn-primary'>@if(Auth::user()->image) Change photo @else Add Photo @endif</button>
            </form>

            @else
            @if($user->image)
            <img class='rounded' width='200' height='200' src='{{asset ('uploads')}}/{{$user->image}}'>
            @else
            <img class='rounded' width='200' height='200' src='{{asset ('uploads/nophoto.png')}}'>
            @endif
            @endif
        </div>





        <div class='col-9'>
            <div class='text-center'><a href='{{url('home/addpost')}}' class='btn btn-primary mb-4'>Add Post</a></div>
            @foreach ($list as $item)
            @csrf
            <div class='text-center'>


                <div class="media mt-3">
                    @if(!$item->user['image'])
                    <img src="{{asset ('uploads/nophoto.png')}}" class="align-self-top mr-3"
                        style="width:60px">
                    @else
                    <img src="{{asset ('uploads')}}/{{$item->user['image']}}" class="align-self-top mr-3"
                        style="width:60px">
                    @endif
                    <div class="media-body">
                        <a class='text-decoration-none' href='{{ url('home/post')}}/{{$item->id}}'>
                            <h4 class='border border-default'>{{$item->title}}</h4>
                        </a>
                        <textarea rows='3' readonly
                            class='w-100 bg-grey border-black p-2'>{{$item->content}}</textarea>
                        @if($item['user_id']===Auth::id())<form id="deleteForm{{$item->id}}" method='post'
                            action='{{url('home/deletepost')}}'>@csrf<input type='number' name='id'
                        value='{{$item->id}}' class='d-none' readonly><button type='submit' id='{{$item->id}}'
                                class='btn deletePost buttonClass border-0 btn-link'><i style='transform:scale(1.5);'
                                    class="fa fa-window-close"></i></button>
                        </form>
                        <form action='{{url('home/edit/post')}}/{{$item->id}}'><button
                                class='btn editClass border-0 btn-link'><i style='transform:scale(1.5);'
                                    class="fa fa-edit"></i></button></form>
                        @endif
                        @if($item->likes)
                        @if(in_array(Auth::id(),array_column($item->likes->toArray(), 'user_id')))
                        @if(Auth::id()===$user->id)<div class='divLikeCommentContainer'>@else<div> @endif<span
                                    id='totalComments{{$item->id}}'>@if($item->comments->count()>0)
                                    {{$item->comments->count()}}
                                    Comments @else @endif</span> <button data-id='{{$item->id}}'
                                    id='removeLike{{$item->id}}' class="border-0 removeLike"><span
                                        id='totalLike{{$item->id}}'>{{$item->likes->count()}}</span> <i
                                        class="fas fa-thumbs-up"></i></button>
                                <button data-id='{{$item->id}}' id='addLike{{$item->id}}'
                                    class="border-0 d-none addLike"><span id='totalAfterDislike{{$item->id}}'></span> <i
                                        class="far fa-thumbs-up"></i></button></div>
                            @else
                            @if(Auth::id()===$user->id)<div class='divLikeCommentContainer'>@else <div>@endif<span
                                        id='totalComments{{$item->id}}'>@if($item->comments->count()>0)
                                        {{$item->comments->count()}}
                                        Comments @else @endif</span><button data-id='{{$item->id}}'
                                        id='removeLike{{$item->id}}' class="border-0 d-none removeLike"><span
                                            id='totalLike{{$item->id}}'></span> <i
                                            class="fas fa-thumbs-up"></i></button>
                                    <button data-id='{{$item->id}}' id='addLike{{$item->id}}'
                                        class="border-0 addLike"><span
                                            id='totalAfterDislike{{$item->id}}'>@if($item->likes->count()>0){{$item->likes->count()}}@endif</span>
                                        <i class="far fa-thumbs-up"></i></button></div>
                                @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div style='margin-top:5%; margin-left:40%;'>{{ $list->links() }}</div>
                </div>


            </div>
        </div>
        @endsection
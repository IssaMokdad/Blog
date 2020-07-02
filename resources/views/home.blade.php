@extends('layouts.app')

@section('content')

<div class="container">
    <div class='row'>
        <div class='col-10'>
            <div class='text-center'><a href='{{url('home/addpost')}}' class='btn btn-primary mb-4'>Add Post</a></div>
            @foreach ($list as $item)
            @csrf
            <div class='text-center'>
                <div class=" media mt-3">
                    @if(!$item->image)
                    <img src="data:image/png;base64,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"
                        class="align-self-top mr-3" style="width:60px">
                    @else
                    <img src="{{asset ('uploads')}}/{{$item->image}}" class="align-self-top mr-3" style="width:60px">
                    @endif
                    <div class="media-body">
                        <a class='text-decoration-none' href='{{ url('home/post')}}/{{$item->id}}'>
                            <h4 class='border border-default'>{{$item->title}}</h4>
                        </a>
                        <textarea rows='3' readonly
                            class='w-100  bg-grey border border-1 rounded border-primary p-2'>{{$item->content}}</textarea>
                        @if($item['user_id']===Auth::id())<form id='deleteForm{{$item->id}}' method='post'
                            action='{{url('home/deletepost')}}'>@csrf<input type='number' name='id'
                                value='{{$item->id}}' class='d-none' readonly><button id='{{$item->id}}' type='submit'
                                class='btn deletePost buttonClass border-0 btn-link'><i style='transform:scale(1.5);'
                                    class="fa fa-window-close"></i></button>
                        </form>
                        <form class='editClass' action='{{url('home/edit/post')}}/{{$item->id}}'><button
                                class='btn  border-0 btn-link'><i style='transform:scale(1.5);'
                                    class="fa fa-edit"></i></button></form>
                        @endif
                        @if($item->likes)
                        @if(in_array(Auth::id(),array_column($item->likes->toArray(), 'user_id')))
                        @if(Auth::id()===$item->user['id'])<div class='mt-0 divLikeCommentContainer'>@else <div>
                                @endif<span>Posted by <a class='text-decoration-none'
                                        href='{{url('home/profile')}}/{{$item['user_id']}}'>
                                        {{$item->user['first_name']}} {{$item->user['last_name']}}</a><span
                                        id='totalComments{{$item->id}}'>@if($item->comments->count()>0)
                                        {{$item->comments->count()}}
                                        Comments @else @endif</span> <button data-id='{{$item->id}}'
                                        id='removeLike{{$item->id}}' class="border-0 removeLike"><span
                                            id='totalLike{{$item->id}}'>{{$item->likes->count()}}</span> <i
                                            class="fas fa-thumbs-up"></i></button>
                                    <button data-id='{{$item->id}}' id='addLike{{$item->id}}'
                                        class="border-0 d-none addLike"><span
                                            id='totalAfterDislike{{$item->id}}'></span> <i
                                            class="far fa-thumbs-up"></i></button></div>
                            @else

                            <span>Posted by <a class='text-decoration-none'
                                    href='{{url('home/profile')}}/{{$item['user_id']}}'>
                                    {{$item->user['first_name']}} {{$item->user['last_name']}}</a>
                            </span> <span id='totalComments{{$item->id}}'>@if($item->comments->count()>0)
                                {{$item->comments->count()}}
                                Comments @else @endif</span><button data-id='{{$item->id}}' id='removeLike{{$item->id}}'
                                class="border-0 d-none removeLike"><span id='totalLike{{$item->id}}'></span> <i
                                    class="fas fa-thumbs-up"></i></button>
                            <button data-id='{{$item->id}}' id='addLike{{$item->id}}' class="border-0 addLike"><span
                                    id='totalAfterDislike{{$item->id}}'>@if($item->likes->count()>0){{$item->likes->count()}}@endif</span>
                                <i class="far fa-thumbs-up"></i></button>
                                @if(!empty($item->comments->toArray()))
                                <div style='max-height:200px; overflow:auto;' id="post{{$item->id}}">
                                @foreach($item->comments as $comment)
                                <div class='mt-2 border rounded border-1 border-dark form-group'><textarea readonly
                                        class='form-control mb-2'>{{$comment->comment}}</textarea></div>
                                @endforeach</div>
                                 @else <div class='d-none' style='max-height:200px; overflow:auto;' id="post{{$item->id}}"></div>@endif



                            @endif
                            <form method='post' class='addComment' id='{{$item->id}}'>
                                @csrf
                                <div class='form-group'><input id='addComment{{$item->id}}' type="text"
                                        class='mt-0 border border-1 border-success form-control' required></div>
                                <button type='submit' class='btn btn-primary mb-4'>Comment</button>
                                <hr class="border border-3 border-danger">
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div style='margin-top:5%; margin-left:40%;'>{{ $list->links() }}</div>
        </div>
        @endsection
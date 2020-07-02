@extends('layouts.app')

@section('content')
<div class="container">
    <div class='row'>
        <div class='col-12'>
            {{-- @foreach ($list as $item)   --}}
            <a href="{{url()->previous()}}">Back</a>
            <div class='text-center'>
                <h3 class="text-primary mb-2">{{$item->title}}</h3>
                <div class='' id='post{{$item->id}}'>
                    <div class='form-group'>
                        @if($item['user_id']===Auth::id())<form id="deleteForm{{$item->id}}" method='post'
                            action='{{url('home/deletepost')}}'>@csrf<input type='number' name='id'
                        value='{{$item->id}}' class='d-none' readonly> <button type='submit' id="{{$item->id}}"
                                class='btn deletePost buttonClasss border-0 btn-link'><i class="fas fa-window-close"></i></button>
                        </form><a href='{{url('home/edit/post')}}/{{$item->id}}'><button
                                class='btn editClasss border-0 btn-link'><i class="fas fa-edit"></i></button></a>@endif
                        <textarea readonly class='form-control mb-2'>{{$item->content}}</textarea></div>
                    @if($item->likes)
                    @if(in_array(Auth::id(),array_column($item->likes->toArray(), 'user_id')))
                    <span id='totalComments{{$item->id}}'>@if($item->comments->count()>0) {{$item->comments->count()}}
                        Comments @else @endif</span> <button data-id='{{$item->id}}' id='removeLike{{$item->id}}'
                        class="mb-2 border-0 removeLike"><span
                            id='totalLike{{$item->id}}'>{{$item->likes->count()}}</span> <i
                            class="fas fa-thumbs-up"></i></button>
                    <button data-id='{{$item->id}}' id='addLike{{$item->id}}' class="border-0 mb-2 d-none addLike"><span
                            id='totalAfterDislike{{$item->id}}'></span> <i class="far fa-thumbs-up"></i></button>
                    @else
                    <span id='totalComments{{$item->id}}'>@if($item->comments->count()>0) {{$item->comments->count()}}
                        Comments @else @endif</span><button data-id='{{$item->id}}' id='removeLike{{$item->id}}'
                        class="mb-2 border-0 d-none removeLike"><span id='totalLike{{$item->id}}'></span> <i
                            class="fas fa-thumbs-up"></i></button>
                    <button data-id='{{$item->id}}' id='addLike{{$item->id}}' class="border-0 mb-2 addLike"><span
                            id='totalAfterDislike{{$item->id}}'>@if($item->likes->count()>0){{$item->likes->count()}}@endif</span>
                        <i class="far fa-thumbs-up"></i></button>
                    @endif
                    @endif
                    @if($item->comments)
                    @foreach($item->comments as $comment)
                    <div class='mt-2 form-group'><textarea id="{{$comment->id}}" readonly
                            class='form-control mb-2'>{{$comment->comment}}</textarea></div>
                    @endforeach
                    @endif
                </div>
                <form method='post' class='addComment' id='{{$item->id}}'>
                    @csrf
                    <div class='form-group'><input id='addComment{{$item->id}}' type="text" class='form-control'
                            required></div>
                    <button type='submit' class='btn btn-primary mb-4'>Comment</button>
                </form>
                {{-- @endforeach --}}
            </div>
        </div>
    </div>

</div>
@endsection
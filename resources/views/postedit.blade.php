@extends('layouts.app')

@section('content')
<div class="container">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
    <div class='row'>
        <div class='col-12'>
        <a href="{{url()->previous()}}">Back</a>
            <div class=''>
                <div class='text-center' id='post{{$item->id}}'>
                    <div class='form-group'>
                        @if($item['user_id']===Auth::id())<form id="deleteForm{{$item->id}}" method='post'
                            action='{{url('home/deletepost')}}'>@csrf<input type='number' name='id'
                    value='{{$item->id}}' class='d-none' readonly> <button type='submit' id="{{$item->id}}"
                                class='btn deletePost buttonClass1 border-0 btn-link' ><i class="fas fa-window-close"></i></button>
                        </form>@endif<form enctype="multipart/form-data" method='post' action='{{url()->current()}}'>@csrf<input required value='{{$item->title}}' name='title' class="text-center form-control mb-4">
                        <input readonly value='{{$item->id}}' name='id' class="d-none"><textarea required name='content' class='form-control '>{{$item->content}}</textarea>
                        <div class="form-group row">
                            <label style="margin-left:3em;" for="post content"
                                class="col-md-6 col-form-label text-md-right">@if($item->image)Change the photo @else Upload a photo @endif</label>

                            <input type='file' id="image"
                                class="border border-primary form-control @error('image') is-invalid @enderror"
                                name="image" autocomplete="name" autofocus>

                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <button style='margin-left:47%;' type='submit' class='btn mt-2 d-block btn-primary'>Edit</button></form>
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
                        <i class="far fa-thumbs-up"></i></button></form>
                    @endif
                    @endif
                    @if($item->comments)
                    @foreach($item->comments as $comment)
                    <div class='mt-2 form-group'><textarea id="{{$comment->id}}" readonly
                            class='form-control mb-2'>{{$comment->comment}}</textarea></div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@extends('layouts.app')

@section('title', 'Show Post')

@section('content')

        <style>
            body {
                background-color: #b4dff9;
            }
            .col-4{
                overflow-y: scroll;
            }
            .post-card {
                background-color: #fcf8ef;
            }
            .post-card .card-header,
            .post-card .card-body {
                background-color: #fcf8ef;
            }
        </style>


<div class="row border shadow" style="background-color: #fcf8ef;">
    <div class="col p-0 border-end" style="background-color: #fcf8ef;">
        <img src="{{ $post->image}}" alt="post id{{ $post->id}}" class="w-100">
    </div>
    <div class="col-4 px-0" style="background-color: #fcf8ef;">
                
        <div class="card border-0 post-card" style="background-color: #fcf8ef;">
            <div class="card-header py-3">
            <div class="row align-items-center">
                <div class="col-auto">
                <a href="{{ route('profile.show', $post->user->id) }}">
                @if ($post->user->avatar)
                <img src="{{ $post->user->avatar }}" alt="{{$post->user->avatar}}" class="rounded-circle avatar-sm">
                    
                @else
                <i class="fa-solid fa-user" style="color: rgb(252, 200, 228); font-size: 20px;"></i>
                    
                @endif
                </a>
            </div>
        <div class="col ps-0">
            <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none fw-bold" style="color: rgb(70, 46, 15); font-size: 20px;">{{$post->user->name}}</a>
        </div>
        <div class="col-auto">
            @if (Auth::user()->id === $post->user->id)
            <div class="dropdown">
                  <button class="btn btn-sm shadow-none" data-bs-toggle=dropdown>
                    <i class="fa-solid fa-face-smile" style="color: rgb(252, 200, 228); font-size: 20px;"></i>
                </button>

                <div class="dropdown-menu" style="background-color: #b4dff9;">
                    <a href="{{ route('post.edit', $post->id) }}" class="dropdown-item" style="color: rgb(70, 46, 15);">
                        <i class="fa-regular fa-pen-to-square" style="color: rgb(70, 46, 15);"></i>Edit
                    </a>
                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-post-{{$post->id}}" style="color: rgb(253, 119, 173);">
                        <i class="fa-regular fa-trash-can" style="color: rgb(253, 119, 173);"></i>Delete
                    </button>
                </div>
                {{-- include modal here --}}   
                @include('users.posts.contents.modals.delete')
            </div>
            @else
                {{-- If not the owner, show unfollow/follow btn --}}
                @if ($post->user->isFollowed())
                <form action="{{ route('follow.destroy', $post->user->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="border-0 bg-transparent p-0" style="color: rgb(199, 170, 132);">Following</button>
                </form>
                    
                @else
                <form action="{{ route('follow.store', $post->user->id) }}" method="post">
                    @csrf
                    <button type="submit" class="border-0 bg-transparent p-0" style="color: rgb(70, 46, 15);">Follow</button>
                </form>
                    
                @endif
            @endif
        </div>
            </div>
            </div>
            
            <div class="card-body w-100">
        {{-- heart button + no. of linkes + categories --}}
        <div class="row align-items-center">
            <div class="col-auto">
                @if ($post->isLiked())
                     <form action="{{ route('like.destroy', $post->id )}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm shadow-none p-0">
                        <i class="fa-solid fa-heart scale-down-center" style="color: rgb(253, 119, 173);"></i>
                    </button>
                </form>
                    
                @else
                <form action="{{ route('like.store', $post->id )}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-sm shadow-none p-0">
                        <i class="fa-regular fa-heart" style="color: rgb(70, 46, 15);"></i>
                    </button>
                </form>
                    
                @endif
            </div>
            <div class="col-auto px-0" style="color: rgb(70, 46, 15);">
                <span>{{ $post->likes->count() }}</span>

            </div>
            <div class="col text-end">
                @foreach ($post->categoryPost as $category_post)
                <div class="badge bg-opacity-50"  style="background-color: rgb(199, 170, 132); color: white;">
                    {{$category_post->category->name}}
                </div>
                @endforeach
            </div>
        </div>

        {{-- owner + description --}}
        <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none fw-bold" style="color: rgb(70, 46, 15);">{{$post->user->name}}</a>
        &nbsp;
        <p class="d-line fw-light" style="color: rgb(99, 75, 46)">{{$post->description}}</p>
        <p class="text-uppercase xsmall" style="color: rgb(199, 170, 132)">{{date('M d, Y', strtotime($post->created_at))}}</p>

        {{-- include comments here --}}
        <div class="mt-4">
            <form action="{{route('comment.store', $post->id)}}" method="post">
        @csrf

        <div class="input-group">
            <textarea name="comment_body{{$post->id}}" cols="30" rows="1" class="form-control form-control-sm" placeholder="Add a comment..." style="background-color: rgb(252, 200, 228);">{{old('coment_body' . $post->id)}}</textarea>
            <button type="submit" class="btn btn-outline-none btn-sm" title="Post" style="background-color: rgb(252, 200, 228);">
                <i class="fa-regular fa-paper-plane" style="background-color: rgb(252, 200, 228);"></i>
            </button>
        </div>
        {{-- Error --}}
        @error('comment_body' . $post->id)
        <div class="text-danger small">{{$message}}</div>  
        @enderror
        </form>

        {{-- show all comments here --}}
        @if ($post->comments->isNotEmpty())
        <ul class="list-group mt-2">
            @foreach ($post->comments as $comment)
                <li class="list-group-item border-0 p-0 mb-2"  style="background-color: #fcf8ef;">
                    <a href="{{ route('profile.show', $comment->user->id) }}" class="text-decoration-none fw-bold" style="color: rgb(70, 46, 15);">{{$comment->user->name}}</a>
                    &nbsp;
                    <p class="d-inline fw-light" style="color: rgb(99, 75, 46)">{{$comment->body}}</p>

                    <form action="{{route('comment.destroy', $comment->id)}}" method="post">
                        @csrf
                        @method('DELETE')

                        <span class="text-uppercase xsmall" style="color: rgb(199, 170, 132)">{{ date('M d, Y', strtotime($comment->created_at))}}</span>

                        {{-- if the AUTH user is the uwner, show delete btn --}}
                        @if (Auth::user()->id === $comment->user->id)
                        &middot;
                        <button type="submit" class="border-0 bg-transparent p-0 xsmall" style="color: rgb(253, 119, 173);">Delete</button>        
                        @endif
                    </form>
                </li>
            @endforeach
        </ul>
            
        @endif
        </div>
     
    </div>
    </div>
    </div>
</div>
@endsection
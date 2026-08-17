@extends('layouts.app')

@section('title', 'Home')

@section('content')
        <div class="row gx-5">
            <div class="col-8">
                @forelse ($home_posts as $post)
                <div class="card mb-4">
                    {{-- title --}}
                    @include('users.posts.contents.title')
                    {{-- body --}}
                    @include('users.posts.contents.body')

                </div>

                @empty
                {{-- if the site doesn't have any post yet,  --}}
                <div class="text-center">
                    <h2>Share Photos</h2>
                    <p class="text-secondary">When you share photos, they'll appear on your profile.</p>
                    <a href="{{route('post.create')}}" class="text-decoration-none">Share your first photo</a>
                </div>       
                @endforelse
            </div>
            
            <div class="col-4">
                {{-- PROFILE OVERVIEW + SUGGESTIONS --}}
                <div class="row align-items-center mb-5 shadow-sm rounded-3 py-3" style=" background-color: #fcf8ef;">
                    <div class="col-auto">
                        <a href="{{ route('profile.show', Auth::user()->id) }}">
                            @if (Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name}}" class="rounded-circle avatar-md">
                                
                            @else
                                <i class="fa-solid fa-circle-user icon-md" style="color: rgb(252, 200, 228);"></i>
                            @endif
                        </a>
                    </div>
                    <div class="col ps-0">
                        <a href="{{ route('profile.show', Auth::user()->id) }}" class="text-decoration-none fw-bold" style="color: rgb(70, 46, 15)">
                            {{ Auth::user()->name }}
                        </a>
                        <p class="mb-0" style="color: rgb(199, 170, 132)">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                {{-- suggestions --}}
                @if ($suggested_users)
                 <div class="row ">
                    <div class="col-auto">
                        <p class="fw-bold" style="color: rgb(70, 46, 15)">Suggestions For You</p>
                    </div>
                    <div class="col text-end">
                        <a href="#" class="fw-bold text-decoration-none" style="color: rgb(70, 46, 15)">See All</a>
                    </div>
                 </div>

                 @foreach ($suggested_users as $user)
                 <div class=" row align-items-center mb-3">
                    <div class="col-auto">
                        <a href="{{ route('profile.show', $user->id) }}">
                            @if ($user->avatar)
                            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="rounded-circle avatar-sm">
                                
                            @else
                            <i class="fa-solid fa-circle-user icon-sm" style="color: rgb(252, 200, 228);"></i>
                            @endif
                        </a>
                    </div>
                    <div class="col ps-0 text-truncate">
                        <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none fw-bold" style="color: rgb(70, 46, 15)">{{ $user->name }}</a>
                    </div>
                    <div class="col-auto">
                        <form action="{{ route('follow.store', $user->id) }}" method="post">
                            @csrf
                            <button type="submit" class="border-0 bg-transparent p-0 btn-sm" style="color: rgb(70, 46, 15)">Follow</button>
                        </form>
                    </div>
                 </div>
                     
                 @endforeach
                    
                @endif
            </div>
        </div>
    
@endsection


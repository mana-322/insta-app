@extends('layouts.app')

@section('title', 'Home')

@section('content')
        <div class="row gx-5">
            <div class="col-8">     
                      
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-body d-flex align-items-center overflow-auto py-3">
        
        <div class="text-center me-4" style="min-width: 70px;">
            <div class="position-relative d-inline-block">
                @if ($myActiveStories->isNotEmpty())
                    <div class="rounded-circle p-[2px] d-inline-block" style="border: 2px solid #e1306c; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#viewMyStoryModal">
                        @if (Auth::user()->avatar)
                           <div class="story-ring p-1">
                               <img src="{{ Auth::user()->avatar }}" class="avatar-md rounded-circle">
                            </div>
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-white rounded-circle" style="width: 50px; height: 50px;">
                                <i class="fa-solid fa-circle-user text-secondary" style="font-size: 48px;"></i>
                            </div>
                        @endif
                    </div>
                @else
                    
                    <a href="#" data-bs-toggle="modal" data-bs-target="#createStoryModal" class="text-decoration-none">
                        @if (Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                        @else
                            <div class="rounded-circle overflow-hidden d-flex align-items-center justify-content-center bg-white" style="width: 50px; height: 50px;">
                                <i class="fa-solid fa-circle-user text-secondary" style="font-size: 50px; line-height: 1;"></i>
                            </div>
                        @endif
                    </a>

                @endif

                {{-- story create button --}}
                <button type="button" class="btn btn-primary btn-sm rounded-circle position-absolute bottom-0 end-0 p-0 d-flex align-items-center justify-content-center" style="width: 20px; height: 20px;" data-bs-toggle="modal" data-bs-target="#createStoryModal" title="Add Story">
                    <i class="fa-solid fa-plus" style="font-size: 10px;"></i>
                </button>
            </div>
            <small class="d-block text-truncate mt-1 text-dark fw-bold" style="max-width: 70px;">Your story</small>
        </div>

        {{-- other users story --}}
       @foreach ($userStories as $userId => $stories)
    @php
        $storyUser = $stories->first()->user;
    @endphp

    <div class="text-center me-3 d-inline-block" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#viewUserStoryModal-{{ $userId }}">
       
        <div class="rounded-circle d-flex align-items-center justify-content-center p-2px " style="border: 2px solid #e1306c; width: 56px; height: 56px;">
            @if ($storyUser->avatar)
                <img src="{{ $storyUser->avatar }}" class="rounded-circle w-100 h-100" style="object-fit: cover;">
            @else
                <i class="fa-solid fa-circle-user text-secondary bg-white rounded-circle d-flex align-items-center justify-content-center w-100 h-100" style="font-size: 50px;"></i>
            @endif
        </div>
        
                <small class="d-block text-truncate mt-1" style="max-width: 60px;">{{ $storyUser->name }}</small>
            </div>
        @endforeach

            </div>
    </div>
                
                {{-- story create modal --}}
                @include('users.stories.modals.create')
                {{-- show my story modal --}}
                @include('users.stories.modals.my-story')
                {{-- show other story modal --}}
                @include('users.stories.modals.user-story')
             
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

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                if (window.location.hash) {
                    const targetModal = document.querySelector(window.location.hash);
                    if (targetModal) {
                        new bootstrap.Modal(targetModal).show();
                    }
                }
            });
        </script>
    
@endsection


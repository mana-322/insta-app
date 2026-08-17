@extends('layouts.app')

@section('title', 'Story Archive')

@section('content')
<div class="container">
    <div class="d-flex align-items-center mb-4">
        <h4 class="fw-bold mb-0"><i class="fa-solid fa-clock-rotate-left me-2"></i>Story Archive</h4>
    </div>

    <div class="row g-3">
        @forelse ($stories as $story)
            <div class="col-6 col-md-3">
                <div class="text-center">

                    <div class="mb-2" style="height: 250px;">
                        @if ($story->media_type === 'video')
                            <video src="{{ $story->media }}" controls class="w-100 h-100 rounded" style="object-fit: cover;"></video>
                        @else
                            <img src="{{ $story->media }}" class="w-100 h-100 rounded" style="object-fit: cover;">
                        @endif
                    </div>

                    <div class="mb-2">
                        <small class="text-muted">{{ $story->created_at->format('Y/m/d H:i') }}</small>
                    </div>

                    <button type="button" 
                            class="btn btn-sm btn-outline-danger py-1 px-3" 
                            data-bs-toggle="modal" 
                            data-bs-target="#deleteStoryModal-{{ $story->id }}">
                        <i class="fa-solid fa-trash-can me-1"></i> Delete
                    </button>

                </div>
            </div>

            @include('users.stories.modals.delete') 
            
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">No archived stories yet.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
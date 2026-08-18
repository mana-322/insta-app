@if (isset($userStories) && $userStories->isNotEmpty())
    @foreach ($userStories as $userId => $stories)
        <div class="modal fade" id="viewUserStoryModal-{{ $userId }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content" style="background-color: #fcf8ef; color: rgb(70, 46, 15);">
                    
                    <div class="modal-header border-0 pb-0 d-flex align-items-center" style="color: rgb(70, 46, 15);">
                        <div class="d-flex align-items-center">
                            @if ($stories->first()->user->avatar)
                                <img src="{{ $stories->first()->user->avatar }}" class="rounded-circle me-2" style="width: 32px; height: 32px; object-fit: cover;">
                            @else
                                <i class="fa-solid fa-circle-user me-2" style="font-size: 32px; color: rgb(252, 200, 228);"></i>
                            @endif
                            <span class="fw-bold small" style="color: rgb(70, 46, 15);">{{ $stories->first()->user->name }}</span>
                        </div>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" style="color: rgb(70, 46, 15);"></button>
                    </div>


                    <div class="modal-body p-2">

                        <div id="storyCarousel-{{ $userId }}" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                            
                            <div class="carousel-indicators position-relative mb-2">
                                @foreach ($stories as $index => $story)
                                    <button type="button" 
                                            data-bs-target="#storyCarousel-{{ $userId }}" 
                                            data-bs-slide-to="{{ $index }}" 
                                            class="{{ $loop->first ? 'active' : '' }}" 
                                            aria-current="{{ $loop->first ? 'true' : 'false' }}">
                                    </button>
                                @endforeach
                            </div>

                            <div class="carousel-inner">
                                @foreach ($stories as $story)
                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                        
                                        <div class="text-center mb-2 position-relative" 
                                             style="cursor: pointer;" 
                                             data-bs-target="#storyCarousel-{{ $userId }}" 
                                             data-bs-slide="next">
                                            @if ($story->media_type === 'video')
                                                <video src="{{ $story->media }}" controls class="w-100 rounded" style="max-height: 350px;"></video>
                                            @else
                                                <img src="{{ $story->media }}" class="w-100 rounded" style="max-height: 350px; object-fit: contain;">
                                            @endif
                                            <small class="text-50 d-block mt-1" style="color: rgb(199, 170, 132);">{{ $story->created_at->diffForHumans() }}</small>
                                        </div>

                                        <div class="d-flex align-items-center px-1 mb-2 position-relative" style="z-index: 10;">
                                            @if ($story->isLiked())
                                                <form action="{{ route('stories.unlike', $story->id) }}" method="POST" class="d-inline" onclick="event.stopPropagation();">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn p-0 text-danger border-0">
                                                        <i class="fa-solid fa-heart fs-5" style="color: rgb(253, 119, 173);"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('stories.like', $story->id) }}" method="POST" class="d-inline" onclick="event.stopPropagation();">
                                                    @csrf
                                                    <button type="submit" class="btn p-0 border-0" style="color: rgb(70, 46, 15);">
                                                        <i class="fa-regular fa-heart fs-5"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <span class="small ms-2" style="color: rgb(70, 46, 15);">{{ $story->likes->count() }} likes</span>
                                        </div>

                                        <div class="px-1 mb-2 overflow-auto position-relative" style="max-height: 80px; z-index: 10;" onclick="event.stopPropagation();">
                                            @forelse ($story->comments as $comment)
                                                <div class="small text-50 mb-1 text-start" style="color: rgb(70, 46, 15);">
                                                    <strong class="me-1" color: rgb(70, 46, 15);>{{ $comment->user->name }}:</strong>
                                                    <span>{{ $comment->body }}</span>
                                                </div>
                                            @empty
                                                <small class="text-50 d-block text-start" style="font-size: 0.75rem;" style="color: rgb(70, 46, 15);">No comments yet.</small>
                                            @endforelse
                                        </div>

                                        <form action="{{ route('stories.comments.store', $story->id) }}" method="POST" class="d-flex position-relative" style="z-index: 10;" onclick="event.stopPropagation();">
                                            @csrf
                                            <input type="text" name="body" class="form-control form-control-sm border-none me-2" placeholder="Reply..." required style="background-color: rgb(252, 200, 228);">
                                            <button type="submit" class="btn btn-sm btn-outline-none" style="background-color: rgb(252, 200, 228); color: rgb(70, 46, 15);">Send</button>
                                        </form>

                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
@endif
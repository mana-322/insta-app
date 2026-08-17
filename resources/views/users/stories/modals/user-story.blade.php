@if (isset($userStories) && $userStories->isNotEmpty())
    @foreach ($userStories as $userId => $stories)
        <div class="modal fade" id="viewUserStoryModal-{{ $userId }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content bg-dark text-white">
                    
                    <div class="modal-header border-0 pb-0 d-flex align-items-center">
                        <div class="d-flex align-items-center">
                            @if ($stories->first()->user->avatar)
                                <img src="{{ $stories->first()->user->avatar }}" class="rounded-circle me-2" style="width: 32px; height: 32px; object-fit: cover;">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary me-2" style="font-size: 32px;"></i>
                            @endif
                            <span class="fw-bold small">{{ $stories->first()->user->name }}</span>
                        </div>
                        <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="modal"></button>
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
                                            <small class="text-white-50 d-block mt-1">{{ $story->created_at->diffForHumans() }}</small>
                                        </div>

                                        <div class="d-flex align-items-center px-1 mb-2 position-relative" style="z-index: 10;">
                                            @if ($story->isLiked())
                                                <form action="{{ route('stories.unlike', $story->id) }}" method="POST" class="d-inline" onclick="event.stopPropagation();">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn p-0 text-danger border-0">
                                                        <i class="fa-solid fa-heart fs-5"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('stories.like', $story->id) }}" method="POST" class="d-inline" onclick="event.stopPropagation();">
                                                    @csrf
                                                    <button type="submit" class="btn p-0 text-white border-0">
                                                        <i class="fa-regular fa-heart fs-5"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <span class="small ms-2 text-white">{{ $story->likes->count() }} likes</span>
                                        </div>

                                        <div class="px-1 mb-2 overflow-auto position-relative" style="max-height: 80px; z-index: 10;" onclick="event.stopPropagation();">
                                            @forelse ($story->comments as $comment)
                                                <div class="small text-white-50 mb-1 text-start">
                                                    <strong class="text-white me-1">{{ $comment->user->name }}:</strong>
                                                    <span>{{ $comment->body }}</span>
                                                </div>
                                            @empty
                                                <small class="text-white-50 d-block text-start" style="font-size: 0.75rem;">No comments yet.</small>
                                            @endforelse
                                        </div>

                                        <form action="{{ route('stories.comments.store', $story->id) }}" method="POST" class="d-flex position-relative" style="z-index: 10;" onclick="event.stopPropagation();">
                                            @csrf
                                            <input type="text" name="body" class="form-control form-control-sm bg-dark text-white border-secondary me-2" placeholder="Reply..." required>
                                            <button type="submit" class="btn btn-sm btn-outline-light">Send</button>
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
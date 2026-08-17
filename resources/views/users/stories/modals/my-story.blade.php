@if ($myActiveStories?->isNotEmpty())
    <div class="modal fade" id="viewMyStoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content bg-dark text-white">
                

                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title fw-bold">Your Story</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-2">

                    <div id="myStoryCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                        
                        <div class="carousel-indicators position-relative mb-2">
                            @foreach ($myActiveStories as $index => $story)
                                <button type="button" 
                                        data-bs-target="#myStoryCarousel" 
                                        data-bs-slide-to="{{ $index }}" 
                                        class="{{ $loop->first ? 'active' : '' }}">
                                </button>
                            @endforeach
                        </div>

                        <div class="carousel-inner">
                            @foreach ($myActiveStories as $story)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    
                                    <div class="text-center mb-2">
                                        @if ($story->media_type === 'video')
                                            <video src="{{ $story->media }}" controls class="w-100 rounded" style="max-height: 350px;"></video>
                                        @else
                                            <img src="{{ $story->media }}" class="w-100 rounded" style="max-height: 350px; object-fit: contain;">
                                        @endif
                                        <small class="text-white-50 d-block mt-1">{{ $story->created_at->diffForHumans() }}</small>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between px-1 mb-2">
                                        <div>
                                            <i class="fa-solid fa-heart text-danger fs-5 me-1"></i>
                                            <span class="small text-white">{{ $story->likes->count() }} likes</span>
                                        </div>

                                        <form action="{{ route('story.destroy', $story->id) }}" method="POST" onsubmit="return confirm('ストーリーを削除しますか？');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger py-0 px-2">
                                                <i class="fa-solid fa-trash-can"></i> Delete
                                            </button>
                                        </form>
                                    </div>

                                    <div class="px-1 overflow-auto" style="max-height: 100px;">
                                        @forelse ($story->comments as $comment)
                                            <div class="small text-white-50 mb-1 text-start">
                                                <strong class="text-white me-1">{{ $comment->user->name }}:</strong>
                                                <span>{{ $comment->body }}</span>
                                            </div>
                                        @empty
                                            <small class="text-white-50 d-block text-start" style="font-size: 0.75rem;">No comments yet.</small>
                                        @endforelse
                                    </div>

                                </div>
                            @endforeach
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#myStoryCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#myStoryCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </button>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endif
<div class="modal fade" id="deleteStoryModal-{{ $story->id }}">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-danger text-dark">
            
            <div class="modal-header border-danger">
                <h5 class="modal-title text-danger fs-6">
                    <i class="fa-solid fa-circle-exclamation me-1"></i>Delete Story
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center">
                <p class="small mb-2">Are you sure you want to delete this story?</p>
                
                <div class="mt-2">
                    @if ($story->media_type === 'video')
                        <video src="{{ $story->media }}" class="w-100 rounded" style="max-height: 150px; object-fit: cover;"></video>
                    @else
                        <img src="{{ $story->media }}" alt="story id {{ $story->id }}" class="w-100 rounded" style="max-height: 150px; object-fit: cover;">
                    @endif
                    <small class="d-block mt-1 text-white-50" style="font-size: 0.75rem;">
                        {{ $story->created_at->format('Y/m/d H:i') }}
                    </small>
                </div>
            </div>

            <div class="modal-footer border-0 justify-content-center pt-0">
                <form action="{{ route('story.destroy', $story->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-outline-danger btn-sm me-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>

        </div>
    </div>
</div>
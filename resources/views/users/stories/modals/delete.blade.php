<div class="modal fade" id="deleteStoryModal-{{ $story->id }}">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content text-dark">
            
            <div class="modal-header border-none" style="background-color: #fcf8ef;">
                <h5 class="modal-title fs-6" style="color: rgb(253, 119, 173);">
                    <i class="fa-solid fa-circle-exclamation me-1" style="color: rgb(253, 119, 173);"></i>Delete Story
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center" style="background-color: #fcf8ef;">
                <p class="small mb-2" style="color: rgb(70, 46, 15);">Are you sure you want to delete this story?</p>
                
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

            <div class="modal-footer border-0 justify-content-center pt-0" style="background-color: #fcf8ef;">
                <form action="{{ route('story.destroy', $story->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-outline btn-sm me-2" data-bs-dismiss="modal" style="color: rgb(253, 119, 173);">Cancel</button>
                    <button type="submit" class="btn btn-sm" style="color: rgb(253, 119, 173); background-color:  #cde8f8;">Delete</button>
                </form>
            </div>

        </div>
    </div>
</div>
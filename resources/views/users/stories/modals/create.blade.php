<div class="modal fade" id="createStoryModal" tabindex="-1" aria-labelledby="createStoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('stories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header"  style="background-color: #fcf8ef;">
                    <h5 class="modal-title fw-bold" style="color: rgb(70, 46, 15);">Add to Story</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"  style="background-color: #fcf8ef;">
                    <div class="mb-3">
                        <label for="media" class="form-label fw-bold" style="color: rgb(70, 46, 15);">Photo or Video (Max: 20MB)</label>
                        <input type="file" name="media" id="media" class="form-control" accept="image/*,video/*" required style="background-color: rgb(252, 200, 228);">
                        <div class="form-text" style="color: rgb(199, 170, 132);">Will be automatically archived after 24 hours.</div>
                    </div>
                </div>
                <div class="modal-footer"  style="background-color: #fcf8ef;">
                    <button type="button" class="btn btn-outline-none btn-sm" data-bs-dismiss="modal" style="background-color: rgb(252, 200, 228); color: rgb(70, 46, 15);">Cancel</button>
                    <button type="submit" class="btn btn-sm" style="background-color: rgb(252, 200, 228); color: rgb(70, 46, 15);">Share Story</button>
                </div>
            </form>
        </div>
    </div>
</div>
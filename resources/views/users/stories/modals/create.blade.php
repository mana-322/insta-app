<div class="modal fade" id="createStoryModal" tabindex="-1" aria-labelledby="createStoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('stories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Add to Story</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="media" class="form-label fw-bold">Photo or Video (Max: 20MB)</label>
                        <input type="file" name="media" id="media" class="form-control" accept="image/*,video/*" required>
                        <div class="form-text">Will be automatically archived after 24 hours.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">Share Story</button>
                </div>
            </form>
        </div>
    </div>
</div>
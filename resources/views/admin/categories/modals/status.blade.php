
<div class="modal fade" id="edit-category-{{ $category->id }}" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="post">
            @csrf
            @method('PATCH')
            <div class="modal-content border border-warning">
                <div class="modal-header border-warning">
                    <h5 class="modal-title text-dark">
                        <i class="fa-solid fa-pen-to-square"></i> Edit Category
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-warning btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning btn-sm">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="delete-category-{{ $category->id }}" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post">
            @csrf
            @method('DELETE')
            <div class="modal-content border border-danger">
                <div class="modal-header border-danger">
                    <h5 class="modal-title text-danger">
                        <i class="fa-solid fa-trash-can"></i> Delete Category
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong class="text-dark">{{ $category->name }}</strong> category?</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>
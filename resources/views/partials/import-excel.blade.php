<!-- resources/views/partials/add.blade.php -->
<div class="modal fade" id="importProductModalLabel" tabindex="-1" aria-labelledby="importProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="importProductModalLabel">import products</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Add Product Form -->
          <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data"> {{-- Replace with your actual route --}}
            @csrf
  
            <div class="mb-3">
              <label for="file" class="form-label">fichier excel</label>
              <input type="file" class="form-control" id="file" name="file" required>
              @error('file')
              <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary">import</button>
          </form>
        </div>
      </div>
    </div>
  </div>
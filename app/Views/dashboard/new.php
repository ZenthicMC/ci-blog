<?= $this->extend('dashboard/layout/templates.php') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row mb-3 d-lg-flex">
        <div class="col-lg-12">
            <h3 class="mb-4 t-black">Create Article</h3>
        </div>
    </div>
     <div class="row mb-3">
        <div class="col-lg-7">
           <div class="card shadow mb-4 border-left-primary">
              <div class="card-body p-4">
                 <form method="post" action="/dash/articles/new/save" enctype="multipart/form-data">
                 <?= csrf_field() ?>
                     <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control <?= ($validation->hasError('title')) ? 'is-invalid': '';  ?>" id="title" name="title" value="<?= old('title') ?>" autocomplete="off" required>
                        <div class="invalid-feedback">
                           <?= $validation->getError('title') ?>
                        </div>
                        <div class="form-text">Minimum: 10 Characters</div>
                     </div>
                     <div class="mb-3">
                           <label for="category" class="form-label">Category</label>
                           <select class="form-select" name="category" value="<?= old('category') ?>">
                              <?php foreach($categories as $category): ?>
                                 <?php if(old('category') == $category['name']) : ?>
                                    <option value="<?= $category['name'] ?>" selected><?= ucfirst($category['name']); ?></option>
                                 <?php else: ?>
                                    <option value="<?= $category['name'] ?>"><?= ucfirst($category['name']); ?></option>
                                 <?php endif; ?>
                              <?php endforeach; ?>
                           </select>
                     </div>
                     <div class="mb-4">
                        <label for="category" class="form-label">Cover Image</label>
                        <div class="input-group">
                           <input class="form-control <?= ($validation->hasError('cover')) ? 'is-invalid': '';  ?>" type="file" id="cover" name="cover" value="<?= old('cover') ?>" aria-describedby="coverHelp" required>
                           <div class="invalid-feedback">
                              <?= $validation->getError('cover') ?>
                           </div>
                        </div>
                        <div class="form-text mb-3">Recommended size: 400x600px | <bold class="text-danger">Accepted Image: .jpg .png</bold></div>
                     </div>
                     <div class="mb-3">
                        <input type="hidden" name="body" value="<?= old('body') ?>">
                        <div id="editor" style="min-height: 100px;"></div>
                        <div class="form-text">Minimum: 100 Characters | <bold class="text-danger">Accepted Image: .png</bold></div>
                        <p class="text-danger"><?= $validation->getError('body') ?></p>
                     </div>
                     <button type="submit" class="btn btn-primary">Create</button>
                  </form>
              </div>
           </div>
        </div>
     </div>
</div>
<script>
   var quill = new Quill('#editor', {
      theme: 'snow',
      modules: {
         toolbar: [
               [{ header: [1, 2, 3, 4, 5, 6, false] }],
               [{ font: [] }],
               ["bold", "italic"],
               ["link", "blockquote", "code-block", "image"],
               [{ list: "ordered" }, { list: "bullet" }],
               [{ script: "sub" }, { script: "super" }],
               [{ color: [] }, { background: [] }],
         ]
   },
   });
   quill.on('text-change', function(delta, oldDelta, source) {
      document.querySelector("input[name='body']").value = quill.root.innerHTML;
   });
</script>
<?= $this->endSection() ?>
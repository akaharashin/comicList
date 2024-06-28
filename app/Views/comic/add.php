<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <h3 class="my-3">Add Comic</h3>
    <?php if ($validation->getErrors()): ?>
        <div class="alert alert-danger">
            <?= $validation->listErrors(); ?>
        </div>
    <?php endif; ?>
    <div class="card shadow">
        <div class="card-body">
            <form action="/comic/create" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="mb-3 row">
                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" required class="form-control <?= ($validation->hasError('title')) ? 'is-invalid' : ''; ?>" id="title" name="title" autofocus value="<?= old('title'); ?>" placeholder="Enter title">
                        <div class="invalid-feedback">
                            <?= $validation->getError('title'); ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="author" class="col-sm-2 col-form-label">Author</label>
                    <div class="col-sm-10">
                        <input type="text" required class="form-control <?= ($validation->hasError('author')) ? 'is-invalid' : ''; ?>" id="author" name="author" value="<?= old('author'); ?>" placeholder="Enter author">
                        <div class="invalid-feedback">
                            <?= $validation->getError('author'); ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="mangaLabel" class="col-sm-2 col-form-label">Label</label>
                    <div class="col-sm-10">
                        <input type="text" required class="form-control <?= ($validation->hasError('mangaLabel')) ? 'is-invalid' : ''; ?>" id="mangaLabel" name="mangaLabel" value="<?= old('mangaLabel'); ?>" placeholder="Enter label">
                        <div class="invalid-feedback">
                            <?= $validation->getError('mangaLabel'); ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="genre" class="col-sm-2 col-form-label">Genre</label>
                    <div class="col-sm-10">
                        <input type="text" required class="form-control <?= ($validation->hasError('genre')) ? 'is-invalid' : ''; ?>" id="genre" name="genre" value="<?= old('genre'); ?>" placeholder="Enter genre">
                        <div class="invalid-feedback">
                            <?= $validation->getError('genre'); ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="cover" class="col-sm-2 col-form-label">Cover</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control <?= ($validation->hasError('cover')) ? 'is-invalid' : ''; ?>" id="cover" name="cover" placeholder="Upload cover image">
                        <div class="invalid-feedback">
                            <?= $validation->getError('cover'); ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-plus"></i> Add Comic</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

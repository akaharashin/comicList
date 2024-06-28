<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <h3 class="my-3">Edit Comic</h3>
    <?php if ($validation->getErrors()): ?>
        <div class="alert alert-danger">
            <?= $validation->listErrors(); ?>
        </div>
    <?php endif; ?>
    <div class="card shadow">
        <div class="card-body">
            <form action="/comic/update/<?= $comic['id']; ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="slug" value="<?= $comic['slug']; ?>">
                <div class="mb-3 row">
                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('title')) ? 'is-invalid' : ''; ?>" id="title" name="title" autofocus value="<?= $comic['title']; ?>" placeholder="Enter title">
                        <div class="invalid-feedback">
                            <?= $validation->getError('title'); ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="author" class="col-sm-2 col-form-label">Author</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="author" name="author" value="<?= $comic['author']; ?>" placeholder="Enter author">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="mangaLabel" class="col-sm-2 col-form-label">Label</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="mangaLabel" name="mangaLabel" value="<?= $comic['mangaLabel']; ?>" placeholder="Enter label">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="genre" class="col-sm-2 col-form-label">Genre</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="genre" name="genre" value="<?= $comic['genre']; ?>" placeholder="Enter genre">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="cover" class="col-sm-2 col-form-label">Cover</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="cover" name="cover" placeholder="Upload cover image">
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-pencil"></i> Update Comic</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

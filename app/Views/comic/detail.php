<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container mt-5 mb-5">
    <a href="/comic/add" class="btn btn-info mb-3"><i class="bi bi-plus"></i> Add New Comic</a>
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Comic Detail</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <img src="/img/<?= $comic['cover']; ?>" class="img-fluid rounded-start" alt="Cover Image" onerror="this.onerror=null; this.src='/img/default.jpg';">
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $comic['title']; ?></h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><strong>Genre:</strong> <?= $comic['genre']; ?></li>
                                <li class="mb-2"><strong>Author:</strong> <?= $comic['author']; ?></li>
                                <li class="mb-2"><strong>Publisher:</strong> <?= $comic['mangaLabel']; ?></li>
                            </ul>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <a href="/comic/edit/<?= $comic['slug']; ?>" class="btn btn-info"><i class="bi bi-pencil-square"></i> Edit</a>
                                    <form action="/comic/delete/<?= $comic['slug']; ?>" method="post" class="d-inline">
                                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger"><i class="bi bi-trash"></i> Delete</button>
                                    </form>
                                </div>
                                <p class="text-muted mb-0"><small>Last updated 3 mins ago</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

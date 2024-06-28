<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
       <!-- Search Form -->
       <form action="/comic/search" method="GET" class="mb-3">
        <div class="input-group mt-5">
            <input type="text" class="form-control" placeholder="Search title..." name="keyword" value="<?= $keyword; ?>">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
    </form>
    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('message') ?>
        </div>
    <?php endif ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Comic List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Cover</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($comics as $key => $comic) : ?>
                            <tr class="align-middle">
                                <td><?= $key + 1 ?></td>
                                <td><?= $comic['title']; ?></td>
                                <td>
                                    <img src="/img/<?= $comic['cover']; ?>" style="max-width: 100px;" onerror="this.onerror=null; this.src='/uploads/default.jpg';" class="img-thumbnail">
                                </td>
                                <td>
                                    <a href="/comic/detail/<?= $comic['slug']; ?>" class="btn btn-primary btn-sm">Detail</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<style>
    body {
        font-family: 'Nunito', sans-serif;
        background-color: #f8f9fc;
    }

    .container {
        margin-top: 50px;
    }

    .card {
        border: none;
        border-radius: 1rem;
    }

    .card-header {
        background-color: #4e73df;
        color: white;
        border-bottom: 1px solid #e3e6f0;
        border-radius: 1rem 1rem 0 0;
    }

    .card-body {
        background-color: #ffffff;
    }

    .table thead {
        background-color: #4e73df;
        color: white;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fc;
    }

    .btn-primary {
        background-color: #4e73df;
        border-color: #4e73df;
    }

    .btn-primary:hover {
        background-color: #2e59d9;
        border-color: #2653d4;
    }

    .img-thumbnail {
        border: 0;
    }
</style>

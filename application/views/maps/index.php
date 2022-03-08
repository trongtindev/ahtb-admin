<form method="get">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>

        <div class="col-md-3">
            <a class="btn btn-primary form-control" href="/maps/create">Add new</a>
        </div>

    </div>
</form>

<div class="row mt-3">
    <?php foreach ($items as $item) { ?>
        <div class="col-md-4 mb-3">
            <div class="card text-center">
                <div class="card-header text-muted">
                    <?= $item->_id ?>
                </div>

                <div class="card-body">
                    <h5 class="card-title"><?= isset($item['name']) ? $item['name'] : 'No name' ?></h5>
                </div>

                <div class="card-footer text-muted">
                    <a href="/maps/edit/<?= $item->_id ?>/?backUrl=<?= currentUrl() ?>" class="btn btn-primary">Edit</a>
                    <a href="/maps/delete/<?= $item->_id ?>/?backUrl=<?= currentUrl() ?>" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
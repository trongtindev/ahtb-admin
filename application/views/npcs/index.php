<style>
    .img-sprite {
        width: 200px;
        height: 70px;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        border: 1px solid #f3f3f3;
    }
</style>

<div class="pull-left">
    <form method="post">
        <input type="text" name="keyword" class="form-control" placeholder="Search id, name, etc...">
    </form>
</div>
<div class="pull-right">
    <a class="btn btn-primary" href="/npcs/create">Add new</a>
</div>
<div class="clearfix"></div>

<div class="row mt-3">
    <?php foreach ($items as $item) { ?>
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-header">
                    <span class="badge bg-success"><?= $item['tag'] ?></span>
                    <?= $item->name != 'No name' ? '' : '<span class="badge bg-warning">Noname</span>' ?>
                    <?= $item->enabled ? '' : '<span class="badge bg-warning">Disabled</span>' ?>
                </div>

                <div class="card-body">
                    <h5 class="card-title"><?= $item['name'] ?></h5>
                    <div class="card-text">
                        <div class="row mb-3 mt-3">
                            <div class="img-sprite center" style="background-image: url('/resources/npcs/<?= $item->_id ?>/sprite.png')"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

                <div class="card-footer text-muted">
                    <a href="/npcs/edit/<?= $item->_id ?>" class="btn btn-primary">Edit</a>
                    <a href="/npcs/delete/<?= $item->_id ?>" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
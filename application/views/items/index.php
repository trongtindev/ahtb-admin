<style>
    .img-icon {
        width: 100px;
        height: 100px;
        background-size: cover;
        border: 1px solid #f3f3f3;
        background-position: center;
    }

    .img-sprite {
        width: 100px;
        height: 100px;
        background-size: contain;
        border: 1px solid #f3f3f3;
        background-repeat: no-repeat;
        background-position: center;
    }
</style>
<form method="get">
    <div class="row">
        <div class="col-md-3">
            <select name="enabled" class="form-control" onchange="this.form.submit()">
                <option value="" <?= $this->input->get('enabled', true) == '' ? 'selected' : '' ?>>All</option>
                <option value="1" <?= $this->input->get('enabled', true) == '1' ? 'selected' : '' ?>>Enabled</option>
                <option value="0" <?= $this->input->get('enabled', true) == '0' ? 'selected' : '' ?>>Disabled</option>
            </select>
        </div>

        <div class="col-md-3">
            <select name="tag" class="form-control" onchange="this.form.submit()" required>
                <option value="" <?= $this->input->get('tag', true) == '' ? 'selected' : '' ?>>All</option>
                <?php foreach (getItemTags() as $row) { ?>
                    <option value="<?= $row ?>" <?= $row == $this->input->get('tag', true) ? 'selected' : '' ?>><?= $row ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="col-md-3">
            <select name="type" class="form-control" onchange="this.form.submit()">
                <option value="" <?= $this->input->get('type', true) == '' ? 'selected' : '' ?>>All</option>
                <?php foreach (getItemTypes()[$tag] as $row) { ?>
                    <option value="<?= $row ?>" <?= $row == $this->input->get('type', true) ? 'selected' : '' ?>><?= $row ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="col-md-3">
            <a class="btn btn-primary form-control" href="/items/create">Add new</a>
        </div>

    </div>
</form>

<div class="row mt-3">
    <?php foreach ($items as $item) { ?>
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-header">
                    <span class="badge bg-success"><?= $item['tag'] ?></span>
                    <span class="badge bg-secondary"><?= $item['type'] ?></span>
                    <!-- <?= isset($item->tier) ? '<span class="badge bg-info">' . $item->tier . '</span>' : '' ?> -->
                    <?= isset($item->level) ? '<span class="badge bg-danger">L:' . $item->level . '</span>' : '' ?>
                    <?= isset($item->category) ? '<span class="badge bg-secondary">' . $item->category . '</span>' : '' ?>
                    <?= $item->name != 'No name' ? '' : '<span class="badge bg-warning">Noname</span>' ?>
                    <?= $item->enabled ? '' : '<span class="badge bg-warning">Disabled</span>' ?>
                </div>

                <div class="card-body">
                    <h5 class="card-title"><?= $item['name'] ?></h5>
                    <div class="card-text">
                        <div class="row mb-3 mt-3">
                            <div class="col-md-6">
                                <div class="img-icon center" style="background-image: url('/resources/items/<?= $item->_id ?>/icon.png?updatedAt=<?= $item->updatedAt ?>')"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="img-sprite center" style="background-image: url('/resources/items/<?= $item->_id ?>/sprite.png?updatedAt=<?= $item->updatedAt ?>')"></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

                <div class="card-footer text-muted">
                    <a href="/items/edit/<?= $item->_id ?>/?tag=<?= $item->tag ?>&backUrl=<?= currentUrl() ?>" class="btn btn-primary">Edit</a>
                    <a href="/items/delete/<?= $item->_id ?>/?backUrl=<?= currentUrl() ?>" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
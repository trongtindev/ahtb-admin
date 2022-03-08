<div class="pull-right">
    <a class="btn btn-primary" href="/npcs">Back to list</a>
</div>
<div class="clearfix"></div>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="list-group-item active">Edit a NPC</div>

        <form method="POST" enctype="multipart/form-data">
            <div class="list-group-item">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">Tag</label>
                    </div>

                    <div class="col-md-8">
                        <select name="tag" class="form-control" required>
                            <option value="" <?= $item->tag == '' ? 'selected' : '' ?>>No</option>
                            <option value="Crafter" <?= $item->tag == 'Crafter' ? 'selected' : '' ?>>Crafter</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">Name</label>
                    </div>

                    <div class="col-md-8">
                        <input type="text" name="name" class="form-control" value="<?= $item->name ?>">
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">Type</label>
                    </div>

                    <div class="col-md-8">
                        <select name="type" class="form-select">
                            <option value="">No</option>
                            <?php foreach (getItemTags() as $row) { ?>
                                <option value="<?= $row ?>" <?= $item->type == $row ? 'selected':'' ?>><?= $row ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">File sprite</label>
                    </div>
                    <div class="col-md-8">
                        <input type="file" name="file-sprite" class="form-control">
                        <input type="file" name="file-sprite-meta" class="form-control mt-3">
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">Enabled</label>
                    </div>
                    <div class="col-md-8">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="yes" id="enabled" name="enabled" <?= $item->enabled ? 'checked' : '' ?>>
                            <label class="form-check-label" for="enabled">
                                Turn on this NPC
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <button type="submit" name="submit" class="btn form-control btn-primary">Save changes</button>
            </div>
        </form>
    </div>
    <div class="col-md-2"></div>
</div>
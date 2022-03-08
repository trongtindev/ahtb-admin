<div class="pull-right">
    <a class="btn btn-primary" href="/npcs">Back to list</a>
</div>
<div class="clearfix"></div>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="list-group-item active">Create a NPC</div>

        <form method="POST" enctype="multipart/form-data">
            <div class="list-group-item">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">Tag</label>
                    </div>

                    <div class="col-md-8">
                        <select name="tag" class="form-control" required>
                            <option value="" <?= input('tag') == '' ? 'selected' : '' ?>>No</option>
                            <option value="Salesman" <?= input('tag') == 'Salesman' ? 'selected' : '' ?>>Salesman</option>
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
                        <input type="text" name="name" class="form-control" value="<?= input('name') ?>">
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">Types</label>
                    </div>

                    <div class="col-md-8">
                        <select name="type" class="form-select">
                            <option value="">No</option>
                            <?php foreach (getItemTags() as $row) { ?>
                                <option value="<?= $row ?>"><?= $row ?></option>
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
                        <input type="file" name="file-sprite" class="form-control" required>
                        <input type="file" name="file-sprite-meta" class="form-control mt-3" required>
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
                            <input class="form-check-input" type="checkbox" value="yes" id="enabled" name="enabled" <?= input('enabled') == 'yes' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="enabled">
                                Turn on this NPC
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <button type="submit" name="submit" class="btn form-control btn-primary">Add</button>
            </div>
        </form>
    </div>
    <div class="col-md-2"></div>
</div>
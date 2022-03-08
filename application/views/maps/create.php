<div class="pull-right">
    <a class="btn btn-primary" href="/items">Back to list</a>
</div>
<div class="clearfix"></div>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="list-group-item active">items.create</div>

        <form method="POST" enctype="multipart/form-data">
            <div class="list-group-item">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">Tag</label>
                    </div>

                    <div class="col-md-8">
                        <select name="tag" class="form-control" onchange="onTagChange(this)" required>
                            <?php foreach (getItemTags() as $row) { ?>
                                <option value="<?= $row ?>" <?= $row == $this->input->get('tag', true) ? 'selected' : '' ?>><?= $row ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">Type</label>
                    </div>

                    <div class="col-md-8">
                        <select name="type" class="form-control">
                            <?php foreach (getItemTypes()[$tag] as $row) { ?>
                                <option value="<?= $row ?>" <?= input('type') == $row ? 'selected':'' ?>><?= $row ?></option>
                            <?php } ?>
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
                        <label class="form-label">File icon</label>
                    </div>
                    <div class="col-md-8">
                        <input type="file" name="file-icon" class="form-control" required>
                        <input type="file" name="file-icon-meta" class="form-control mt-3" required>
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

            <?php if (count(getItemSpecsField()[$tag]) > 0) { ?>
                <div class="list-group-item">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Specs</label>
                        </div>

                        <div class="col-md-8">
                            <?php foreach (getItemSpecsField()[$tag] as $row) { ?>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label"><?= $row['name'] ?></label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="specs[<?= $row['name'] ?>]" class="form-control">
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <div class="list-group-item">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">Enabled</label>
                    </div>
                    <div class="col-md-8">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="yes" id="enabled" name="enabled" <?= input('enabled') == 'yes' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="enabled">
                                Turn on item
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

<script>
    var url = new URL("<?= current_url() . '/?' . $_SERVER['QUERY_STRING'] ?>");
    function onTagChange(e) {
        url.searchParams.set('tag', e.value);
        window.location = url;
    }
</script>
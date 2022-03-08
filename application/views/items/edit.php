<div class="pull-right">
    <a class="btn btn-primary" href="<?= base64_decode($_GET['backUrl']) ?>">Back to list</a>
</div>
<div class="clearfix"></div>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="list-group-item active">Edit "<?= $item->name ?>"</div>
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
                                <option value="<?= $row ?>" <?= $item->type == $row ? 'selected' : '' ?>><?= $row ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">Tier</label>
                    </div>

                    <div class="col-md-8">
                        <input type="text" name="tier" class="form-control" value="<?= isset($item->tier) ? $item->tier : '0' ?>">
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
                        <label class="form-label">SetID</label>
                    </div>

                    <div class="col-md-8">
                        <input type="text" name="setId" class="form-control" value="<?= isset($item->setId) ? $item->setId : '' ?>">
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">Weight</label>
                    </div>

                    <div class="col-md-8">
                        <input type="text" name="weight" class="form-control" value="<?= isset($item->weight) ? $item->weight : '0' ?>">
                    </div>
                </div>
            </div>

            <?php if ($tag == 'armor') { ?>
                <div class="list-group-item">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Category</label>
                        </div>

                        <div class="col-md-8">
                            <select name="category" class="form-control">
                                <?php foreach (getItemCategories()[$tag] as $row) { ?>
                                    <option value="<?= $row ?>" <?= isset($item->category) && $item->category == $row ? 'selected' : '' ?>><?= $row ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <div class="list-group-item">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">File icon</label>
                    </div>
                    <div class="col-md-8">
                        <input type="file" name="file-icon" class="form-control">
                        <input type="file" name="file-icon-meta" class="form-control mt-3">
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
                                        <input type="number" step="0.01" name="specs[<?= $row['name'] ?>]" value="<?= isset($item['specs'][$row['name']]) && $item['specs'][$row['name']] != '' ? $item['specs'][$row['name']] : '0' ?>" class="form-control">
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if ($tag != 'resource') { ?>
                <div class="list-group-item">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Crafting</label>
                        </div>

                        <div class="col-md-8">
                            <div id="resources">
                                <?php if (isset($item->crafting) && isset($item->crafting->ids)) { ?>
                                    <?php $i = 0; ?>
                                    <?php foreach ($item->crafting->ids as $row) { ?>
                                        <?php $id = uuid() ?>
                                        <div class="mb-2" id="<?= $id ?>">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <select name="crafting[ids][]" class="form-control">
                                                        <?php foreach ($resources as $resource) { ?>
                                                            <option value="<?= $resource->_id ?>" <?= $row == $resource->_id ? 'selected' : '' ?>><?= $resource->name ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="text" name="crafting[tier][]" value="<?= $item->crafting->tier[$i] ?>" class="form-control" placeholder="Tier">
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="text" name="crafting[value][]" value="<?= $item->crafting->value[$i] ?>" class="form-control" placeholder="Number">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-danger form-control" onClick="onRemoveResource('<?= $id ?>')">X</button>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $i++; ?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                            <button type="button" class="btn btn-light form-control" onClick="onAddResource()">Add resource</button>
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
                            <input class="form-check-input" type="checkbox" value="yes" id="enabled" name="enabled" <?= $item->enabled == true ? 'checked' : '' ?>>
                            <label class="form-check-label" for="enabled">
                                Turn on item
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

<script>
    var added = 0;
    var resources = <?= json_encode($resources) ?>;

    function onAddResource() {
        added++;
        var opts = '';
        for (var i = 0; i < resources.length; i++) {
            opts += '<option value="' + resources[i]._id + '">' + resources[i].name + '</option>';
        }
        $('#resources').append('<div class="mb-2" id="' + added + '"><div class="row"><div class="col-md-6"><select name="crafting[ids][]" class="form-control">' + opts + '</select></div><div class="col-md-2"><input type="text" name="crafting[tier][]" class="form-control" placeholder="Tier"></div><div class="col-md-2"><input type="text" name="crafting[value][]" class="form-control" placeholder="Number"></div> <div class="col-md-2"> <button type="button" class="btn btn-danger form-control" onClick="onRemoveResource(' + added + ')">X</button> </div></div></div>');
        setTimeout(() => {
            $('.ui.dropdown').dropdown();
        }, 250);
    }

    function onRemoveResource(id) {
        $('#' + id).remove();
    }
</script>
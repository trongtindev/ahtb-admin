<div class="pull-right">
    <a class="btn btn-primary" href="<?= base64_decode($_GET['backUrl']) ?>">Back to list</a>
</div>
<div class="clearfix"></div>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="list-group-item active">Edit "<?= $item->_id ?>"</div>
        <form method="POST">
            <div class="list-group-item">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">Name</label>
                    </div>

                    <div class="col-md-8">
                        <input type="text" name="name" class="form-control" value="<?= isset($item->name) ? $item->name : '' ?>">
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">NPCs</label>
                    </div>

                    <div class="col-md-8">
                        <div id="resources">
                            <?php $i = 0; ?>
                            <?php foreach ($item->points as $row) { ?>
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
                        </div>
                        <button type="button" class="btn btn-light form-control" onClick="onAddPoint()">Add point</button>
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">Trees</label>
                    </div>

                    <div class="col-md-8">
                        <div id="resources">
                            <?php $i = 0; ?>
                            <?php foreach ($item->points as $row) { ?>
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
                        </div>
                        <button type="button" class="btn btn-light form-control" onClick="onAddPoint()">Add point</button>
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">Points</label>
                    </div>

                    <div class="col-md-8">
                        <div id="resources">
                            <?php $i = 0; ?>
                            <?php foreach ($item->points as $row) { ?>
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
                        </div>
                        <button type="button" class="btn btn-light form-control" onClick="onAddPoint()">Add point</button>
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">Monsters</label>
                    </div>

                    <div class="col-md-8">
                        <div id="resources">
                            <?php $i = 0; ?>
                            <?php foreach ($item->points as $row) { ?>
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
                        </div>
                        <button type="button" class="btn btn-light form-control" onClick="onAddPoint()">Add point</button>
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

    function onAddPoint() {
        added++;
        $('#resources').append('<div class="mb-2" id="' + added + '"><div class="row"><div class="col-md-4"><input type="text" name="points[x][]" class="form-control" placeholder="Tier"></div><div class="col-md-4"><input type="text" name="points[y][]" class="form-control" placeholder="Number"></div> <div class="col-md-4"> <button type="button" class="btn btn-danger form-control" onClick="onRemovePoint(' + added + ')">X</button> </div></div></div>');
        setTimeout(() => {
            $('.ui.dropdown').dropdown();
        }, 250);
    }

    function onRemovePoint(id) {
        $('#' + id).remove();
    }
</script>
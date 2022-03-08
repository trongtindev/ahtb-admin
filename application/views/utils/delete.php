<div class="alert alert-danger">
    Confirm delete <?= $item->name ?>?
</div>

<form method="POST" class="center">
    <button type="submit" name="submit" class="btn btn-danger">Yes</button>
    <a href="<?= $backUrl ?>" class="btn btn-primary">No</a>
</form>
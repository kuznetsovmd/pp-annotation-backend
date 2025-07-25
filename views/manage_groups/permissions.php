<?php 
    include_once __DIR__ . '/../blocks/header.php';
    use Engine\Services\CSRFService as CSRF; 
?>


<div class="container page-root">
<main class="col">

<div class="row align-items-center" style="height: 4em">
    <div class="col-md-6">
        <b>List of permissions for <?php echo $group['name'] ?></b>
    </div>

    <div class="col-md-6">
        <form action="" class="form-inline justify-content-end" method="post">
            <input name="csrf_token" value="<?php echo CSRF::generate() ?>" hidden>
            <div class="form-group">
                <select class="custom-select custom-select-sm" name="permission">
                <?php foreach ($all_permissions as $permission) { ?>
                    <option value=<?php echo $permission['id'] ?> ><?php echo $permission['for'] ?></option>
                <?php } ?>
                </select>
            </div>
            <div class="form-group pl-2">
                <input class="btn btn-sm btn-success" type="submit" value="Assign">
            </div>
        </form>
    </div>
</div>

<div class="row">
<div class="col">
<div class="card">
<div class="card-body">

    <div class="row">
        <div class="col">
                                    
        <table class="table table-sm mb-0">
            <thead>
            <tr>
                <th scope="col" class="col-1">#</th>
                <th scope="col" class="col-9">Name</th>
                <th scope="col" class="col-2">
                    <div class="d-flex justify-content-end">Actions</div>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 0; foreach ($permissions as $permission) { $i++; ?>
                <tr>
                <th scope='row'><?php echo $i ?></th>
                <td><?php echo $permission['for'] ?></td>
                <td>
                    <div class='d-flex justify-content-end'>
                    <form action='' method='post' class='form-inline justify-content-end'>
                        <input name="csrf_token" value="<?php echo CSRF::generate() ?>" hidden>
                        <input type='hidden' name='_method' value='delete'>
                        <input type='hidden' name='permission' value='<?php echo $permission['permission_id'] ?>'>
                        <input class='ml-1 btn btn-sm btn-outline-danger' type='submit' value='Disassign'>
                    </form>
                    </div>
                </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

        </div>
    </div>

</div>
</div>
</div>
</div>

</div>
</main>
</div>


<?php include_once __DIR__ . '/../blocks/footer.php' ?>

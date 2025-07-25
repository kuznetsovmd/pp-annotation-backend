<?php 
    include_once __DIR__ . '/blocks/header.php';
    use Engine\Services\CSRFService as CSRF; 
?>


<div class="container page-root">

    <div class="row">

        <?php if (!empty($policy)) { ?>

            <div class="col-4">
            <div class="row sticky-sidebar">
            <div class="col">
                <div class="card">
                    <div class="card-header d-inline-flex">
                        <div class="col m-0 p-0" style="min-width: 90%">Annotation Layers</div>
                        <div class="col m-0 p-0" style="min-width: 10px">
                            <div class="d-flex m-0 p-0 h-100 justify-content-center align-items-center" id="pin_icon"></div>
                        </div>
                    </div>
                    <div class="card-body overflow p-1">
                        <div id="layers_management"></div>
                    </div>
                </div>
            </div>
            </div>
            </div>

            <div class="col-8">
            <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div id="annotation_surface"><?php echo $policy['content'] ?></div>
                    </div>
                </div>
            </div>
            </div>

            <div class="row mt-3">
            <div class="col">
                <form action="/annotation" method="post" id="json_form" hidden>
                    <input name="csrf_token" value="<?php echo CSRF::generate() ?>" hidden>
                    <input id="json_data" name="json" type="text">
                </form>
                <button id="commit" class="btn btn-lg btn-success btn-block">Commit annotations</button>
            </div>
            </div>
            </div>

            </div>
            
        <?php } else { ?>

            <main class="col">

            <div class="text-center">
                <h1 class="display-4">Attention!</h1>
                <p class="lead">The data was not uploaded to the database.</p>
            </div>

            </main>


        <?php } ?>

    </div>

</div>


<?php include_once __DIR__ . '/blocks/footer.php' ?>

<?php 
    include_once __DIR__ . '/blocks/header.php';
    use Engine\Services\CSRFService as CSRF; 
?>


<div class="container page-root">

    <main class="col">

    <div class="text-center">

        <div class="row pt-4">
            <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-sm-8 offset-sm-2">
                <form enctype="multipart/form-data" action="/data-upload" method="post">
                    <input name="csrf_token" value="<?php echo CSRF::generate() ?>" hidden>
                    <div class="form-group text-left">
                        <label for="descriptorFile" class="form-label">Descriptor file in zip-archive</label>
                        <input id="descriptorFile" name="descriptor" type="input" class="form-control" required="">
                    </div>
                    <div class="form-group text-left">
                        <label for="documentsPath" class="form-label">Subfolder with documents within zip-archive</label>
                        <input id="documentsPath" name="documents" type="input" class="form-control" required="">
                    </div>
                    <div class="form-group text-left">
                        <label for="fileKey" class="form-label">Descriptor key for file (with extension) identification</label>
                        <input id="fileKey" name="key" type="input" class="form-control" required="">
                    </div>
                    <div class="form-group text-left">
                        <label for="inputData" class="form-label">Zip-archive with data</label>
                        <input id="inputData" name="data" type="file" class="form-control" required="" accept=“zip/*”>
                    </div>
                    <div class="form-group text-left">
                        <input class="btn btn-lg btn-primary btn-block" type="submit" value="Upload">
                    </div>
                </form>
                <div class="text-left py-4">
                    <div class="py-2">Annotation results</div>
                    <a class="btn btn-lg btn-success btn-block" href="/data-download">Download</a>
                </div>
            </div>
        </div>

    </div>

    </main>

</div>

<?php include_once __DIR__ . '/blocks/footer.php' ?>

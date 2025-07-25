<?php 
    use Engine\Services\CSRFService as CSRF; 
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title ?></title>
    <script type="text/javascript" src="/js/index.js"></script>
</head>
<body>

<div class="container page-root">

    <main class="col">

    <div class="row justify-content-center">
        <h1 class="display-4">Hello!</h1>
    </div>

    <div class="row justify-content-center">
        <p class="lead">
            Greetings! You are at the sign up page now. Also you can <a href="/login">sign in</a>.
        </p>
    </div>

    <div class="row py-4">
        <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-sm-8 offset-sm-2">

            <form method="post">
                <input name="csrf_token" value="<?php echo CSRF::generate() ?>" hidden>
                <div class="form-group text-left">
                    <label for="inputUsername">Username</label>
                    <input type="text" name="user[name]" id="inputUsername" class="form-control"
                            placeholder="Enter username" required="" autofocus="">
                </div>
                <div class="form-group text-left">
                    <label for="inputEmail">Email</label>
                    <input type="email" name="user[email]" id="inputEmail" class="form-control"
                            placeholder="Enter email"
                            required="">
                </div>
                <div class="form-group text-left">
                    <label for="inputPassword">Password</label>
                    <input type="password" name="user[password]" id="inputPassword" class="form-control"
                            placeholder="Enter password" required="">
                </div>
                <div class="form-group text-left">
                    <label for="inputPassword">Password confirmation</label>
                    <input type="password" name="user[password_confirm]" id="inputPassword" class="form-control"
                            placeholder="Confirm password" required="">
                </div>
                <div class="form-group text-left py-4">
                    <input class="btn btn-lg btn-primary btn-block" type="submit" value="Sign up">
                </div>
            </form>

        </div>
    </div>

    </main>

</div>

</body>
</html>

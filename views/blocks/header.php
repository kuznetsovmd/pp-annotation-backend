<?php 
    use Engine\Services\AuthService as Auth; 
    use Engine\Services\CSRFService as CSRF; 
    use App\Models\User; 
?>


<!doctype html>
<html lang="en">
<head>
    <title><?php echo $title ?></title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script type="text/javascript" src="/js/index.js"></script>
</head>
<body>
    
<header class="navbar navbar-expand fixed-top navbar-dark bg-dark">
<div class="container">

    <a class="navbar-brand" href="/">Annotation</a>
    
    <?php if ($id) { ?>

    <div class="navbar-nav-scroll">

        <ul class="navbar-nav bd-navbar-nav flex-row">
        
            <?php if (Auth::allowed($id, ['visit-home'])) { ?>
            <li class="nav-item">
                <a class="nav-link" href="/home">Home</a>
            </li>
            <?php } ?>
            
            <?php if (Auth::allowed($id, ['manage-users'])) { ?>
            <li class="nav-item">
                <a class="nav-link" href="/users">Users</a>
            </li>
            <?php } ?>
            
            <?php if (Auth::allowed($id, ['manage-groups'])) { ?>
            <li class="nav-item">
                <a class="nav-link" href="/groups">Groups</a>
            </li>
            <?php } ?>
            
            <?php if (Auth::allowed($id, ['manage-data'])) { ?>
            <li class="nav-item">
                <a class="nav-link" href="/data">Data</a>
            </li>
            <?php } ?>
            
        </ul>

    </div>

    <ul class="navbar-nav ml-auto flex-row">
        <li class="nav-item dropdown">
            <a class="nav-item nav-link dropdown-toggle" href="#" id="bd-actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo (User::getById($id)['name']); ?></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bd-actions">
                <form class="form-inline" action="/logout" method="post">
                    <input name="csrf_token" value="<?php echo CSRF::generate() ?>" hidden>
                    <input class="dropdown-item" type="submit" value="Sign Out">
                </form>
            </div>
        </li>
    </ul>

    <?php } else { ?>

    <ul class="navbar-nav ml-auto flex-row">
        <li class="nav-item mr-2">
            <a class="btn btn-outline-success" href="/login" role="button">Sign In</a>
        </li>
        <li class="nav-item">
            <a class="btn btn-outline-primary" href="/register" role="button">Sign Up</a>
        </li>
    </ul>

    <?php } ?>

</div>
</header>

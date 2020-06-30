<?php require_once 'autoload.php'; ?>
<?php require_once 'config/request.php'; ?>
<?php if(session_status() == PHP_SESSION_NONE){ session_start(); } ?>
<!DOCTYPE html>
<html lang="en"> <!-- #99CC36 -->
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Like Twitter App</title>
    <link rel="stylesheet" href="<?= Request::getDomain() ?>/assets/css/styles.css">
</head>
<body>
	<header>
        <div class="header-element container">
            <div>
                <h1>Like Twitter App</h1></div>
            <div>
                <?php if(isset($_SESSION['user'])): ?>
                    <span>
                        <strong><?= $_SESSION['user'][1] ?></strong>
                    </span>
                    <a href="<?= Request::generateUrl('auth','logout') ?>">Log out</a>
                <?php endif; ?>
            </div>
        </div>
	</header>
	<section id="content">
        <div class="messages">
            <?php if(isset($_SESSION['success'])): ?>
                <div class="message message__success">
                    <p><?= $_SESSION['success'] ?></p>
                </div>
            <?php endif; ?>
            <?php if(isset($_SESSION['error'])): ?>
                <div class="message message__error">        
                    <p><?= $_SESSION['error'] ?></p>
                </div>
            <?php endif; ?>
        </div>
		<div class="container">
            <?php
                if(isset($_GET['controller'])){
                    $controllerName = $_GET['controller'].'Controller';
                }else{
                    header("Location: ". Request::generateUrl('auth','login'));
                }

                if(class_exists($controllerName)){	
                    $controller = new $controllerName();
                    if(isset($_GET['action']) && method_exists($controller, $_GET['action'])){
                        $action = $_GET['action'];
                        $controller->$action();
                    }else{
                        echo "La página que buscas no existe";
                    }
                }else{
                    echo "La página que buscas no existe ";
                }
            ?>	
		</div>
	</section>

	<footer>
	</footer>
</body>
</html>
<?php
	unset($_SESSION['success']);
    unset($_SESSION['error']);
	unset($_SESSION['registerData']);
	unset($_SESSION['formError']);
?>
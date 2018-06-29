<?php include __DIR__ . '/config.php'; include __DIR__ . '/init.php';

$rep = new \App\Authentication\Repository\UserRepository($link);
$service = new \App\Authentication\Service\AuthenticationService($rep);
$encoder = new \App\Authentication\Encoder\UserPasswordEncoder();
$user_token = new \App\Authentication\UserToken($service->authenticate($_POST['login'].'_'.$encoder->encodePassword($_POST['password'],'')));

if($service->authenticate($_POST['login'].'_'.$encoder->encodePassword($_POST['password'],''))->getUser() != null)
    $_SESSION['message'] = 'Добро пожаловать';
else
    $_SESSION['message'] = 'Неверный логин или пароль';

if ( isset( $_POST['signup_btn'] ) ) {
    header('Location: signup.php');
}
if ( isset( $_POST['login_btn'] ) ) {
    header('Location: index.php');
}
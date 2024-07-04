<?session_start();

require_once("db_connection.php");

$login = $_POST["login"];
$password = $_POST["password"];

if(!empty($login) && !empty($password)) {
    $sql = "SELECT * FROM users WHERE login = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$login]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $verif = password_verify($password, $user["password"]);

    if($password == $verif) {
        $_SESSION["alert"]["message"] = 'Авторизация успешна';
        $_SESSION["alert"]["class"] = 'success';
        $_SESSION["authorize"] = true;
        $_SESSION["id_user"] = $user["id"];
        
        if($user["is_admin"]) {
            $_SESSION["is_admin"] = true;
        }

        header("Location: /users.php");
        exit;
    }else{
        $_SESSION["alert"]["message"] = 'Неверный логин или пароль';
        $_SESSION["alert"]["class"] = 'danger';
        
        header("Location: /page_login.php");
        exit;
    }
}
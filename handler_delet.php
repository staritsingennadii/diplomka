<?session_start();

if(!$_SESSION["authorize"]) {
    header("Location: /page_login.php");
    exit;
}elseif((!$_SESSION["is_admin"] && $_GET["id"] != $_SESSION["id_user"]) || empty($_GET["id"])){
    $_SESSION["alert"]["message"] = 'можно редактировать только свой профиль';
    $_SESSION["alert"]["class"] = 'danger';

    header("Location: /users.php");
    exit;
}

require_once("db_connection.php");

$id = $_GET["id"];
$sql = "SELECT photo FROM USERS WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

unlink('upload/' . $user["photo"]);

$sql = "DELETE FROM users WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();

if($_SESSION["id_user"] == $_GET["id"]) {
    unset($_SESSION["authorize"]);
    unset($_SESSION["id_user"]);

    header("Location: /page_register.php");
    exit;
}else{
    $_SESSION["alert"]["message"] = 'Пользователь удален';
    $_SESSION["alert"]["class"] = 'success';

    header("Location: /users.php");
    exit;
}
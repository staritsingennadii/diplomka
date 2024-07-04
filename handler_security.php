<? session_start();

require_once("db_connection.php");

$login = $_POST["login"];
$id = $_POST['id'];

$sql = "SELECT * FROM USERS WHERE login = :login";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':login', $login);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if($user) {
    $_SESSION["alert"]["message"] = 'Email занят';
    $_SESSION["alert"]["class"] = 'danger';

    header('Location: /security.php?id=' . $id);
    exit;
}

if($_POST["password"] != $_POST["password_confirm"]) {
    $_SESSION["alert"]["message"] = 'Пароль не совпадает';
    $_SESSION["alert"]["class"] = 'danger';

    header('Location: /security.php?id=' . $id);
    exit;
}

$hashPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);

$sql = "UPDATE users SET login = :login, password = :password WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':login', $login);
$stmt->bindValue(':password', $hashPassword);
$stmt->bindValue(':id', $id);
$stmt->execute();

$_SESSION["alert"]["message"] = 'Профиль успешно обновлен';
$_SESSION["alert"]["class"] = 'success';

header("Location: /page_profile.php");
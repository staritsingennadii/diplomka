<?session_start();

require_once("db_connection.php");

$id = $_POST["id"];
$status = $_POST["status"];

$sql = "UPDATE users SET status = :status WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':status', $status);
$stmt->bindValue(':id', $id);
$stmt->execute();

$_SESSION["alert"]["message"] = 'Профиль успешно обновлен';
$_SESSION["alert"]["class"] = 'success';

header("Location: /page_profile.php?id=" . $_POST["id"]);
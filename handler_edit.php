<?session_start();

require_once("db_connection.php");

$sql = "UPDATE users SET name = :name, position = :position, phone = :phone, address = :address WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':name', $_POST["name"]);
$stmt->bindParam(':position', $_POST["position"]);
$stmt->bindParam(':phone', $_POST["phone"]);
$stmt->bindParam(':address', $_POST["address"]);
$stmt->bindParam(':id', $_POST["id"]);
$stmt->execute();

$_SESSION["alert"]["message"] = 'Профиль успешно обновлен';
$_SESSION["alert"]["class"] = 'success';

header('Location: /page_profile.php?id=' . $_POST['id']);
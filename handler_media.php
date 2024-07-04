<?session_start();

require_once("db_connection.php");

if($_FILES["photo"]) {
    $id = $_POST["id"];
    $sql = "SELECT photo FROM users WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    unlink('upload/' . $user["photo"]);

    $format = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
    $photoName = uniqid() . '.' . $format;
    $uploadfile = 'upload/' . $photoName;
    move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile);

    $sql = "UPDATE users SET photo = :photo WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':photo', $photoName);
    $stmt->bindParam(':id', $_POST["id"]);
    $stmt->execute();

    $_SESSION["alert"]["message"] = 'Профиль успешно обновлен';
    $_SESSION["alert"]["class"] = 'success';

    header("Location: /page_profile.php?id=" . $_POST["id"]);
    exit;
}
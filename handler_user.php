
<? session_start();
require_once("db_connection.php");

$login = $_POST["email"];
$password = $_POST["password"];
$name = $_POST["name"];
$position = $_POST["position"];
$phone = $_POST["phone"];
$address = $_POST["address"];
$status = $_POST["status"];
$photo = $_POST["photo"];
$vk = $_POST["vk"];
$telegram = $_POST["telegram"];
$instagram = $_POST["instagram"];


if($login) {
    $sql = "SELECT * FROM users WHERE login = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$login]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user) {
        $_SESSION["alert"]["message"] = 'Пользователь с таким логином уже существует. Введите другой email.';
        $_SESSION["alert"]["class"] = 'danger';
        
        header("Location: /create_user.php");
    }else{
        $password = password_hash($password, PASSWORD_DEFAULT);
        $photoFormat = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
        $photo = uniqid() . '.' . $photoFormat;
        $uploaddir = 'upload/';
        $uploadfile = $uploaddir . $photo;
        move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile);

        $sql = "INSERT INTO users (login, password, name, position, phone, address, status, photo, vk, telegram, instagram) VALUES (:login, :password, :name, :position, :phone, :address, :status, :photo, :vk, :telegram, :instagram)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':login', $login);
        $stmt->bindValue(':password', $password);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':position', $position);
        $stmt->bindValue(':phone', $phone);
        $stmt->bindValue(':address', $address);
        $stmt->bindValue(':status', $status);
        $stmt->bindValue(':photo', $photo);
        $stmt->bindValue(':vk', $vk);
        $stmt->bindValue(':telegram', $telegram);
        $stmt->bindValue(':instagram', $instagram);
        $stmt->execute();

        $_SESSION["alert"]["message"] = 'Пользователь успешно добавлен.';
        $_SESSION["alert"]["class"] = 'success';

        header("Location: /users.php");
    }
}
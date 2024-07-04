<?session_start();

require_once("db_connection.php");

$login = $_POST["login"];
$password = $_POST["password"];

$sql = "SELECT * FROM users WHERE login = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$login]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$user) {
    $passHash = password_hash($password, PASSWORD_DEFAULT);
    $sql = 'INSERT INTO users (login, password, is_admin, name, position, phone, address, status, photo, vk, telegram, instagram) VALUES (:login, :password, :is_admin, :name, :position, :phone, :address, :status, :photo, :vk, :telegram, :instagram)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':login',$login);
    $stmt->bindValue(':password',$password);
    $stmt->bindValue(':is_admin', 0);
    $stmt->bindValue(':name','');
    $stmt->bindValue(':position','');
    $stmt->bindValue(':phone','');
    $stmt->bindValue(':address','');
    $stmt->bindValue(':status','');
    $stmt->bindValue(':photo','');
    $stmt->bindValue(':vk','');
    $stmt->bindValue(':telegram','');
    $stmt->bindValue(':instagram','');
    $res = $stmt->execute();

    if($res) {
        $_SESSION["alert"]["message"] = 'Регистрация успешна';
        $_SESSION["alert"]["class"] = 'success';
        
        header("Location: /page_login.php");
        exit;
    }else{
        header("Location: /page_register.php");
        exit;    
    }
}else{
    $_SESSION["alert"]["message"] = 'Этот эл. адрес уже занят другим пользователем';
    $_SESSION["alert"]["class"] = 'danger';
    
    header("Location: /page_register.php");
    exit;
}
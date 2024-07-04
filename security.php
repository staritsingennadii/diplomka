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
$sql = "SELECT login FROM USERS WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Безопаность</title>
    <meta name="description" content="Chartist.html">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="css/vendors.bundle.css">
    <link id="appbundle" rel="stylesheet" media="screen, print" href="css/app.bundle.css">
    <link id="myskin" rel="stylesheet" media="screen, print" href="css/skins/skin-master.css">
    <link rel="stylesheet" media="screen, print" href="css/fa-solid.css">
    <link rel="stylesheet" media="screen, print" href="css/fa-brands.css">
</head>
<body>
    <?require_once("header.php");?>
    
    <main id="js-page-content" role="main" class="page-content mt-3">
        <?if(isset($_SESSION["alert"])) {?>
            <div class="alert alert-<?=$_SESSION["alert"]["class"];?>">
                <?=$_SESSION["alert"]["message"];?>
            </div>
            <?unset($_SESSION["alert"]);?>
        <?}?>
        
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-lock'></i> Безопасность
            </h1>
        </div>
        <form action="handler_security.php" method="post">
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>Обновление эл. адреса и пароля</h2>
                            </div>
                            <div class="panel-content">
                                <!-- email -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Email</label>
                                    <input name="login" type="text" id="simpleinput" class="form-control" value="<?=$user['login'];?>">
                                </div>

                                <!-- password -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Пароль</label>
                                    <input name="password" type="password" id="simpleinput" class="form-control">
                                </div>

                                <!-- password confirmation-->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Подтверждение пароля</label>
                                    <input name="password_confirm" type="password" id="simpleinput" class="form-control">
                                </div>

                                <input name="id" type="hidden" value="<?=$_GET["id"];?>">

                                <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                    <button type="submit" class="btn btn-warning">Изменить</button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </form>
    </main>

    <script src="js/vendors.bundle.js"></script>
    <script src="js/app.bundle.js"></script>
    <script>

        $(document).ready(function()
        {

            $('input[type=radio][name=contactview]').change(function()
                {
                    if (this.value == 'grid')
                    {
                        $('#js-contacts .card').removeClassPrefix('mb-').addClass('mb-g');
                        $('#js-contacts .col-xl-12').removeClassPrefix('col-xl-').addClass('col-xl-4');
                        $('#js-contacts .js-expand-btn').addClass('d-none');
                        $('#js-contacts .card-body + .card-body').addClass('show');

                    }
                    else if (this.value == 'table')
                    {
                        $('#js-contacts .card').removeClassPrefix('mb-').addClass('mb-1');
                        $('#js-contacts .col-xl-4').removeClassPrefix('col-xl-').addClass('col-xl-12');
                        $('#js-contacts .js-expand-btn').removeClass('d-none');
                        $('#js-contacts .card-body + .card-body').removeClass('show');
                    }

                });

                //initialize filter
                initApp.listFilter($('#js-contacts'), $('#js-filter-contacts'));
        });

    </script>
</body>
</html>
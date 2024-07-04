<?session_start();

if(!$_SESSION["authorize"]) {
    header("Location: /page_login.php");
    exit;
}

if((!$_SESSION["is_admin"] && $_GET["id"] != $_SESSION["id_user"]) || empty($_GET["id"])) {
    $_SESSION["alert"]["message"] = 'Можно редактировать только свой профиль';
    $_SESSION["alert"]["class"] = 'danger';

    header("Location: /users.php");
    exit;
}

require_once("db_connection.php");

$sql = "SELECT * FROM users WHERE ID = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $_GET["id"]);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
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
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-plus-circle'></i> Редактировать
            </h1>

        </div>
        <form action="handler_edit.php" method="post">
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>Общая информация</h2>
                            </div>
                            <div class="panel-content">
                                <!-- username -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Имя</label>
                                    <input name="name" type="text" id="simpleinput" class="form-control" value="<?=$user["name"];?>">
                                </div>

                                <!-- title -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Место работы</label>
                                    <input name="position" type="text" id="simpleinput" class="form-control" value="<?=$user["position"];?>">
                                </div>

                                <!-- tel -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Номер телефона</label>
                                    <input name="phone" type="text" id="simpleinput" class="form-control" value="<?=$user["phone"];?>">
                                </div>

                                <!-- address -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Адрес</label>
                                    <input name="address" type="text" id="simpleinput" class="form-control" value="<?=$user["address"];?>">
                                </div>

                                <input name="id" value="<?=$_GET["id"];?>" type="hidden">

                                <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                    <button type="submit" class="btn btn-warning">Редактировать</button>
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
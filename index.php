<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<?php
require_once 'vendor/connect.php';
require_once 'vendor/isbanned.php';

$result = mysqli_query($connect, "SELECT * FROM `users`");

if (isBanned($connect)) {
    $_SESSION['message'] = 'You was banned';
    setcookie('user', $_COOKIE['user'], time() - 3600, "/");
    header('Location: public/signin.php');
}
?>

<script>
    $(document).ready(function () {
        $("#form #select-all").click(function () {
            $("form input[type='checkbox']").prop('checked', this.checked);
        });
    });
</script>

<!doctype html>
<html>
<head>
    <title>Auth</title>
    <meta name="description" content="Our first page">
    <meta name="keywords" content="html tutorial template">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <a href="/index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                <img class="bi me-2"
                     src="images/auth.svg" alt="" width="60" height="50">
            </a>
            <?php
            if(!isset($_COOKIE['user'])):
                ?>
                <div class="col-md-3 text-end">
                    <a class="btn btn-primary" href="public/signin.php" role="button">Login</a>
                    <a class="btn btn-primary" href="public/signup.php" role="button">Sign-up</a>
                </div>
            <?php else: ?>
                <p>Hello, <?= $_COOKIE['user']?> <a href="vendor/exit.php">exit</a></p>
            <?php endif; ?>
        </header>
    </div>
</head>
<body>
<?php
if(isset($_COOKIE['user'])):
    ?>
    <form method="post" id="form" action="vendor/userAction.php">
        <div class="container-lg">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">
                        <div class="form-check">
                            <input class="form-check-input position-static" type="checkbox"
                                   id="select-all" value="option" aria-label="..."> Select All
                        </div>
                    </th>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Registration date</th>
                    <th scope="col">Last login</th>
                    <th scope="col">Status</th>
                </tr>
                </thead>

                <tbody>
                <?php
                while ($user = mysqli_fetch_assoc($result)) {
                    if($user['status']) {
                        $status = "Banned";
                    } else {
                        $status = "-";
                    }
                    ?>
                    <tr>
                        <th>
                            <div class="form-group">
                                <input class="form-check-input position-static" type="checkbox"
                                       id="blankCheckbox" value="<?=$user['id']?>" name="id[]">
                            </div>
                        </th>
                        <td><?=$user['id']?></td>
                        <td><?=$user['name']?></td>
                        <td><?=$user['login']?></td>
                        <td><?=$user['registration_date']?></td>
                        <td><?=$user['last_login']?></td>
                        <td><?=$status?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
                <div class="container-lg">
                    <div class="btn-group" role="group" aria-label="Third group">
                        <button type="submit" class="btn btn-primary"
                                name="act" value="block">Block</button>
                    </div>
                    <div class="btn-group" role="group" aria-label="Third group">
                        <button type="submit" class="btn btn-primary"
                                name="act" value="unblock">Unblock</button>
                    </div>
                    <div class="btn-group" role="group" aria-label="Third group">
                        <button type="submit" class="btn btn-primary"
                                name="act" value="delete">Delete</button>
                    </div>
                </div>
    </form>

    </table>
    </div>
<?php else: ?>
    <div class="container-lg">
        <div>
            <p>You need to be logged in to see the user table.
                Please <a href="public/signin.php">login</a> / <a href="public/signup.php">sign up</a>.</p>
        </div>
    </div>
<?php endif; ?>
</body>
</html>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../CSS/login.css">
    <title>Login</title>
</head>
<body>
    <div class="wrapper">
        <div class="container main">
            <div class="row">
                <div class="col-md-6 side-image">
                        <!------------Image--------->
                        <img src="../icon/logo.png" alt="">
                        <div class="text">
                            <p>MICHELLE'S<i>BURGER</i></p>
                        </div>
                </div>
                <div class="col-md-6 right">
                <form action="login-process.php" method="post">
                    <div class="back">
                    <a href="../WST Final Project/user.php" class="back-button">&#8592; Back</a> 
                    </div>
                    <div class="input-box">
                    <header>LOGIN AS ADMIN</header>
                        <div class="input-field">
                            <input type="text" class="input" id="email" required autocomplete="off">
                            <label for="email">Email</label>
                        </div>
                        <div class="input-field">   
                            <input type="password" class="input" id="password" required>
                            <label for="password">Password</label>
                        </div>
                        <div class="input-field">
                            <input type="submit" class="submit" value="LOGIN">
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>

    </div>


</body>
</html>

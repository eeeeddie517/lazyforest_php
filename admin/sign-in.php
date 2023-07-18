<?php
session_start();

if(isset($_SESSION["admin"])){
    header("location: ../camp_home-LIN.php");
}

?>




<!doctype html>
<html lang="en">

<head>
    <title>Sign-in</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <style>
        body {
            background: url("/images/deserted-beach-travel-1920x720.jpg") center center/cover;
        }

        .sign-in-panel {
            width: 320px;
            /* background-color: aquamarine; */
        }

        .logo {
            height: 100px;
        }

        .input-area .form-floating:first-child .form-control {
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
            border-bottom: 0;
        }
        .input-area .form-floating:last-child .form-control {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
        .input-area .form-control:focus {
            z-index: 1;
        }
        .form-floating>label {
            z-index: 5;
        }
    </style>
</head>

<body>
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="sign-in-panel text-center">
            <img class="logo" src="/images/Tripadvisor-Logo.png" alt="">
            <h1 class="text-center text-white">Please Sign in</h1>
            <?php
                if(isset($_SESSION["error"]["times"]) && $_SESSION["error"]["times"]>=5):
            ?>
                <h2>
                    錯誤次數太多, 請稍後再登入
                </h2>
            <?php else: ?>
            <form action="doLogin.php" method="post">
                <div class="input-area">
                    <div class="form-floating">
                        <input type="text" class="form-control position-relative" id="floatingInput" placeholder="" name="name">
                        <label for="floatingInput">Account</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control position-relative" id="floatingPassword" placeholder="Password" name="password">
                        <label for="floatingPassword">Password</label>
                    </div>
                </div>
                <?php if(isset($_SESSION["error"]["message"])): ?>
                <div class=" mt-1 p-2 text-light bg-danger rounded">
                    <?= $_SESSION ["error"]["message"]?>
                </div>
                <?php unset($_SESSION["error"]["message"]); endif; ?>
                <div class="d-flex justify-content-center">
                    <div class="form-check m-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                        <label class="form-check-label" for="flexCheckChecked">
                            Remember Me
                        </label>
                    </div>
                </div>
                <div class="d-grid">
                    <button class="btn btn-primary" type="submit">Sign in</button>
                </div>
            </form>
            <?php endif; ?>
            <div class="mt-4 text-secondary">
                &copy; 2017-2023
            </div>

        </div>

    </div>















    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>
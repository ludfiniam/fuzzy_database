<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Login Form</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="/assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="/assets/login/signin.css" rel="stylesheet">
</head>

<body class="text-center">
    <form class="form-signin" method="post" action="/index/try_login">
        <a href="/"><img src="/assets/login/logo-phoneku.png" class="rounded mx-auto d-block" height="40" alt=""></a>
        <p></p>
        <p></p>
        <h1 class="h3 mb-3 font-weight-normal">Login form</h1>
        <?php if (session()->getFlashdata('msg')) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('ass')) : ?>
            <div class="alert alert-warning"><?= session()->getFlashdata('ass') ?></div>
        <?php endif; ?>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="text" id="inputEmail" name="email" class="form-control" value="<?= old('email'); ?>" placeholder="Email or Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control mb-3" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block mb-3" type="submit">Sign in</button>
        <div class="text-center">
            <a href="https://api.whatsapp.com/send?phone=628985222402&text=Saya%20ingin%20membuat%20akun%20user%20di%20sistem%20mobilku%20anda%2C%20apakah%20bisa%20di%20bantu">Daftar sebagai user</a>
        </div>
        <p class="mt-5 mb-3 text-muted">&copy; Phoneku</p>
    </form>
</body>

</html>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ahmad Ludfi Ni'am">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Phoneku</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="/favicon.png" rel="icon">
    <link href="/assets/dashboard/assets/img/apple-touch-icon.png" rel="apple-touch-icon">


    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/dashboard/">

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
    <link href="/assets/user/navbar-top.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-3">
        <div class="col-2">
            <div class="text-center">
                <a class="navbar-brand" href="/user">Phoneku</a>
            </div>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="/user">Dashboard</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="/user/data_smartphone">Data smartphone</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="/user/profile">profile</a>
                </li>
            </ul>
            <form class="form-inline mt-2 mt-md-0">
                <ul class="navbar-nav mr-auto">
                    <a href="/user/logout" class="nav-link"><span data-feather="log-out"></span> Logout</a>
                </ul>
            </form>
        </div>
    </nav>

    <?= $this->renderSection('content_user'); ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')
    </script>
    <script src="/assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script src="/assets/admin/dashboard.js"></script>
</body>

</html>
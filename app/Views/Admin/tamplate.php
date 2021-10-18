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
    <link href="/assets/admin/dashboard.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="/admin">Phoneku</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="/admin/logout"><span data-feather="log-out"></span> Logout</a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="sidebar-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="/admin">
                                <span data-feather="home"></span>
                                Dashboard <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/datasmartphone">
                                <span data-feather="file"></span>
                                Data Smartphone
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/data_seller">
                                <span data-feather="users"></span>
                                Data Seller
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/profile">
                                <span data-feather="user"></span>
                                Profile
                            </a>
                        </li>
                        <div class="dropdown">
                            <li class="nav-item">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                                    <span data-feather="layers"></span>
                                    Kriteria non Fuzzy
                                </a>
                                <div class="dropdown-menu " aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="/admin/jenis_merek">Merek</a>
                                    <a class="dropdown-item" href="/admin/jenis_ui_os">UI OS</a>
                                    <a class="dropdown-item" href="/admin/jenis_layar">Jenis Layar</a>
                                    <a class="dropdown-item" href="/admin/jenis_protect_layar">Protrksi Layar</a>
                                    <a class="dropdown-item" href="/admin/jenis_bahan_body">Bahan Body</a>
                                    <a class="dropdown-item" href="/admin/jenis_chipset">Processor</a>
                                    <a class="dropdown-item" href="/admin/jenis_gpu">GPU</a>
                                    <a class="dropdown-item" href="/admin/jenis_usb">USB Charger</a>
                                </div>
                            </li>
                        </div>
                        <div class="dropdown">
                            <li class="nav-item">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                                    <span data-feather="layers"></span>
                                    Nilai Keanggotaan Fuzzy
                                </a>
                                <div class="dropdown-menu " aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="/admin/keanggotaan_harga"><span data-feather="dollar-sign"></span> Harga</a>
                                    <a class="dropdown-item" href="/admin/keanggotaan_tahun"><span data-feather="list"></span> Tahun</a>
                                    <a class="dropdown-item" href="/admin/keanggotaan_resolusi_layar"><span data-feather="smartphone"></span> Resolusi Layar</a>
                                    <a class="dropdown-item" href="/admin/keanggotaan_processor"><span data-feather="slack"></span> Clock Speed CPU</a>
                                    <a class="dropdown-item" href="/admin/keanggotaan_internal"><span data-feather="grid"></span> Penyimpanan Internal</a>
                                    <a class="dropdown-item" href="/admin/keanggotaan_ram"><span data-feather="grid"></span> RAM</a>
                                    <a class="dropdown-item" href="/admin/keanggotaan_resolusi_main_kamera"><span data-feather="camera"></span> Resolusi Main Camera</a>
                                    <a class="dropdown-item" href="/admin/keanggotaan_batrai"><span data-feather="battery-charging"></span> Kapasitas Batrai</a>
                                    <a class="dropdown-item" href="/admin/keanggotaan_antutu"><span data-feather="bar-chart-2"></span> Score Antutu</a>
                                </div>
                            </li>
                        </div>
                    </ul>

                </div>
            </nav>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <?= $this->renderSection('content_admin'); ?>
            </main>
        </div>
    </div>
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
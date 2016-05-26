<!DOCTYPE html>
<html>
<head>
    <title>SchoolBus - Sistema de Gestão de Transporte Escolar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" />
    <!-- CSS Libs -->
    <link rel="stylesheet" type="text/css" href="<?= HOME; ?>lib/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME; ?>lib/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME; ?>lib/css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME; ?>lib/css/bootstrap-switch.min.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME; ?>lib/css/checkbox3.min.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME; ?>lib/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME; ?>lib/css/dataTables.bootstrap.css">
    <!-- CSS App -->
    <link rel="stylesheet" type="text/css" href="<?= HOME; ?>css/style.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME; ?>css/themes/flat-blue.css">
</head>

<body class="flat-blue">
    <div class="app-container">
        <div class="row content-container">
            <nav class="navbar navbar-default navbar-fixed-top navbar-top">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-expand-toggle">
                            <i class="fa fa-bars icon"></i>
                        </button>
                        <ol class="breadcrumb navbar-breadcrumb">
                            <li class="active">Dashboard</li>
                        </ol>
                        <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                            <i class="fa fa-th icon"></i>
                        </button>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                            <i class="fa fa-times icon"></i>
                        </button>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-comments-o"></i></a>
                            <ul class="dropdown-menu animated fadeInDown">
                                <li class="title">
                                    Notificações <span class="badge pull-right">0</span>
                                </li>
                                <li class="message">
                                    Sem novas notificações
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown danger">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-star-half-o"></i> 4</a>
                            <ul class="dropdown-menu danger  animated fadeInDown">
                                <li class="title">
                                    Notificações <span class="badge pull-right">4</span>
                                </li>
                                <li>
                                    <ul class="list-group notifications">
                                        <a href="#">
                                            <li class="list-group-item">
                                                <span class="badge">1</span> <i class="fa fa-exclamation-circle icon"></i> novos registros
                                            </li>
                                        </a>
                                        <a href="#">
                                            <li class="list-group-item">
                                                <span class="badge success">1</span> <i class="fa fa-check icon"></i> novos pedidos
                                            </li>
                                        </a>
                                        <a href="#">
                                            <li class="list-group-item">
                                                <span class="badge danger">2</span> <i class="fa fa-comments icon"></i> mensagens
                                            </li>
                                        </a>
                                        <a href="#">
                                            <li class="list-group-item message">
                                                ver tudo
                                            </li>
                                        </a>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown profile">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Adm Teste <span class="caret"></span></a>
                            <ul class="dropdown-menu animated fadeInDown">
                                <li class="profile-img">
                                    <img src="<?= HOME; ?>img/profile/picjumbo.com_HNCK4153_resize.jpg" class="profile-img">
                                </li>
                                <li>
                                  <!-- dados do profile -->
                                    <div class="profile-info">
                                        <h4 class="username">Adm Teste</h4>
                                        <p>adm@email.com</p>
                                        <div class="btn-group margin-bottom-2x" role="group">
                                            <button type="button" class="btn btn-default"><i class="fa fa-user"></i> Profile</button>
                                            <button type="button" class="btn btn-default"><i class="fa fa-sign-out"></i> Logout</button>
                                        </div>
                                    </div>
                                    <!-- fim dos dados de profile -->
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

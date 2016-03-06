<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Schoolbus - Sistema de controle de transporte escolar</title>

  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" />

  <!-- Bootstrap -->
  <link href="<?= HOME; ?>css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= HOME; ?>css/style.css" rel="stylesheet">

  <!-- Themes -->
  <script type="text/javascript">
  if(localStorage.getItem("theme")){
    var theme = localStorage.getItem("theme");
    window.document.write("<link href=\"<?= HOME; ?>css/theme-"+ theme +".css\" rel=\"stylesheet\">");
  }else{
    window.document.write("<link href=\"<?= HOME; ?>css/theme-dark.css\" rel=\"stylesheet\">");
  }
  </script>
  <!-- <link href="<?= HOME; ?>css/theme-dark.css" rel="stylesheet"> -->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and
  media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via
  file:// -->
  <!--[if lt IE 9]>
  <script
  src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script
  src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="theme">
  <div class="container-fluid">

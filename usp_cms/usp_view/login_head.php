<?php 

   $tmpPSWD = checkUSPuserByLogin($_COOKIE['login'])['password'];
   
   if ($_COOKIE['password'] === $tmpPSWD and $tmpPSWD != null) {
       
       $link = $webSiteUrl.$usp.'_cms';
       
       header("Location: $link");
       exit();
   } else {
       
   }
   
?>
<html lang="ru">
<head>
<title>Привет!</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo $usp;?>_css/basic4.css" rel="stylesheet">
    <link href="<?php echo $usp;?>_css/usefull.css" rel="stylesheet">
    <link href="<?php echo $usp;?>_css/navbar_style.css" rel="stylesheet">
    <link href="<?php echo $usp;?>_css/modal_style.css" rel="stylesheet">
    <link href="<?php echo $usp;?>_css/login_style.css" rel="stylesheet">
    <link href="<?php echo $usp;?>_css/links_style.css" rel="stylesheet">
    <script src="<?php echo $usp;?>_js/jQuery_v1.12.4.js"></script>
    <script src="<?php echo $usp;?>_js/fade.js"></script>
    <script src="<?php echo $usp;?>_js/bootstrap.js"></script>
</head>
<body>

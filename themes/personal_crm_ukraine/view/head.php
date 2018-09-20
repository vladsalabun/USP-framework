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
<title>Привіт, Влад!</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo $webSiteUrl; ?>themes/<?php echo $theme;?>/css/basic4.1.css" rel="stylesheet">
    <link href="<?php echo $webSiteUrl; ?>themes/<?php echo $theme;?>/css/usefull.css" rel="stylesheet">
    <link href="<?php echo $webSiteUrl; ?>themes/<?php echo $theme;?>/css/navbar_style.css" rel="stylesheet">
    <link href="<?php echo $webSiteUrl; ?>themes/<?php echo $theme;?>/css/modal_style.css" rel="stylesheet">
    <link href="<?php echo $webSiteUrl; ?>themes/<?php echo $theme;?>/css/style.css" rel="stylesheet">
    <link href="<?php echo $webSiteUrl; ?>themes/<?php echo $theme;?>/css/links_style.css" rel="stylesheet">
    <script src="<?php echo $webSiteUrl; ?>themes/<?php echo $theme;?>/js/jQuery_v1.12.4.js"></script>
    <script src="<?php echo $webSiteUrl; ?>themes/<?php echo $theme;?>/js/fade.js"></script>
    <script src="<?php echo $webSiteUrl; ?>themes/<?php echo $theme;?>/js/bootstrap.js"></script>
</head>
<body>

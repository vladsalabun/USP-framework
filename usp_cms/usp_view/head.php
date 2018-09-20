<!DOCTYPE html>
<html>
<head>
<title>Привіт, Влад!</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<?php 
    // CSS:
    foreach ($cmsStylesArray as $cssFile) {
?>
    <link href="<?php echo $cssFile; ?>" rel="stylesheet">
<?php 
    }
    // JS:
    foreach ($cmsJsArray as $jsFile) {
?>
    <script src="<?php echo $jsFile; ?>"></script>
<?php 
    }
?>
</head>
</body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="<?php echo $webSiteUrl.$usp; ?>_cms">Головна</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
<?php 
                    foreach ($pluginsArray as $key => $value) {
                       
                        if( $value['pluginMenu'] == 'yes') {
?>                    
                        <li class="nav-item"><a class="nav-link" href="?page=plugin&name=<?php echo $value['pluginUrl']; ?>"><?php echo $value['pluginTitle']; ?></a></li>
<?php
                        }
                    }
?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Меню
            </a>
            
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="?page=plugins"><?php echo dialogs(400,$language); ?></a>
                <a class="dropdown-item" href="?page=documentation"><?php echo dialogs(401,$language); ?></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="?page=configurations">Налаштування</a>
            </div>
        </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="?page=logout">Logout</a>
            </li>
        </ul>
</div>
 


</nav>
<div id="navbar-space">
</div>

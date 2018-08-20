<!DOCTYPE html>
<html>
<head>
<title><?php echo dialogs(100,$language); ?></title>
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
  <a class="navbar-brand" href="<?php echo $webSiteUrl.$usp; ?>_cms">USP</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="?page=plugins"><?php echo dialogs(400,$language); ?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">...</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Dropdown
            </a>
            
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
<?php 
                    foreach ($pluginsArray as $key => $value) {
                       
                        if( $value['pluginMenu'] == 'yes') {
?>                    
                        <a class="dropdown-item" href="?page=plugin&name=<?php echo $value['pluginUrl']; ?>"><?php echo $value['pluginTitle']; ?></a>
<?php
                        }
                    }
?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </li>
        </ul>
    <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
</div>
</nav>
<div id="navbar-space">
</div>

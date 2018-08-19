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

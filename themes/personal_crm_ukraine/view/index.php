<?php 

   if (md5($_COOKIE['login']) === $userAdmin and md5($_COOKIE['password']) === $passwordAdmin) {
       
       $link = $webSiteUrl.$usp.'_cms';
       
       header("Location: $link");
       exit();
   }
   
?>

<div class="row margin60">
    <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 center">
            <h2 class="margin20">Привіт, Влад!</h2>
            <p>Який твій настрій сьогодні?</p>
        </div>
    </div>
</div>
<div class="row margin60">
    <div class="container center">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
        </div>
        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <form autocomplete="off" method="POST">
                   <input type="hidden" name="actionTo" value="theme">
                   <input type="hidden" name="themeFolder" value="personal_crm_ukraine">
                <p><input type="text" name="login" class="entrance"></p>
                <p><input type="password" name="password" class="entrance"></p>
                <input type="submit" name="submit" class="btn btn-success entrance-button margin20" value="Вхід">
            </form>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
        </div>
    </div>
    </div>
</div>
<?php



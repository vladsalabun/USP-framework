<div class="row margin60">
    <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 center">
            <h2 class="margin20">Привіт!</h2>
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
            <?php 
                if(isset($_GET['theme_page'])) {
                    echo 'Сторінка: '.$_GET['theme_page'];
                } else {
                    echo 'Головна сторінка';
                }
            ?>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
        </div>
    </div>
    </div>
</div>
<?php




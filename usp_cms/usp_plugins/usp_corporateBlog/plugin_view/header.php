<nav class="navbar vilet navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent1">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="">
                    Main Page
                </a>
            </li>
            <li class="nav-item active">
                <?php echo modalLink('addcategory', '+Add Category', 'nav-link'); ?>
            </li>
        </ul>
    </div>
</nav>
<style>
.vilet {
    background: #56004F !important;
}
.navbar-text {
    color: #FED570 !important;
    margin-right: 20px;
}
.modal-content {
    background: #FAFAFA;
}
</style>

<?php

  $corporateBlogCategories = getCorporateBlogCategories();
  echo '<pre>';
  print_r($corporateBlogCategories);
  echo '</pre>';

  /*
        Створюю одновимірний масив для перетворення його у дерево:
  */
  $oneDimensionalArray = array();

  // проходжусь по всім категоріям:
  foreach ($corporateBlogCategories as $categoryArray ) {
      $selectCatArray[$categoryArray['ID']] = $categoryArray['categoryName'];
      /*

          Потрібно передати масив у форматі:

          Array
            (
                  [elementID] => [parentID]
            )

      */
      $oneDimensionalArray[$categoryArray['ID']] = $categoryArray['parentCategoryID'];
  }


  echo '<pre>';
  print_r(showCategoryTree($oneDimensionalArray));
  echo '</pre>';

  unset($oneDimensionalArray);

$addCategory =
     $form->formStart()
    .$form->hidden(array('name'=> 'actionTo','value'=> 'plugin'))
    .$form->hidden(array('name'=> 'pluginFolder','value'=> 'usp_corporateBlog'))
    .$form->hidden(array('name'=> 'action','value'=> 'addCategory'))
    .p($form->text(array('name'=> 'categoryName','value'=> '','class'=>'txtfield','placeholder' => 'categoryName')))
    .p($form->text(array('name'=> 'categoryURL','value'=> '','class'=>'txtfield','placeholder' => 'categoryURL')))
    .p($form->select(array('name'=> 'parentCategoryID','value'=> $selectCatArray)))
    .p($form->submit(array('name'=> 'submit','value'=> 'Add new category','class'=>'btn')),'center')
    .$form->formEnd();


echo modalWindow('addcategory','Add Category:',$addCategory,1,1);

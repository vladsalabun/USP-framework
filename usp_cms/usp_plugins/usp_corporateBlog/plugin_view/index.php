<?php
  require_once 'header.php';
?>
<div class="row margin20">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<?php
    $tree = showCategoryTree($oneDimensionalArray);

    $linkParamArray = array(
        'url' => $pluginConfigUrl.'&plugin_config=category',
        'class' => 'categoryLinks',
    );
    echo corporateBlogCategoryTreeHTML($tree, $linkParamArray,$selectCatArray);
?>
Кожному користувачу потрібен рівень EXP в особистому кабінеті, щоб бачити прогрес.

</div>
</div>
<?php

    function corporateBlogCategoryTreeHTML($tree, $linkParamArray,$selectCatArray) {

        $string = '<ul>';
        foreach($tree as $root => $branch) {
            $string .= '<li><a href="'.$linkParamArray['url'].'&category='.$root.'" title="'.$selectCatArray[$root].'" class="'.$linkParamArray['class'].'">'.$selectCatArray[$root].'</a>';
            if (is_array($branch)) {
                $string .= corporateBlogCategoryTreeHTML($branch, $linkParamArray,$selectCatArray);
            }
            $string .= '</li>';
        }
        $string .= '</ul>';

        return $string;
    }
?>

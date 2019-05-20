<?php 
/**
 * Form Block
 */


    $format = '
        <div class="container %s">
            %s
            %s
            %s
        </div>
    ';
    $return = '';
    
    $form = do_shortcode('[wpforms id="'.$cB['content']['form']->ID.'" title="false" description="false"]');

    $return .= sprintf(
        $format
        ,( !empty($cB['options']['width']) ? $cB['options']['width'] : '' )
        ,( !empty($cB['content']['heading']) ? '<h2>'.$cB['content']['heading'].'</h2>' : '' )
        ,( !empty($cB['content']['details']) ? '<div>'.$cB['content']['details'].'</div>' : '' )
        ,$form
    );
  
?>
<section class="mod__form_block">
<?php 
    echo $return;
?>
</section>
<?php 
    unset($cB, $return, $format);
 ?>
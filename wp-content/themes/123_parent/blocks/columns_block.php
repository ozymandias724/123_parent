<?php
/**
* Columns Block
* 
* This block allows 1-3 repeater rows of flexible content layouts to be added.
* Each repeater row will represent a column on the page.
* Each flexible content layout will be a row within that column.
*/

// return string array
$return = [];
// return string
$return['section'] = '';
// return string
$return['columns'] = '';

/**
 *  if we have columns
 */ 
// get column count
$cols = count($cB['columns']);

// open section and container
$return['section'] .= '<section class="site__block block__columns"><div class="container ' . $cB['width'] . '">';


// heading + sub heading please
$return['section'] .= '<h2>'.$cB['heading'].'</h2>'.$cB['sub_heading'];

// open columns <ul>
$return['columns'] .= '<div class="site__flexgrid cols-'.$cols.'"><ul class="flexboxGrid">';

// loop thru each column
foreach ($cB['columns'] as $i => $column) {
    
    // open this column as a <li>
    $return['columns'] .= '<li>';

    // within this column, loop thru each row
    foreach ($column as $rows) {

        // within this row, loop thru the flexible content layouts
        foreach($rows as $row){

            // include content blocks...
            $cB = $row;
            
            ob_start();
            include( get_template_directory() . '/blocks/'.$row['acf_fc_layout'].'.php' );
            $return['columns'] .= ob_get_clean();

        }
    }
    // close row container
    $return['columns'] .= '</li>';
}
// close column container
$return['columns'] .= '</ul></div>';

// write columns into section
$return['section'] .= $return['columns'];

// close and echo the section
echo $return['section'] . '</div></section>';



// clear out the return strings
unset($return);


?>
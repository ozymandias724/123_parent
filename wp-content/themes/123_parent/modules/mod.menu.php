<?php 
/**
 * Module: Menu
 * 
 * Description:
 *  Concise view w/ link to full view
 */
    // get the gallery page object
    $args = array(
        'posts_per_page' => 1
        ,'post_type' => 'page'
        ,'pagename' => 'menu'
    );
    $res = get_posts($args);

    // get the gallery page fields
    $fields = get_fields($res[0]);
 ?>
<section id="mod_menu">

<?php 
    echo get_section_banner($res[0]->post_title);
?>

<div id="menu_section">
    <div id="menu_tabs_pills">
        <h3><a class="sides_tab active_tab" href="javascript:;">Sides</a></h3>
        <h3><a class="lunch_tab" href="javascript:;">Lunch</a></h3>
        <h3><a class="brunch_tab" href="javascript:;">Brunch</a></h3>
        <h3><a class="drinks_tab" href="javascript:;">Drinks</a></h3>
        <h3><a class="desserts_tab" href="javascript:;">Desserts</a></h3>
    </div>
    <!-- Menu One -->
    <div>    
        <h2 class="menu_title sides_title active_menu_title"><span>Sides</span></h2>
        <ul class="menu_list sides_list active_menu_list">
            <li>
                <h3>Chips + Guacamole<span> $6.75</span></h3>
                <p>Avocado, tomato, onion, cilantro, serrano chili, avocado, tomato, cilantro, serrano chili</p>
            </li>
            <li>
                <h3>Chips + Guacamole<span> $6.75</span></h3>
                <p>Avocado, tomato, onion, cilantro, serrano chili, avocado, tomato, cilantro, serrano chili</p>
            </li>
            <li>
                <h3>Chips + Guacamole<span> $6.75</span></h3>
                <p>Avocado, tomato, onion, cilantro, serrano chili, avocado, tomato, cilantro, serrano chili</p>
            </li>
            <li>
                <h3>Chips + Guacamole<span> $6.75</span></h3>
                <p>Avocado, tomato, onion, cilantro, serrano chili, avocado, tomato, cilantro, serrano chili</p>
            </li>
        </ul>
        <h2 class="menu_title lunch_title"><span>Lunch</span></h2>
        <ul class="menu_list lunch_list">
            <li>
                <h3>Lunch + Guacamole<span> $6.75</span></h3>
                <p>Avocado, tomato, onion, cilantro, serrano chili, avocado, tomato, cilantro, serrano chili</p>
            </li>
            <li>
                <h3>Lunch + Guacamole<span> $6.75</span></h3>
                <p>Avocado, tomato, onion, cilantro, serrano chili, avocado, tomato, cilantro, serrano chili</p>
            </li>
            <li>
                <h3>Lunch + Guacamole<span> $6.75</span></h3>
                <p>Avocado, tomato, onion, cilantro, serrano chili, avocado, tomato, cilantro, serrano chili</p>
            </li>
            <li>
                <h3>Lunch + Guacamole<span> $6.75</span></h3>
                <p>Avocado, tomato, onion, cilantro, serrano chili, avocado, tomato, cilantro, serrano chili</p>
            </li>
        </ul>
    </div>
    <!-- /Menu One -->
</div>

</section>
<?php 
 ?>
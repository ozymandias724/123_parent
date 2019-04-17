<?php 
/**
 * Module: Menu
 * 
 * Description:
 *  Concise view w/ link to full view
 */
    // get the menu page object
    $args = array(
        'posts_per_page' => 1
        ,'post_type' => 'page'
        ,'pagename' => 'menu'
    );
    $res = get_posts($args);

    // get the menu page fields
    $fields = get_fields($res[0]);
 ?>
<section id="mod_menu">

<?php 
    echo get_section_banner($res[0]->post_title);
?>

<?php
    $menu_tabs = "menu_tabs_side_menu"; 
    $menu_type = "menu_two";
?>
    <!-- Menu Area -->
    <div id="menu_area" class="<?php echo ($menu_tabs == 'menu_tabs_side_menu') == true ? 'menu_flex' : ''; ?>">
        <!-- Menu -->
        <?php if($menu_tabs == "menu_tabs_pills"){ ?>
        <div id="menu_tabs_pills">
            <h3><a class="sides_tab active_tab" href="javascript:;">Sides</a></h3>
            <h3><a class="lunch_tab" href="javascript:;">Lunch</a></h3>
            <h3><a class="brunch_tab" href="javascript:;">Brunch</a></h3>
            <h3><a class="drinks_tab" href="javascript:;">Drinks</a></h3>
            <h3><a class="desserts_tab" href="javascript:;">Desserts</a></h3>
        </div>
        <?php } else if($menu_tabs == "menu_tabs_side_menu"){ ?>
        <div id="menu_tabs_side_menu">
            <h3><a class="sides_tab active_tab" href="javascript:;">Sides</a></h3>
            <h3><a class="lunch_tab" href="javascript:;">Lunch</a></h3> 
            <h3><a class="brunch_tab" href="javascript:;">Brunch</a></h3>
            <h3><a class="drinks_tab" href="javascript:;">Drinks</a></h3>
            <h3><a class="desserts_tab" href="javascript:;">Desserts</a></h3>
        </div>
        <?php } ?>
        <?php if($menu_type == "menu_one"){ ?>
        <!-- Menu List -->
        <div id="menu_one">    
            <h2 class="menu_title sides_title active_menu_title"><span>Sides</span></h2>
            <ul class="menu_section sides_section active_menu_section">
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
            <ul class="menu_section lunch_section">
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
        <!-- /Menu List -->
        <?php }else if($menu_type == "menu_two"){ ?>
        <!-- Menu List -->
        <div id="menu_two">    
            <h2 class="menu_title sides_title active_menu_title"><span>Sides Menu</span></h2>
            <h3 class="menu_subtitle sides_subtitle active_menu_subtitle"><span>Sides Available until 5pm Saturday &#38; Sunday</span></h3>
            <ul class="menu_section sides_section active_menu_section">
                <li>
                    <h3>Coal Fired Blue Hubbard Pumpkin<span> 11</span></h3>
                    <p>Pumpkin kosho butter &#38; fried pumpkin seeds</p>
                </li>
                <li>
                    <h3>Coal Fired Blue Hubbard Pumpkin<span> 12</span></h3>
                    <p>Pumpkin kosho butter &#38; fried pumpkin seeds</p>
                </li>
                <li>
                    <h3>Coal Fired Blue Hubbard Pumpkin<span> 10</span></h3>
                    <p>Pumpkin kosho butter &#38; fried pumpkin seeds</p>
                </li>
                <li>
                    <h3>Coal Fired Blue Hubbard Pumpkin<span> 9</span></h3>
                    <p>Pumpkin kosho butter &#38; fried pumpkin seeds</p>
                </li>
            </ul>
            <h2 class="menu_title lunch_title"><span>Lunch Menu</span></h2>
            <h3 class="menu_subtitle lunch_subtitle"><span>Lunch Available until 5pm Saturday &#38; Sunday</span></h3>
            <ul class="menu_section lunch_section">
                <li>
                    <h3>Coal Fired Blue Hubbard Pumpkin<span> 11</span></h3>
                    <p>Pumpkin kosho butter &#38; fried pumpkin seeds</p>
                </li>
                <li>
                    <h3>Coal Fired Blue Hubbard Pumpkin<span> 12</span></h3>
                    <p>Pumpkin kosho butter &#38; fried pumpkin seeds</p>
                </li>
                <li>
                    <h3>Coal Fired Blue Hubbard Pumpkin<span> 10</span></h3>
                    <p>Pumpkin kosho butter &#38; fried pumpkin seeds</p>
                </li>
                <li>
                    <h3>Coal Fired Blue Hubbard Pumpkin<span> 9</span></h3>
                    <p>Pumpkin kosho butter &#38; fried pumpkin seeds</p>
                </li>
            </ul>
        </div>
        <!-- /Menu List -->
        <?php } ?>
        <!-- /Menu -->
    </div>
    <!-- /Menu Area -->
</section>
<?php 
 ?>
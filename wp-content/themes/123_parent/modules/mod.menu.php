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
    $menu_tabs = 'menu_tabs_pills'; 
    $menu_type = 'menu_four';
?>
    <!-- Menu Area -->
    <div id="menu_area" class="<?php echo ($menu_tabs == 'menu_tabs_side_menu') == true ? 'menu_flex' : ''; ?>">
        <!-- Menu -->
        <?php if($menu_tabs == 'menu_tabs_pills'){ ?>
        <div id="menu_tabs_pills">
            <h3><a class="sides_tab active_tab grid-item" href="javascript:;">Sides</a></h3>
            <h3><a class="lunch_tab grid-item" href="javascript:;">Lunch</a></h3>
            <h3><a class="brunch_tab grid-item" href="javascript:;">Brunch</a></h3>
            <h3><a class="drinks_tab grid-item" href="javascript:;">Drinks</a></h3>
            <h3><a class="desserts_tab grid-item" href="javascript:;">Desserts</a></h3>
        </div>
        <?php } else if($menu_tabs == 'menu_tabs_side_menu'){ ?>
        <div id="menu_tabs_side_menu">
            <h3><a class="sides_tab active_tab" href="javascript:;">Sides</a></h3>
            <h3><a class="lunch_tab" href="javascript:;">Lunch</a></h3> 
            <h3><a class="brunch_tab" href="javascript:;">Brunch</a></h3>
            <h3><a class="drinks_tab" href="javascript:;">Drinks</a></h3>
            <h3><a class="desserts_tab" href="javascript:;">Desserts</a></h3>
        </div>
        <?php } ?>
        <?php if($menu_type == 'menu_one'){ ?>
        <!-- Menu List -->
        <div id="menu_one">    
            <h2 class="menu_title sides_title active_menu_title"><span>Sides</span></h2>
        <?php }else if($menu_type == 'menu_two'){ ?>
        <div id="menu_two">    
            <h2 class="menu_title sides_title active_menu_title">Sides Menu</h2>
            <h3 class="menu_subtitle sides_subtitle active_menu_subtitle">Sides Available until 5pm Saturday &#38; Sunday</h3>
        <?php }else if($menu_type == 'menu_three'){ ?>
        <div id="menu_three">
            <h2 class="menu_title sides_title active_menu_title">Sides Menu</h2>
            <h3 class="menu_subtitle sides_subtitle active_menu_subtitle">Sides Available until 5pm Saturday &#38; Sunday</h3>
        <?php }else if($menu_type == 'menu_four'){ ?>
        <div id="menu_four">
            <h2 class="menu_title sides_title active_menu_title">Sides Menu</h2>
            <h3 class="menu_subtitle sides_subtitle active_menu_subtitle">Sides Available until 5pm Saturday &#38; Sunday</h3>
        <?php } 
        if($menu_type == 'menu_one' || $menu_type == 'menu_two' || $menu_type == 'menu_three'){ ?>
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
        <?php }else if($menu_type == 'menu_four'){ ?>
            <ul class="menu_section sides_section active_menu_section">
                <li>
                    <?php 
                    $price = 6.75; 
                    $price_array = explode('.',$price);
                    ?>
                    <div class="menu_image" style="background-image:url(http://123parent.localhost/wp-content/uploads/2019/04/WGC-Calabrian-Chili-Pasta-2-copy-2.jpg);"></div>
                    <h3>Create a Sampler <div>$<?php echo $price_array[0] . '.<span>' . $price_array[1] . '</span>'; ?></div></h3>
                    <p>Avocado, tomato, onion, cilantro, serrano chili, avocado, tomato, cilantro, serrano chili</p>
                </li>
                <li>
                    <div class="menu_image" style="background-image:url(http://123parent.localhost/wp-content/uploads/2019/04/WGC-Calabrian-Chili-Pasta-2-copy-2.jpg);"></div>
                    <h3>Create a Sampler <div>$<?php echo $price_array[0] . '.<span>' . $price_array[1] . '</span>'; ?></div></h3>
                    <p>Avocado, tomato, onion, cilantro, serrano chili, avocado, tomato, cilantro, serrano chili</p>
                </li>
                <li>
                    <div class="menu_image" style="background-image:url(http://123parent.localhost/wp-content/uploads/2019/04/WGC-Calabrian-Chili-Pasta-2-copy-2.jpg);"></div>
                    <h3>Create a Sampler <div>$<?php echo $price_array[0] . '.<span>' . $price_array[1] . '</span>'; ?></div></h3>
                    <p>Avocado, tomato, onion, cilantro, serrano chili, avocado, tomato, cilantro, serrano chili</p>
                </li>
                <li>
                    <div class="menu_image" style="background-image:url(http://123parent.localhost/wp-content/uploads/2019/04/WGC-Calabrian-Chili-Pasta-2-copy-2.jpg);"></div>
                    <h3>Create a Sampler <div>$<?php echo $price_array[0] . '.<span>' . $price_array[1] . '</span>'; ?></div></h3>
                    <p>Avocado, tomato, onion, cilantro, serrano chili, avocado, tomato, cilantro, serrano chili</p>
                </li>
                <li>
                    <div class="menu_image" style="background-image:url(http://123parent.localhost/wp-content/uploads/2019/04/WGC-Calabrian-Chili-Pasta-2-copy-2.jpg);"></div>
                    <h3>Create a Sampler <div>$<?php echo $price_array[0] . '.<span>' . $price_array[1] . '</span>'; ?></div></h3>
                    <p>Avocado, tomato, onion, cilantro, serrano chili, avocado, tomato, cilantro, serrano chili</p>
                </li>
                <li>
                    <div class="menu_image" style="background-image:url(http://123parent.localhost/wp-content/uploads/2019/04/WGC-Calabrian-Chili-Pasta-2-copy-2.jpg);"></div>
                    <h3>Create a Sampler <div>$<?php echo $price_array[0] . '.<span>' . $price_array[1] . '</span>'; ?></div></h3>
                    <p>Avocado, tomato, onion, cilantro, serrano chili, avocado, tomato, cilantro, serrano chili</p>
                </li>
            </ul>
        <?php } 
        if($menu_type == 'menu_one'){ ?>
            <h2 class="menu_title lunch_title"><span>Lunch</span></h2>
        <?php }else if($menu_type == 'menu_two'){ ?>
            <h2 class="menu_title lunch_title"><span>Lunch Menu</span></h2>
            <h3 class="menu_subtitle lunch_subtitle">Lunch Available until 5pm Saturday &#38; Sunday</h3>
        <?php }else if($menu_type == 'menu_three'){ ?>
            <h2 class="menu_title lunch_title">Lunch Menu</h2>
            <h3 class="menu_subtitle lunch_subtitle">Lunch Available until 5pm Saturday &#38; Sunday</h3>
        <?php }else if($menu_type == 'menu_four'){ ?>
            <h2 class="menu_title lunch_title">Lunch Menu</h2>
            <h3 class="menu_subtitle lunch_subtitle">Lunch Available until 5pm Saturday &#38; Sunday</h3>
        <?php } 
        if($menu_type == 'menu_one' || $menu_type == 'menu_two' || $menu_type == 'menu_three'){ ?>
            <ul class="menu_section lunch_section">
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
        <?php }else if($menu_type == 'menu_four'){ ?>
            <ul class="menu_section lunch_section">
                <li>
                    <?php 
                    $price = 6.75; 
                    $price_array = explode('.',$price);
                    ?>
                    <div class="menu_image" style="background-image:url(http://123parent.localhost/wp-content/uploads/2019/04/WGC-Calabrian-Chili-Pasta-2-copy-2.jpg);"></div>
                    <h3>Create a Sampler <div>$<?php echo $price_array[0] . '.<span>' . $price_array[1] . '</span>'; ?></div></h3>
                    <p>Avocado, tomato, onion, cilantro, serrano chili, avocado, tomato, cilantro, serrano chili</p>
                </li>
                <li>
                    <div class="menu_image" style="background-image:url(http://123parent.localhost/wp-content/uploads/2019/04/WGC-Calabrian-Chili-Pasta-2-copy-2.jpg);"></div>
                    <h3>Create a Sampler <div>$<?php echo $price_array[0] . '.<span>' . $price_array[1] . '</span>'; ?></div></h3>
                    <p>Avocado, tomato, onion, cilantro, serrano chili, avocado, tomato, cilantro, serrano chili</p>
                </li>
                <li>
                    <div class="menu_image" style="background-image:url(http://123parent.localhost/wp-content/uploads/2019/04/WGC-Calabrian-Chili-Pasta-2-copy-2.jpg);"></div>
                    <h3>Create a Sampler <div>$<?php echo $price_array[0] . '.<span>' . $price_array[1] . '</span>'; ?></div></h3>
                    <p>Avocado, tomato, onion, cilantro, serrano chili, avocado, tomato, cilantro, serrano chili</p>
                </li>
                <li>
                    <div class="menu_image" style="background-image:url(http://123parent.localhost/wp-content/uploads/2019/04/WGC-Calabrian-Chili-Pasta-2-copy-2.jpg);"></div>
                    <h3>Create a Sampler <div>$<?php echo $price_array[0] . '.<span>' . $price_array[1] . '</span>'; ?></div></h3>
                    <p>Avocado, tomato, onion, cilantro, serrano chili, avocado, tomato, cilantro, serrano chili</p>
                </li>
                <li>
                    <div class="menu_image" style="background-image:url(http://123parent.localhost/wp-content/uploads/2019/04/WGC-Calabrian-Chili-Pasta-2-copy-2.jpg);"></div>
                    <h3>Create a Sampler <div>$<?php echo $price_array[0] . '.<span>' . $price_array[1] . '</span>'; ?></div></h3>
                    <p>Avocado, tomato, onion, cilantro, serrano chili, avocado, tomato, cilantro, serrano chili</p>
                </li>
                <li>
                    <div class="menu_image" style="background-image:url(http://123parent.localhost/wp-content/uploads/2019/04/WGC-Calabrian-Chili-Pasta-2-copy-2.jpg);"></div>
                    <h3>Create a Sampler <div>$<?php echo $price_array[0] . '.<span>' . $price_array[1] . '</span>'; ?></div></h3>
                    <p>Avocado, tomato, onion, cilantro, serrano chili, avocado, tomato, cilantro, serrano chili</p>
                </li>
            </ul>
        <?php } ?>
        </div>
        <!-- /Menu List -->
    </div>
    <!-- /Menu Area -->
</section>
<?php 
 ?>
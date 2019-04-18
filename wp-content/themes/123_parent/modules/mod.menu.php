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
    $menu_type = 'menu_six';
?>
    <!-- Menu Area -->
    <div id="menu_area" class="<?php echo ($menu_tabs == 'menu_tabs_side_menu') == true ? 'menu_flex' : ''; ?>">
        <!-- Menu -->
        <?php if($menu_tabs == 'menu_tabs_pills' || $menu_tabs == 'menu_tabs_side_menu'){ ?>
        <div id="<?php echo $menu_tabs; ?>">
            <h3><a class="sides_tab active_tab grid-item" href="javascript:;">Sides</a></h3>
            <h3><a class="lunch_tab grid-item" href="javascript:;">Lunch</a></h3>
            <h3><a class="brunch_tab grid-item" href="javascript:;">Brunch</a></h3>
            <h3><a class="drinks_tab grid-item" href="javascript:;">Drinks</a></h3>
            <h3><a class="desserts_tab grid-item" href="javascript:;">Desserts</a></h3>
        </div>
        <?php } ?>
        <div id="<?php echo $menu_type; ?>"> 
        <?php for($x = 0; $x < 2; $x++){ ?>
        <!-- If Menu One -->
        <?php if($menu_type == 'menu_one'){ ?>  
            <h2 class="menu_title <?php echo ($x == 0) ? ' sides_title active_menu_title':'lunch_title';?>"><span><?php echo ($x == 0) ? 'Sides' : 'Lunch';?></span></h2>
        <!-- If Menu Two, Three, Four or Six -->
        <?php }else if($menu_type == 'menu_two' || $menu_type == 'menu_three' || $menu_type == 'menu_four' || $menu_type == 'menu_six'){ ?>   
            <h2 class="menu_title <?php echo ($x == 0) ? ' sides_title active_menu_title':'lunch_title';?>"><?php echo ($x == 0) ? 'Sides' : 'Lunch';?> Menu</h2>
            <h3 class="menu_subtitle <?php echo ($x == 0) ? ' sides_subtitle active_menu_subtitle':'lunch_subtitle';?>"><?php echo ($x == 0) ? 'Sides' : 'Lunch';?> Available until 5pm Saturday &#38; Sunday</h3>
        <?php } ?>
        <!-- If Menu One, Two or Three -->
        <?php if($menu_type == 'menu_one' || $menu_type == 'menu_two' || $menu_type == 'menu_three'){ ?>
            <ul class="menu_section <?php echo ($x == 0) ? ' sides_section active_menu_section':'lunch_section'?>">
            <?php for($i = 0; $i < 4; $i++){ ?>
                <li>
                    <h3>Chips + Guacamole<span> $6.75</span></h3>
                    <p>Avocado, tomato, onion, cilantro, serrano chili, avocado, tomato, cilantro, serrano chili</p>
                </li>
            <?php }?>
            </ul>
        <!-- If Menu Four -->
        <?php }else if($menu_type == 'menu_four'){ ?>
            <ul class="menu_section <?php echo ($x == 0) ? ' sides_section active_menu_section':'lunch_section'?>">
            <?php for($i = 0; $i < 6; $i++){ 
                    $price = 6.75; 
                    $price_array = explode('.',$price); ?>
                <li>
                    <div class="menu_image" style="background-image:url(http://123parent.localhost/wp-content/uploads/2019/04/WGC-Calabrian-Chili-Pasta-2-copy-2.jpg);"></div>
                    <h3>Create a Sampler <div>$<?php echo $price_array[0] . '.<span>' . $price_array[1] . '</span>'; ?></div></h3>
                    <p>Avocado, tomato, onion, cilantro, serrano chili, avocado, tomato, cilantro, serrano chili</p>
                </li>
            <?php }?>
            </ul>
        <!-- If Menu Six -->
        <?php }else if($menu_type == 'menu_six'){ ?>
            <ul class="menu_section <?php echo ($x == 0) ? ' sides_section active_menu_section':'lunch_section'?>">
            <?php for($i = 0; $i < 3; $i++){ ?>
                <li>
                    <div class="menu_image" style="background-image:url(http://123parent.localhost/wp-content/uploads/2019/04/WGC-Calabrian-Chili-Pasta-2-copy-2.jpg);"></div>
                    <div>
                        <h3>Coal Fired Blue Hubbard</h3>
                        <p>Avocado, tomato, onion, cilantro, serrano chili, avocado, tomato, cilantro, serrano chili</p>
                        <h4>$6.75</h4>
                    </div>  
                </li>
            <?php }?>
            </ul>            
        <?php }
        } ?>
        </div>
        <!-- /Menu List -->
    </div>
    <!-- /Menu Area -->
</section>
<?php 
 ?>
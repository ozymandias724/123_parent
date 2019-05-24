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
        ,'pagename' => 'about'
    );
    // get the post object for the about page
    $res = get_posts($args);

    // get the gallery page fields
    $fields = get_fields($res[0]);

    // if we have staff members
    if( !empty($fields['staff_members']) ){
        $return_staff = '';
        $format_staff = '
            <li class="site__fade site__fade-up">
                <a href="%s">
                    <div class="image site__bgimg site__bgimg--zoom site__bgimg--gradient"><div style="background-image: url(%s)" class="site__bgimg_img"></div></div>
                    <h5>%s</h5>
                </a>
            </li>
        ';
        // loop thru the staff members (post objects)
        foreach ($fields['staff_members'] as $i => $rec) {
            // get the fields of each staff member post object
            $rec_fields = get_fields($rec['staff_member']->ID);
            // if the staff member status is active
            if( $rec_fields['status'] ){
                $return_staff .= sprintf(
                    $format_staff
                    ,get_permalink($rec['staff_member']->ID)
                    ,$rec_fields['image']['url']
                    ,$rec['staff_member']->post_title
                );
            }
        }
    } else {
        $return_staff = '';
    }
    
    // company bio
    if( !empty($fields['company_bio']) ){

        $heading = ( !empty( $fields['company_bio']['heading'] ) ? '<h2 class="site__fade site__fade-up">'.$fields['company_bio']['heading'].'</h2>' : '');
        $details = ( !empty( $fields['company_bio']['details'] ) ? '<div class="site__fade site__fade-up">'.$fields['company_bio']['details'].'</div>' : '');
        $return_company = '';
        $return_company = '
            <section class="mod__featured_grid">
                <div class="container">
                    '.$heading.'
                    '.$details.'
                    <div class="site__grid"><ul>
                        '.$return_staff.'
                    </ul></div>
                    <a href="'.get_permalink($res[0]->ID).'" title="View all Staff Members" class="site__button site__fade site__fade-up">View All Staff Members</a>
                </div>
            </section>
        ';
    }
 ?>
<section id="mod_about">
<?php 
    echo get_section_banner($res[0]->post_title);
    echo $return_company;
 ?>
</section>
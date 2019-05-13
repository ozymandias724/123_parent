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

    // company bio
    if( !empty($fields['company_bio']) ){


        $format_company = '
            <section class="mod__featured_grid">
                <div class="container">
                    <h2>%s</h2>
                    <div>
                        <p>%s</p>
                    </div>
                </div>
            </section>
        ';

        $return_company = '';
        $return_company .= sprintf(
            $format_company
            ,$fields['company_bio']['heading']
            ,$fields['company_bio']['details']
        );

    }
    // if we have staff members
    if( !empty($fields['staff_members']) ){

        $return_staff = '<div class="container"><div class="site__grid"><ul>';
        // format string for staff member
        $format_staff = '
            <li>
                <div class="image" style="background-image: url(%s)"></div>
                <h5>%s</h5>
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
                    ,$rec_fields['image']['url']
                    ,$rec['staff_member']->post_title
                );
            }
        }
        // close return_staff[0] string for staff members grid
        $return_staff .= '</ul></div>';
        $return_staff .= '
            <a href="'.get_permalink($res[0]->ID).'" title="View all Staff" class="site__button">View All Staff</a></div>
        ';
    }
    
 ?>
<section id="mod_about">
<?php 
    echo get_section_banner($res[0]->post_title);

    echo $return_company;
    echo $return_staff;
 ?>
</section>
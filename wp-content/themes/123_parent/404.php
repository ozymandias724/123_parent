<?php 
/**
*  404 Page
*/


    $return = '
        <section class="page_404">
            <div class="container medium site__fade site__fade-up">
                <h1>404</h1>
                <h2>Sorry! Page Not Found!</h2>
                <a class="page404_home site__button" href="'.get_site_url().'" title="Home link">Go to Home</a>
            </div>
        </section>
    ';

    get_header();
?>
<main class="page404">

<?php 
    echo $return;
?>

</main>
<?php get_footer(); ?>
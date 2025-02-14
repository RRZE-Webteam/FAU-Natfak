<?php
/**
 * The template for displaying all pages.
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */

global $is_sidebar_active;
get_header(); 


$ancestors = get_post_ancestors( $post->ID );
$children = get_pages( array(
    'child_of' => $post->ID,
    'post_status' => 'publish' // Optional: Nur veröffentlichte Seiten anzeigen
) );

$subnav = true;
if (empty($ancestors) && empty($children) ) {
    // Keine Subnav anzeigen
    $subnav = false;
}
    
while ( have_posts() ) : the_post(); ?>
	<div id="content"<?php if($subnav) {echo ' class="subnav"';}?>>
	    <div class="content-container">			
            <div class="content-row">	
                <?php if($subnav) { 
                    echo fau_get_page_subnav($post->ID); 		
                    echo '<div class="entry-content">';
                } ?>
                <main<?php echo fau_get_page_langcode($post->ID);?>>
                    <h1 id="maintop" class="screen-reader-text"><?php the_title(); ?></h1>
                    <?php 
                    $headline = get_post_meta( $post->ID, 'headline', true );									
                    if (!fau_empty($headline)) {
                        echo '<p class="subtitle">'.$headline.'</p>'; 					    
                    } ?>
                    <div class="inline-box">					   	
                        <?php get_template_part('template-parts/sidebar', 'inline'); ?>
                        
                        <div class="content-inline<?php if ($is_sidebar_active) { echo " with-sidebar"; }?>"> 
<?php 
the_content(); 
echo wp_link_pages($pagebreakargs);	
?>
                        </div>
                    </div>
                </main>    
                  <?php   get_template_part('template-parts/content', 'imagelink');  	?>					    
             
              <?php if($subnav) { 
                  echo '</div>';
              }	?>	
            </div>
	    </div>
	</div>
	
	
<?php endwhile; 
get_footer(); 
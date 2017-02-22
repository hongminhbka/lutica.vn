<?php get_header(); ?>

<?php
$st_faq_sidebar = of_get_option('st_faq_sidebar');
$st_sidebar_class = 'sidebar-right';
if ( !is_active_sidebar( 'ht_faq' ) ) :

  if ($st_faq_sidebar == 'fullwidth') :
    $st_sidebar_class = 'sidebar-off';
  elseif ($st_faq_sidebar == 'sidebar-l') : 
    $st_sidebar_class = 'sidebar-left';
  elseif ($st_faq_sidebar == 'sidebar-r') :  
    $st_sidebar_class = 'sidebar-right';
  endif;

endif;
?>

<!-- #primary -->
<div id="primary" class="clearfix <?php echo $st_sidebar_class ?>"> 
<!-- .container -->
<div class="container">

<!-- #content -->
  <section id="content" role="main">
  
  <header id="page-header" class="clearfix">
  <h1 class="page-title"><?php _e('Frequently Asked Questions','framework') ?></h1>
  <?php st_breadcrumb(); ?>
  </header>
  
   <?php	$args = array(
					'post_type' => 'st_faq',
					'posts_per_page' => '-1',
					'orderby ' => 'menu_order',
					'order' => 'ASC'
				);
				$wp_query = new WP_Query($args);
				if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); ?>
                
                <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
                
                <h2 id="faq-<?php echo get_the_ID(); ?>" class="entry-title">
                <a href="#faq-<?php echo get_the_ID(); ?>">
				<div class="action"><span class="plus"><i class="fa fa-plus"></i></span><span class="minus"><i class="fa fa-minus"></i></span></div>
				<?php the_title(); ?></a></h2>
                
                <div class="entry-content">
                <?php the_content(); ?>
                </div>
                
                </article>
     
      <?php endwhile; endif; ?>

  </section>
  <!-- #content -->
 
<?php if (of_get_option('st_faq_sidebar') != 'fullwidth') {   ?>
<?php get_sidebar('faq'); ?>
<?php } ?>

</div>
<!-- .container --> 
</div>
<!-- #primary -->

<?php get_footer(); ?>
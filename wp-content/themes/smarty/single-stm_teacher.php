<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
	<?php get_template_part( 'parts/page', 'title' ); ?>
    <?php get_template_part( 'parts/page', 'breadcrumbs' ); ?>
    <div class="content">
		<div class="container">
			<main class="main">
				<div id="teacher-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php the_content(); ?>
				</div>
			</main><!-- /Main -->
		</div>
	</div><!-- /Content -->
<?php endwhile; ?>
<?php get_footer(); ?>
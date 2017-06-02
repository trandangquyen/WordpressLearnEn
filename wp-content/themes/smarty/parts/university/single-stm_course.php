<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
	<?php get_template_part( 'parts/page', 'title' ); ?>
	<div class="content">
		<div class="container">
			<main class="main">
				<article id="course-<?php the_ID(); ?>">
					<?php the_content(); ?>
				</article>
			</main><!-- /Main -->
			</div>
		</div><!-- /Container -->
	</div><!-- /Content -->
<?php endwhile; ?>
<?php get_footer(); ?>
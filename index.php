<?php
	get_header();
?>
<!--Site Content -->
<div class="site-content clearfix">
	<!-- main-column -->
	<div class="main-column">
		<?php
			if(have_posts()):
		while (have_posts()): the_post();?>
		<article class="post">
			<!--<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>-->
			<?php 
				if($post->post_excerpt){
				?>

				<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
								<p class="post-info"><?php the_time('F j, Y g:i a'); ?> | by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a> | Posted in
				<?php

			$categories = get_the_category();
			$separator = ", ";
			$output = '';

			if ($categories) {

				foreach ($categories as $category) {

					$output .= '<a href="' . get_category_link($category->term_id) . '">' . $category->cat_name . '</a>'  . $separator;

				}

				echo trim($output, $separator);

			}
			?>
			</p>
				<?php	echo get_the_excerpt();?>
				<a href="<?php the_permalink();?>">Read More&raquo;</a><?php
				}
				else{
					get_template_part('content');
				}
				
			?>
			<?php //the_excerpt();
			?>
		</article>
		<?php
			endwhile;
			else :
			echo '<p>No content found</p>';
		endif;?>
	</div><!--/main column -->
	<?php get_sidebar();?>
	<?php
	get_footer();
	?>	
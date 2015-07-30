<?php
/**
	* The template for displaying posts in the gallery post format
 * @since nomagic 1.0
 */
?>
<article class="post post-gallery">
	
	<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<?php the_content(); ?>
	
</article>
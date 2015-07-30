<?php
	get_header();
	if(have_posts()):
while (have_posts()): the_post();?>
	
	<?php the_content();?>

<?php
	endwhile;
	else :
	echo '<p>N content found</p>';
	endif;
	get_footer();
?>
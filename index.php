<?php get_header();?>

	<div class="container main-home-page">
	<div class="row">


		<?php


		if(have_posts()){//check if there's posts
		while(have_posts()){//loop throught posts
			
			the_post();?>
			
						<div class="col-sm-12">
						<div class="main-post">
						<h3 class="post-title">
						<a href="<?php the_permalink();?>">

						<?php the_title();?>
						</a>
						</h3>
						<span class="post-author">
						<i class="fas fa-user fa-fw "></i><?php the_author_posts_link();?>
						</span>
                        <span class="post-date">
						<i class="fas fa-calendar fa-fw "></i><?php the_time('F j,Y')?>
						</span>
						<span class="post-comments">
						<i class="fas fa-comments fa-fw "></i>
						<?php comments_popup_link('0 comments','1 comment','% comments','comments_url','comments disabled')?>
						</span>
						
						<?php the_post_thumbnail('',['class'=>'img-responsive img-thumbnail ','title'=>'post-image'])?>
						<hr>
						<div class="post-content">
						<?php the_excerpt()?>
						</div>
						
                        <p class="post-categories"> 
						<i class="fas fa-tags fa-fw "></i>
						<?php the_category(',')?>
						</p>
						<p class="post-tags">
							<?php
if(has_tag()){
 the_tags();
}else{
echo'Tags=null';
}
?>
						</p>
				

						</div>
						</div>
						<?php
			
			
			
		}//end while loop
			
		}//end if condition
echo'<div class="clearfix"></div>';//fix float clear

/*
echo'<div class="post-paginat">';
if(get_previous_posts_link()){
previous_posts_link('<i class="fas fa-chevron-left fa-fw fa-lg"></i>Prev');
}else{
echo'<span class="prev-span">prev</span>';
}
if(get_next_posts_link()){
next_posts_link('Next<i class="fas fa-chevron-right fa-fw fa-lg "></i>');
}else{
echo'<span class="next-span">next</span> ';
}
echo'</div>';*/
		
		
//echo pagination_numbers();
		?>
		<?php get_pagination(); ?>
	</div>
	</div>
	
	<!--






-->


<?php get_footer();?>
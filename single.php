<?php get_header();?>

	<div class="container single-home-page">
	


		<?php


		if(have_posts()){//check if there's posts
		while(have_posts()){//loop throught posts
			
			the_post();?>
			
					
						<div class="main-post single-post">
						<?php edit_post_link('Edit <i class="fas fa-pen"></i>')?>
						<h3 class="post-title">
						<a href="<?php the_permalink();?>">

						<?php the_title();?>
						</a>
						</h3>
						<span class="post-author">
						<i class="far fa-user fa-fw "></i><?php the_author_posts_link();?>
						</span>
                        <span class="post-date">
						<i class="far fa-calendar fa-fw "></i><?php the_time('F j,Y')?>
						</span>
						<span class="post-comments">
						<i class="far fa-comments fa-fw "></i>
						<?php comments_popup_link('0 comments','1 comment','% comments','comments_url','comments disabled')?>
						</span>
						
						<?php the_post_thumbnail('',['class'=>'img-responsive img-thumbnail ','title'=>'post-image'])?>
						
						<hr>
						<div class="post-content">
						<?php the_content()?>
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
						
						<?php
			
			
			
		}//end while loop
			
		}//end if condition
		
echo'<div class="clearfix"></div>';//fix float clear 

//get post id=> get_queried_object_id()

//Categories id's => wp_get_post_categories(get_queried_object_id())


$random_posts_arguments=array(
'posts_per_page'=>2,
'orderby'=>'rand',
'category'=>wp_get_post_categories(get_queried_object_id()),
'post__not_in'=>array(get_queried_object_id())
);
 
 $random_posts=new WP_Query($random_posts_arguments);
 if($random_posts->have_posts()){
	 while($random_posts->have_posts()){
		 
		 $random_posts->the_post()?>
		 
		 <div class="author-posts">
		 <h3>
		 <a href="<?php the_permalink()?>">
		 <?php the_title()?>
		 </a>
		 </h3>
		 </hr>
		  </div>
		 <?php
	 }
 }

?>


<!-- Start backgrond autuor -->
<div class="back-author">
<div class="row">

<div class="col-md-2">
<?php 
$avatar_arguments= array(
'class'=> 'img-responsive img-thumbnail center-block'
);

echo get_avatar(get_the_author_meta('ID'),150,'','user avatar',$avatar_arguments)

?>
</div>

<div class="col-md-10 author-info">
<h4>
<?php the_author_meta('first_name')?> 
<?php the_author_meta('last_name')?> 
(<span class="nickname"><?php the_author_meta('nickname')?></span>)
</h4>

<?php if (get_the_author_meta('description')){?>
<p><?php the_author_meta('description')?></p>
<?php }else{
	echo'no description';
}
?>
</div>
</div>
<hr>

<p class="author-stats">
user posts count:<span class="author-posts-count" ><?php echo count_user_posts(get_the_author_meta('ID'))?></span>,
user profile link:<?php the_author_posts_link()?>
</p>

</div>
<!-- end backgrond autuor -->
<?php
echo'<hr class="comments-separator">';
echo'<div class="post-paginat">';
if(get_previous_post_link()){//check if previous post exist
previous_post_link('%link','<i class="fas fa-chevron-left fa-fw fa-lg"></i> Previous article: %title');
}else{
echo'<span class="prev-span">prev</span>';
}
if(get_next_post_link()){//check if next post exist
next_post_link('%link','Next article: %title <i class="fas fa-chevron-right fa-fw fa-lg"></i> ');
}else{
echo'<span class="next-span">next</span> ';
}
echo'</div>';
		echo'<hr class="comments-separator">';
		
		comments_template();

		?>
	
	</div>
	
	<!--






-->


<?php get_footer();?>
<?php get_header();?>
<div class="container author-page">
<h1 class="profile-header text-center">
<?php the_author_meta('nickname')?>
</h1>
<div class="author-main-info">
<!--start row -->
<div class="row">
<div class="col-sm-3">
<?php 
$avatar_arguments= array(
'class'=> 'img-responsive img-thumbnail center-block'
);

echo get_avatar(get_the_author_meta('ID'),150,'','user avatar',$avatar_arguments)

?>
</div>
<div class="col-sm-9">
<ul class="author-names list-unstyled">
<li><span>First Name:</span> <?php the_author_meta('first_name')?> </li>
<li><span>Last Name: </span><?php the_author_meta('last_name')?>  </li>
</ul>
<hr>
<?php if (get_the_author_meta('description')){?>
<p class="p1"><?php the_author_meta('description')?></p>
<?php }else{
	echo'no description';
}

?>
</div>
</div>
<!--end row -->
</div>

<!--start  row 2 -->
<div class="row author-stats">
<div class="col-md-3">
<div class="stats-comments">
Post count :
<span><?php echo count_user_posts(get_the_author_meta('ID'))?></span>
</div>
</div>
<div class="col-md-3">
<div class="stats-comments">
Comments count :
<span>
<?php
$comments_count_argument=array(
'user_id'=>get_the_author_meta('ID'),
'count'=>true
);

echo get_comments($comments_count_argument);

?>

</span>
</div>
</div>
<div class="col-md-3">
<div class="stats-comments">
Total posts view :
<span>0</span>
</div>
</div>
<div class="col-md-3">
<div class="stats-comments">
Testing :
<span>0</span>
</div>
</div>
</div>

<!--end row 2 -->
<!--start  row 3 -->

<?php
$author_posts_nmbers=5;
$auther_posts_arguments=array(
'author'=> get_the_author_meta('ID'),
'posts_per_page'=> $author_posts_nmbers
);

$author_posts=new wp_Query($auther_posts_arguments);


		if($author_posts->have_posts()){//check if there's posts ?>
		<h3 class="back-h3 table-dark">
		<?php
		//check if users posts larger than orequal posts nubers
		if(count_user_posts(get_the_author_meta('ID'))>=$author_posts_nmbers){
			
		//echo latest posts per page
		
		echo'Latest'.'['.$author_posts_nmbers.']'.'Posts Of';
		
		//echo nickname
		the_author_meta('nickname');

		}else{
			
			//echo latest posts without number
			echo'Latest posts Of ';
			//echo nickname
		the_author_meta('nickname');
		}
		
		?>
		</h3>
		
		<?php
		while($author_posts->have_posts()){//loop throught posts
			
			$author_posts->the_post();?>
			<div class=" row author-posts">
			<div class="col-sm-3 img-size">
			<?php the_post_thumbnail('',['class'=>'img-responsive img-thumbnail ','title'=>'post-image'])?>
			
			</div>
			
						<div class="col-sm-9">
						
						<h3 class="post-title-author">
						<a href="<?php the_permalink();?>">

						<?php the_title();?>
						</a>
						</h3>
						
                        <span class="post-date">
						<i class="fas fa-calendar fa-fw "></i><?php the_time('F j,Y')?>
						</span>
						<span class="post-comments">
						<i class="fas fa-comments fa-fw "></i>
						<?php comments_popup_link('0 comments','1','% comments','comments_url','comments disabled')?>
						</span>
						
						<div class="post-content p1">
						<?php the_excerpt();?>
						</div>
					
				

						
						</div>
						</div>
						<div class="clearfix"></div>
						<?php
			
			
			
		}//end while loop
			
		}//end if condition
		
		wp_reset_postdata();//reset loop Query
		
			$author_comments_nmbers=5;
	$auther_posts_arguments=array(
	'user_id'=> get_the_author_meta('ID'),
	'status'=> 'approve',
	'number'=> $author_posts_nmbers,
	'post_type'=> 'post'
);
//start latest comments



//end latest comments

//start table tricks
  echo '<div class="table-dark back-com">';
  $comments=get_comments($auther_posts_arguments);
if($comments){
  //check if users comments larher than or equal comments numbers
  if(get_comments($comments_count_argument)>=$author_comments_nmbers){
	  //echo latest comments numbers
	  echo'<h3>Latest '.$author_comments_nmbers.' Comments of ';
	  //echo nickname
	 the_author_meta('nickname');
	  
  }else{
	  //echo latst comments without number
	  echo'latest comment of ';
	  //echo nickname
	  the_author_meta('nickname </h3>');
  }
    echo '</div>';
  ?>
<table class="table table-bordered ">
	<thead class="table-dark">
	<tr >
	<th  class="text-center">Posts</th>
	<th  class="text-center">Date and Time</th>
	<th  class="text-center">Comments</th>
	</tr>
	</thead><?php
	

	foreach($comments as $comment){?>
	
	
	<tbody class="table-dark">
	<tr>
	<td  >
<a href="<?php echo get_permalink($comment->comment_post_ID)?>">
	<?php echo get_the_title($comment->comment_post_ID)?>
	
</a>
</td>
<td   class="text-center" >
<?php echo $comment->comment_date?>
</td>
<td>
<?php echo $comment->comment_content ?>
</td>
</tr>
</tbody>


<!-- start table tricks -->
	<?php
}
?>
</table>
	<?php
}else{
	echo 'you dont have comments';
}



?>

</div>


<?php get_footer();?>




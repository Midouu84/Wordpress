<?php
if(comments_open()){//check if comments open ?>
	
	<h3 class="comments-count"><?php comments_number('0 comments','1 comment','% comments')?></h3>
	
	<?php
	echo'<ul class="list-unstyled p-comments_list">';
	$comments_arguments=array(
	'max_depth'=>3,'type'=>'comment','avatar_size'=>64
	);
	 wp_list_comments($comments_arguments);
	 
	/*foreach($comments as $comment){
		comment_author();
	}*/
	echo'</ul>';
	echo'<hr class="comments-separator">';
	
	/*custom form comments
	
	$commentform_argument=array(
	'fields'=>array(
	'author'=>'<div class="form-group"><label>Your Name</label><input class="form-control"></div>',
	'email'=>'<div class="form-group"><label>Email</label>name fieled</div>',
	'url'=>'<div class="form-group"><label>Website</label>name fieled</div>'
	),
	'comment_field'=>'<div class="form-group">textarea</div>'
	);*/
	$commentform_argument=array(
	
	'title_reply'=>'Add Your Comment',//change add comment
	'title_reply_to'=>'Add a Reply To [%s]',//change add reply
	'class_submit'=>'btn btn btn-info btn-md',//change submit button class
	'comment_notes_before'=>''

	);
	
	comment_form($commentform_argument);
	
	
}else{
	echo'comments disabled';
}


<?php 
  include('header.php');
  session_start()
?>
<script src="js/comments.js"></script>
<link rel="stylesheet" href="css/commentstyle.css">

	<div class="container">		
		<br>		
		<form method="POST" id="commentForm">
			<div class="form-group" style="">
				<input type="hidden" style="width:65%" name="name" id="name" class="form-control" value="<?php echo $_SESSION['username'] ? $_SESSION['username'] : 'user'  ?>" placeholder="Enter Name" required />
			</div>
			<div class="form-group">
				<textarea name="comment" style="width:65%" id="comment" class="form-control" placeholder="Enter Comment" rows="5" required></textarea>
			</div>
			<span id="message" style="width:50%"></span>
			<br>
			<div class="form-group">
				<input type="hidden"  style="width:50%" name="commentId" id="commentId" value="0" />
				<input type="submit" name="submit" id="submit" style="width:20%; " class="btn btn-primary" value="Post Comment" />
				<input type="reset" name="submit" id="submit" style="width:20%" class="btn btn-primary" value="Clear" />

			</div>
		</form>		
		<br>
		<div id="showComments"></div>   
</div>	
<?php include('footer.php');?>



<?php 

$userid = $_SESSION['user'];
?>


<?php if(isset($GLOBALS['comments']) && is_array($comments)): ?>
<?php foreach($comments as $key => $comment): ?>               

<?php $user = User::getUser($comment->userid); ?>

<li class="comments-holder" id="<?php echo $comment->comment_id;?>">
                <div class="user-img">
                    <img src="<?php echo $user->profile_img; ?>" alt="userimg" class="user-img-pic">
                </div>   
                <div class="comment-body">
                    <h3 class="username-field">
                    <?php echo $user->username; ?>
                </h3>
                <div class="comment-text"><?php echo $comment->comment; ?>
                   </div>

                </div> 
                <?php if($userid == $comment->userid): ?>
                <div class="comment-buttons-holder">
                    <ul>
                        <li id="<?php echo $comment->comment_id;?>" class="delete-btn">
                            X
                        </li>
                    </ul>
                </div>
                <?php endif; ?>
</li>


<?php endforeach; ?>
<?php endif; ?>
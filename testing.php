<article onload="generateMasonryGrid(<?php echo $post;?>)">
    <a href="post_detail.php?id=<?php echo $post['id'];?>" class="project">
        <img class="project-picture" src="./uploads/posts/<?php echo $post['image']; ?>" alt="project image">
    </a>
    <div class="project-info">
        <?php if (!empty($id)): ?>
            <a class="project-author" href="profile.php?id=<?php echo $post['user_id']?>">
                <img class="project-author-picture" src="./uploads/profiles/<?php echo $profile['image']; ?>" alt="profile picture">
                <h4 class="project-author-username"><?php echo $profile['username']; ?></h4>
            </a>
            <form action="" method="post" name="like">
                <div class="project-interactions">
                    <div class="project-interactions-like" onclick="postLiked(this, <?php echo $post['id'];?>, <?php echo $id?>);">
                        <a href="#" class="like"> 
                            <?php if ($checkLikes == "0"):?>               
                                <img data-post="<?php echo $post['id']?>" data-user="<?php echo $id?>" id="like-icon" class="like-icon-<?php echo $post['id']; ?>" src="./assets/heart-empty.svg" alt="heart or like icon">
                                <h4 class="numberOfLikes-<?php echo $post['id']; ?>"><?php echo $likes?></h4>
                            <?php elseif ($checkLikes == "1"):?> 
                                <img data-post="<?php echo $post['id']?>" data-user="<?php echo $id?>" id="like-icon" class="like-icon-<?php echo $post['id']; ?>" src="./assets/heart-full.svg" alt="heart or like icon">
                                <h4 class="numberOfLikes-<?php echo $post['id']; ?>"><?php echo $likes?></h4>
                            <?php endif;?>
                        </a>
                    </div>
                    <div class="project-interactions-comment">
                        <img class="comment-icon" src="./assets/comment.svg" alt="comment icon">
                        <h4><?php echo $commentsCount?></h4>
                    </div>
                </div>
            </form>
        <?php endif; ?>
    </div>
</article>
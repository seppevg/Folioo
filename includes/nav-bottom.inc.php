<?php
    $url = $_SERVER["REQUEST_URI"]; 
    $currentHome = strrpos($url, "index.php"); 
    $currentSearch = strrpos($url, "search.php"); 
    $currentAdd = strrpos($url, "add.php"); 
    $currentProfile = strrpos($url, "profile.php"); 
?><nav class="bottom-nav">
    <div class="nav-item">
        <a href="index.php" class="nav-img">
            <?php if($currentHome != false): ?>
                <img src="./assets/home.svg" alt="Home">
            <?php else: ?>
                <img src="./assets/home-off.svg" alt="Home">
            <?php endif; ?>
        </a>
        <div class="nav-link">
            <?php if($currentHome != false): ?>
                <a style="color:#0600ff;" href="index.php">Home</a>
            <?php else: ?>
                <a style="color:#a7a7a7;" href="index.php">Home</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="nav-item">
        <a href="#" class="nav-img"> 
            <?php if($currentSearch != false): ?>
                <img src="./assets/search.svg" alt="Search">
            <?php else: ?>
                <img src="./assets/search-off.svg" alt="Search">
            <?php endif; ?>
        </a>
        <div class="nav-link">
            <?php if($currentSearch != false): ?>
                <a style="color:#0600ff;" href="search.php">Search</a>
            <?php else: ?>
                <a style="color:#a7a7a7;" href="search.php">Search</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="nav-item">
        <a href="#" class="nav-img">
            <?php if($currentAdd != false): ?>
                <img src="./assets/add.svg" alt="Add">
            <?php else: ?>
                <img src="./assets/add-off.svg" alt="Add">
            <?php endif; ?>
        </a>
        <div class="nav-link">
            <?php if($currentAdd != false): ?>
                <a style="color:#0600ff;" href="add.php">Add</a>
            <?php else: ?>
                <a style="color:#a7a7a7;" href="add.php">Add</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="nav-item">
        <a href="profile.php" class="nav-img">
            <?php if($currentProfile != false): ?>
                <img src="./assets/more.svg" alt="More">
            <?php else: ?>
                <img src="./assets/more-off.svg" alt="More">
            <?php endif; ?>
        </a>
        <div class="nav-link">
            <?php if($currentProfile != false): ?>
                <a style="color:#0600ff;" href="profile.php">Profile</a>
            <?php else: ?>
                <a style="color:#a7a7a7;" href="profile.php">Profile</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
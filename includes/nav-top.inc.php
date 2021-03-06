<?php 
$profile = User::getInfo($id);
foreach ($profile as $p){
    $mainModerator = $p['moderator'];
} 
?><nav class="top-nav">
        <div id="container-logo">
            <div class="dropdown">
                <a href="index.php"><img id="full-logo" src="./assets/folioo-blue.svg" alt="Folioo logo"></a>
                <?php if (!empty($_SESSION['id'])): ?>
                    <button class="dropdown-button dropdown-filter-desktop"><img class="dropdown-icon" src="./assets/dropdown.svg" alt="Dropdown arrow"></button>
                <?php endif; ?>
                <div class="dropdown-menu dropdown-menu-desktop">
                    <div>
                        <a href="index.php?feed=chronologic">Chronologic</a>
                        <img src="./assets/chronologic.svg" alt="Chronologic icon">
                    </div>
                    <div>
                        <a href="index.php?feed=following">Following</a>
                        <img src="./assets/following.svg" class="following-icon" alt="Following icon">
                    </div>                    
                </div>
            </div>
        </div>

        <form class="search search-nav" method="get">
            <div class="search-top-nav">
                <input type="text" name="searchInput" placeholder="Search" class="inputSearch">

                <button class="filterbtn">
                    <img class="modal-button" src="./assets/filter.svg" alt="Filter icon">
                </button>

                <button type="submit" class="searchbtn">
                    <img src="./assets/search.svg" alt="Search icon">
                </button>
            </div>

            <section class="modal modal-container" id="desktop-filter">
                
                <div id="modal" class="modal-content hidden">
                    <h3>Choose your filter</h3>
                    <div class="filter-options hidden">
                        <form method="get">
                            <input type="radio" value="Title" name="filter" checked="checked"> Title <br> <br>
                            <input type="radio" value="Tags" name="filter"> Tags                  
                        </form> 
                    </div>
                </div>
      
            </section>
        </form>

        <div class="user-links">
            <?php if(!empty($_SESSION['id'])):?>
                <?php if(!$isBanned): ?>
                <a class="main-btn add-project-nav" href="add.php">Share your project!</a>
                <?php endif; ?>
                <a href="profile.php" class="nav-user">
                        <?php $userImage = User::getInfo($_SESSION['id']); ?>
                        <?php foreach ($userImage as $uI): ?>
                            <img src="./uploads/profiles/<?php echo $uI['image']; ?>">
                        <?php endforeach; ?>
                </a>
                <button class="dropdown-button dropdown-button-profile">
                    <img class="dropdown-icon" src="./assets/dropdown.svg" alt="Dropdown arrow">
                </button>
                <div class="dropdown-menu-profile hidden">
                    <a href="showcase.php?id=<?php echo $_SESSION['id'];?>">
                        <img class="modal-icon" src="./assets/showcase.svg" alt="showcase">
                        <p>View showcase</p>
                    </a>
                    <a href="change_password.php">
                        <img class="modal-icon" src="./assets/lock.svg" alt="lock">
                        <p>Change password</p>
                    </a>
                    <a href="logout.php">
                        <img class="modal-icon" src="./assets/log-out.svg" alt="log out">
                        <p>Log out</p>
                    </a>
                    <a href="delete_profile.php" class="delete-profile-popup">
                        <img class="modal-icon" src="./assets/delete.svg" alt="delete">
                        <p>Delete your profile</p>
                    </a>
                    <?php if (!empty($mainModerator)) : ?>
                    <a href="the_naughty_list.php">
                        <img class="modal-icon" src="./assets/list.svg" alt="List icon">
                        <p>The naughty list</p>
                    </a>

                    <a href="invite.php">
                    <img class="modal-icon" src="./assets/link.svg" alt="List icon">
                        <p>Invite others</p>
                    </a>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <a class="main-btn login-nav-btn" href="login.php">Log in</a>
                <a class="main-btn register-nav-btn" href="register.php">Register</a>
            <?php endif; ?>
        </div>
    </nav>
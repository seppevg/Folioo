<nav class="top-nav">
    <div id="container-logo">
        <div class="dropdown">
            <img id="full-logo" src="./assets/folioo-blue.svg" alt="Folioo logo">
            <button class="dropdown-button"><img class="dropdown-icon" src="./assets/dropdown.svg" alt="Dropdown arrow"></button>
            <div class="dropdown-menu">
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

    <form class="search search-nav" method="post">
        <div class="profile-header">
            <input type="text" name="searchInput" placeholder="Search" class="inputSearch">

            <button class="filterbtn">
                <img class="modal-button" src="./assets/filter.svg" alt="Filter icon">
            </button>

            <button type="submit" name="submit-search" class="searchbtn">
                <img src="./assets/search.svg" alt="Search icon">
            </button>
        </div>

        <section class="modal modal-container">
            <div id="modal" class="modal-content hidden">
                <h3>Choose your filter</h3>
                <form method="post">
                    <input type="radio" value="Title" name="column"> Title <br> <br>
                    <input type="radio" value="Tags" name="column"> Tags                    
                </form> 
            </div>
        </section>
    </form>

    <div class="user-links">
        <a class="main-btn add-project-nav" href="add.php">Inspire others</a>
        <div class="nav-user">
            <img src="./uploads/profiles/1.jpg">
        </div>
        <button class="dropdown-button">
            <img class="dropdown-icon" src="./assets/dropdown.svg" alt="Dropdown arrow">
        </button>
    </div>
</nav>
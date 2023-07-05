<header class="webpage-header">
    <nav class="nav-menu">
        <ul class="nav-list">
            <li class="nav-list-item">
                <a href="<?php echo (Auth::IsLoggedIn()) ? "../users/logout.php" : "../users/login.php"?>">
                    <?php echo (Auth::IsLoggedIn()) ? "Logout" : "Login"?>
                </a>
            </li>
            <li class="nav-list-item">
                <a href="<?php echo (Auth::IsLoggedIn()) ? "../quiz/build-quiz.php" : "../users/login.php"?>">
                    Make Quiz
                </a>
            </li>
            <li class="nav-list-item">
                <a href="<?php echo (Auth::IsLoggedIn()) ? "../pages/main.php" : "../users/login.php"?>">
                    Quizzes
                </a>
            </li>
        </ul>
    </nav>
</header>
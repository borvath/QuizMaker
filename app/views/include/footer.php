<footer class="webpage-footer">
    <ul class="footer-links">
        <li class="footer-link-item">
            <a href="<?php echo (Auth::IsLoggedIn()) ? "../pages/main.php" : "../users/login.php"?>">
                Quizzes
            </a>
        </li>
        <li class="footer-link-item">
            <a href="<?php echo (Auth::IsLoggedIn()) ? "../quiz/build-quiz.php" : "../users/login.php"?>">
                Make Quiz
            </a>
        </li>
        <li class="footer-link-item">
            <a href="<?php echo (Auth::IsLoggedIn()) ? "../users/logout.php" : "../users/login.php"?>">
                <?php echo (Auth::IsLoggedIn()) ? "Logout" : "Login"?>
            </a>
        </li>
    </ul>
</footer>
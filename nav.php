<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav>
    <ul>
        <li><a href="index.php" class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">Home</a></li>
        <li><a href="language.php" class="<?php echo ($current_page == 'language.php') ? 'active' : ''; ?>">Language</a></li>
        <li><a href="religion.php" class="<?php echo ($current_page == 'religion.php') ? 'active' : ''; ?>">Religion</a></li>
        <li><a href="clothing.php" class="<?php echo ($current_page == 'clothing.php') ? 'active' : ''; ?>">Clothing</a></li>
        <li><a href="handicraft.php" class="<?php echo ($current_page == 'handicraft.php') ? 'active' : ''; ?>">Handicrafts</a></li>
        <li><a href="feedback.php" class="<?php echo ($current_page == 'feedback.php') ? 'active' : ''; ?>">Feedback</a></li>
    </ul>
</nav>

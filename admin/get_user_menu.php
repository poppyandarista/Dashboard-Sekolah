<?php
include("check_login.php");
?>
<li class="nav-item dropdown user-menu">
    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
        <img src="<?php echo htmlspecialchars($_SESSION['user']['profile_picture'] ?? 'dist/assets/img/blank-pfp.jpeg'); ?>"
            class="user-image rounded-circle shadow" alt="User Image" />
        <span class="d-none d-md-inline"><?php echo htmlspecialchars($_SESSION['user']['nama']); ?></span>
    </a>
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
        <li class="user-header text-bg-primary">
            <img src="<?php echo htmlspecialchars($_SESSION['user']['profile_picture'] ?? 'dist/assets/img/blank-pfp.jpeg'); ?>"
                class="rounded-circle shadow" alt="User Image" />
            <p>
                <?php echo htmlspecialchars($_SESSION['user']['nama']); ?> -
                <?php echo ucfirst($_SESSION['user']['role']); ?>
            </p>
        </li>
        <li class="user-footer">
            <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
            <a href="logout.php" class="btn btn-default btn-flat float-end">Sign out</a>
        </li>
    </ul>
</li>
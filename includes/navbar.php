<?php
/**
 * Common Navigation Bar
 * College Club Management System
 */
$currentUser = getCurrentUser();
$baseUrl = getBaseUrl();
?>
<nav class="navbar">
    <div class="nav-container">
        <a href="<?php echo $baseUrl; ?>index.php" class="nav-logo">
            🎓 CCMS <span class="nav-sub">TU BCA</span>
        </a>

        <ul class="nav-menu">
            <li><a href="<?php echo $baseUrl; ?>index.php">Home</a></li>

            <?php if ($currentUser): ?>
                <?php if ($currentUser['role'] === 'student'): ?>
                    <li><a href="<?php echo $baseUrl; ?>student/dashboard.php">Dashboard</a></li>
                    <li><a href="<?php echo $baseUrl; ?>student/clubs.php">Clubs</a></li>
                    <li><a href="<?php echo $baseUrl; ?>student/events.php">Events</a></li>
                    <li><a href="<?php echo $baseUrl; ?>student/tasks.php">My Tasks</a></li>
                <?php elseif ($currentUser['role'] === 'club_head'): ?>
                    <li><a href="<?php echo $baseUrl; ?>club-head/dashboard.php">Club Head Panel</a></li>
                    <li><a href="<?php echo $baseUrl; ?>club-head/members.php">Members</a></li>
                    <li><a href="<?php echo $baseUrl; ?>club-head/events.php">Events</a></li>
                    <li><a href="<?php echo $baseUrl; ?>club-head/tasks.php">Tasks</a></li>
                <?php elseif ($currentUser['role'] === 'admin'): ?>
                    <li><a href="<?php echo $baseUrl; ?>admin/dashboard.php">Admin Panel</a></li>
                    <li><a href="<?php echo $baseUrl; ?>admin/users.php">Users</a></li>
                    <li><a href="<?php echo $baseUrl; ?>admin/clubs.php">Clubs</a></li>
                    <li><a href="<?php echo $baseUrl; ?>admin/events.php">Events</a></li>
                <?php endif; ?>

                <li class="nav-user-info">
                    <span class="user-badge role-<?php echo e($currentUser['role']); ?>">
                        <?php echo e(ucwords(str_replace('_', ' ', $currentUser['role']))); ?>: <?php echo e($currentUser['name']); ?>

                    </span>
                </li>
                <li><a href="<?php echo $baseUrl; ?>logout.php" class="btn btn-sm btn-outline">Logout</a></li>
            <?php else: ?>
                <li><a href="<?php echo $baseUrl; ?>login.php" class="btn btn-sm btn-outline">Login</a></li>
                <li><a href="<?php echo $baseUrl; ?>register.php" class="btn btn-sm btn-primary">Register</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

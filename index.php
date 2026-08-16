<?php
/**
 * Main Landing Page
 * College Club Management System
 */
$pageTitle = "Home - College Club Management System";
require_once __DIR__ . '/includes/header.php';
?>

<div class="hero-section">
    <div class="hero-content">
        <h1>College Club Management System</h1>
        <p class="hero-lead">
            Empowering student communities, streamlining event organization, and optimizing club task execution for BCA Tribhuvan University.
        </p>

        <?php if (!isLoggedIn()): ?>
            <div class="hero-buttons">
                <a href="login.php" class="btn btn-primary btn-lg">Log In</a>
                <a href="register.php" class="btn btn-secondary btn-lg">Register as Student</a>
            </div>
        <?php else: ?>
            <div class="hero-buttons">
                <?php $user = getCurrentUser(); ?>
                <?php if ($user['role'] === 'student'): ?>
                    <a href="student/dashboard.php" class="btn btn-primary btn-lg">Go to Student Dashboard</a>
                <?php elseif ($user['role'] === 'club_head'): ?>
                    <a href="club-head/dashboard.php" class="btn btn-primary btn-lg">Go to Club Head Panel</a>
                <?php elseif ($user['role'] === 'admin'): ?>
                    <a href="admin/dashboard.php" class="btn btn-primary btn-lg">Go to Admin Panel</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<section class="features-grid">
    <div class="feature-card">
        <div class="feature-icon">🏛️</div>
        <h3>Club Management</h3>
        <p>Explore official college clubs, track active memberships with strict 1-club-per-student server rules.</p>
    </div>

    <div class="feature-card">
        <div class="feature-icon">🏅</div>
        <h3>Member Responsibilities</h3>
        <p>Assign specialized lead roles (Graphics, Logistics, Tech, PR) to active club members for structured teamwork.</p>
    </div>

    <div class="feature-card">
        <div class="feature-icon">📅</div>
        <h3>Event Management</h3>
        <p>Organize workshops, hackathons, and cultural programs. Track student event registration and manual attendance.</p>
    </div>

    <div class="feature-card">
        <div class="feature-icon">📋</div>
        <h3>Task Management</h3>
        <p>Club Heads assign event-driven tasks to member leads with priorities, deadlines, and real-time status tracking.</p>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

<?php
/**
 * Authentication and Session Helper Functions
 * College Club Management System
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Check if user is logged in
 * @return bool
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

/**
 * Get logged-in user data
 * @return array|null
 */
function getCurrentUser() {
    if (!isLoggedIn()) {
        return null;
    }
    return [
        'id' => $_SESSION['user_id'],
        'name' => $_SESSION['user_name'] ?? '',
        'email' => $_SESSION['user_email'] ?? '',
        'role' => $_SESSION['user_role'] ?? 'student'
    ];
}

/**
 * Enforce login authentication
 */
function requireLogin() {
    if (!isLoggedIn()) {
        $_SESSION['flash_error'] = "Please log in to access this page.";
        header("Location: " . getBaseUrl() . "login.php");
        exit();
    }
}

/**
 * Enforce specific role requirement
 * @param string|array $roles Single role string or array of allowed roles
 */
function requireRole($roles) {
    requireLogin();
    $userRole = $_SESSION['user_role'] ?? '';

    $allowed = is_array($roles) ? in_array($userRole, $roles) : ($userRole === $roles);

    if (!$allowed) {
        $_SESSION['flash_error'] = "Unauthorized access attempt.";
        header("Location: " . getBaseUrl() . "index.php");
        exit();
    }
}

/**
 * Get base URL of application
 * @return string
 */
function getBaseUrl() {
    return '/college-club-management/';
}

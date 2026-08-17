<?php
/**
 * CSRF Protection Helper Functions
 * College Club Management System
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Generate CSRF Token and store in session
 * @return string
 */
function generateCsrfToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Output CSRF Token hidden form field
 */
function csrfField() {
    $token = generateCsrfToken();
    echo '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($token, ENT_QUOTES, 'UTF-8') . '">';
}

/**
 * Verify CSRF Token from POST request
 * @return bool
 */
function verifyCsrfToken() {
    if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token'])) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']);
}

/**
 * Enforce CSRF token verification for POST requests
 */
function checkCsrf() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!verifyCsrfToken()) {
            die("CSRF Token Verification Failed. Invalid or expired form submission.");
        }
    }
}

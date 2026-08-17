<?php
/**
 * Utility Functions
 * College Club Management System
 */

/**
 * Sanitize output strings for XSS protection
 * @param string|null $data
 * @return string
 */
function e($data) {
    return htmlspecialchars($data ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Display flash messages (success/error)
 */
function displayFlashMessages() {
    if (isset($_SESSION['flash_success'])) {
        echo '<div class="alert alert-success">' . e($_SESSION['flash_success']) . '</div>';
        unset($_SESSION['flash_success']);
    }
    if (isset($_SESSION['flash_error'])) {
        echo '<div class="alert alert-error">' . e($_SESSION['flash_error']) . '</div>';
        unset($_SESSION['flash_error']);
    }
}

/**
 * Format date string safely
 * @param string $dateStr
 * @param string $format
 * @return string
 */
function formatDate($dateStr, $format = 'M d, Y') {
    if (!$dateStr) return 'N/A';
    $timestamp = strtotime($dateStr);
    return $timestamp ? date($format, $timestamp) : 'N/A';
}

/**
 * Check if a student is already in an active club
 * Enforces one active club per student rule at server side.
 * @param mysqli $conn
 * @param int $userId
 * @return array|bool Returns active membership row if found, otherwise false.
 */
function getStudentActiveClub($conn, $userId) {
    $userId = (int)$userId;
    $sql = "SELECT m.*, c.name AS club_name, c.code AS club_code, r.name AS responsibility_name
            FROM memberships m
            JOIN clubs c ON m.club_id = c.id
            LEFT JOIN responsibilities r ON m.responsibility_id = r.id
            WHERE m.user_id = ? AND m.status = 'active'
            LIMIT 1";

    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            mysqli_stmt_close($stmt);
            return $row;
        }
        mysqli_stmt_close($stmt);
    }
    return false;
}

<?php
/**
 * Common Header
 * College Club Management System
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/auth.php';
$pageTitle = $pageTitle ?? 'College Club Management System';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($pageTitle); ?></title>
    <link rel="stylesheet" href="<?php echo getBaseUrl(); ?>assets/css/style.css">
</head>
<body>
<?php require_once __DIR__ . '/navbar.php'; ?>
<main class="main-container">
    <?php displayFlashMessages(); ?>

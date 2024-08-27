<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css"> <!-- General styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- FontAwesome -->
    <title>Smart Beauty Advisor</title>
</head>
<body>
    <?php
    // Only include header if not on login, sign-up, or forgot-password pages
    if (!in_array($page, ['login', 'signup', 'forgot-password'])) {
        include 'includes/header.php';
    }
    ?>
    
    <main>
        <?php
        $pagePath = 'pages/' . $page . '.php';
        
        echo "<!-- Trying to load: $pagePath -->"; // Debugging output
        if (file_exists($pagePath)) {
            include $pagePath;
        } else {
            echo '<h1>404 - Page Not Found</h1>';
        }
        ?>
    </main>

    <?php
    // Only include footer if not on login, sign-up, or forgot-password pages
    if (!in_array($page, ['login', 'signup', 'forgot-password'])) {
        include 'includes/footer.php';
    }
    ?>

    <!-- Link to the slider script -->
    <script src="assets/js/slider.js"></script>
    <script src="assets/js/testimonial.js"></script>
</body>
</html>

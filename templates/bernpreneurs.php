<?php
/*
 *Template Name: Bernpreneurs Template
 */
//get_header();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Favicon Settings -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-config" content="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <meta charset="<?php bloginfo("charset"); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo("name"); ?></title>

    <?php wp_head(); ?>
</head>

<style>
    h1, h2, h3, h4, h5 { color: #1582BE !important; }
</style>

<body>
<?php
echo '<div class="template-default-wrapper">';
echo '<div class="template-default-container">';
echo the_content();
echo "</div>";
echo "</div>";

//get_footer();
?>
</body>
</html>

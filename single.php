<?php
get_header();

echo '<div class="template-default-wrapper template-single-post-wrapper">';
echo '<div class="template-default-container template-single-post-container">';
echo '<div class="sud__post_single_feature_image" style="background-image:url(' .
    get_field("feature_image") .
    '); ">';
$companyID = get_field("related_company") ?: false;
if ($companyID) {
    echo '<div class="sud__post_company_logo" style=" ">';
    echo "<p>Provided by</p>";
    echo '<img src="' .
        get_field("logo", $companyID)["url"] .
        '" alt="logo-' .
        get_field("company_name", $companyID) .
        '"/>';
    echo "</div>";
}
echo "</div>";
echo "<h5>" . get_the_date() . "</h5>";
echo "<h2>" . get_the_title() . "</h2>";

$authorID = get_field("author") ?: false;
if ($authorID) {
    echo '<div class="sud__post_author">';
    echo '<div class="sud__post_author_portrait" style="background-image:url(' .
        get_field("portrait", $authorID)["url"] .
        ');"></div>';
    echo "<div>";
    echo '<p class="sud__post_author_name">' .
        get_field("name", $authorID) .
        " " .
        get_field("surname", $authorID) .
        "</p>";
    echo '<p class="sud__post_author_function">' .
        get_field("function", $authorID) .
        ", " .
        get_field("company", $authorID) .
        "</p>";
    echo "</div>";
    echo "</div>";
}

echo '<div class="sud__post_content">';
echo the_content();
echo "</div>";

echo "</div>";
echo "</div>";

get_footer();
?>

<?php
/*
 *Template Name: Posts
 */
get_header();

echo '<div class="template-default-wrapper template-post-wrapper">';
echo '<div class="template-default-container template-post-container">';

//echo "<h2>" . get_the_title() . "</h2>";
//echo the_content();

echo '<div class="post-list-wrapper" data-content="podcast">';

// Post List Filter
$categoriesArgs = [
    "hide_empty" => 1,
    "orderby" => "name",
    "order" => "ASC",
];
$categories = get_categories($categoriesArgs);

$tagArgs = [
    "hide_empty" => 1,
    "orderby" => "name",
    "order" => "ASC",
];
$tags = get_tags($tagArgs);

echo '<div class="post-list-filter">';

echo '<div class="sud__filter_category">';
echo '<select class="sud__filter_category_selection" name="category"  onchange="handleCategoryChange(this)" >';
echo '<option value="" hidden selected>Categories</option>';
foreach ($categories as $category) {
    echo '<option value="' .
        $category->term_id .
        '" data-category="' .
        $category->name .
        '" id="sud__category_potion_' .
        $category->term_id .
        '">' .
        $category->name .
        "</option>";
}
echo "</select>";
echo '<div class="sud__selection_category_summary"></div>';
echo "</div>";

echo '<div class="sud__filter_tag">';
echo '<select class="sud__filter_tag_selection" name="tag" onchange="handleTagChange(this)" >';
echo '<option value="" hidden selected>Tags</option>';
foreach ($tags as $tag) {
    echo '<option value="' .
        $tag->term_id .
        '" data-tag="' .
        $tag->name .
        '" id="sud__tag_potion_' .
        $tag->term_id .
        '">' .
        $tag->name .
        "</option>";
}
echo "</select>";
echo '<div class="sud__selection_tag_summary "></div>';
echo "</div>";

echo "</div>";

echo '<div class="sud__post_list_container">';
// Load via JS --> main.js
echo "</div>";
echo "</div>";

echo "</div>";
echo "</div>";

get_footer();

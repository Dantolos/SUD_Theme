<?php

// ENQUEUES
function sud_register_style()
{
    $theme_version = wp_get_theme()->get("Version");

    /*
    wp_enqueue_style(
        "splide-style",
        get_template_directory_uri() .
            "/assets/js/plugins/splide/splide-core.min.css",
        [],
        $theme_version,
        "all"
    );
    */
    wp_enqueue_style(
        "splide-style",
        "https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css",
        [],
        $theme_version,
        "all"
    );
    wp_enqueue_style(
        "sud-style",
        get_template_directory_uri() . "/assets/css/style.css",
        [],
        $theme_version,
        "all"
    );
}
add_action("wp_enqueue_scripts", "sud_register_style");

function sud_register_scripts()
{
    $theme_version = wp_get_theme()->get("Version");
    // extern
    wp_enqueue_script(
        "gsap",
        get_template_directory_uri() . "/assets/js/plugins/gsap/gsap.min.js",
        [],
        "1.0",
        true
    );
    wp_enqueue_script(
        "gsap-scroll",
        get_template_directory_uri() .
            "/assets/js/plugins/gsap/ScrollTrigger.min.js",
        ["gsap"],
        "1.0",
        true
    );
    wp_enqueue_script(
        "splide",
        get_template_directory_uri() .
            "/assets/js/plugins/splide/splide.min.js",
        [],
        "1.0",
        true
    );

    // main theme
    wp_enqueue_script(
        "sud-script",
        get_template_directory_uri() . "/assets/js/main.js",
        ["gsap", "gsap-scroll"],
        $theme_version,
        true
    );

    // page template specific scripts
    $theme_version = wp_get_theme()->get("Version");
    if (is_page_template("templates/posts.php")) {
        // Replace with your template filename
        wp_enqueue_script(
            "posts-js", // Handle
            get_template_directory_uri() . "/assets/js/posts.js", // Path to your JS file
            [], // Dependencies (optional)
            $theme_version,
            true // Load in footer
        );
    }

    global $post;
    $wnm_custom = [
        "templateUrl" => get_template_directory_uri(),
        "baseUrl" => get_home_url(),
    ];
    if (isset($post->ID)) {
        $wnm_custom["templateSlug"] = get_page_template_slug($post->ID);
    }
    wp_localize_script("sud-script", "globalURL", $wnm_custom);
}
add_action("wp_enqueue_scripts", "sud_register_scripts");

//Register block script
add_action("init", "sud_register_block_script");
function sud_register_block_script()
{
    $theme_version = wp_get_theme()->get("Version");
    wp_register_script(
        "block-hero",
        get_template_directory_uri() . "/extensions/blocks/hero/hero.js",
        [],
        $theme_version
    );
    wp_register_script(
        "block-counter",
        get_template_directory_uri() . "/extensions/blocks/counter/counter.js",
        ["gsap", "gsap-scroll"],
        $theme_version,
        true
    );
    wp_register_script(
        "block-accordion",
        get_template_directory_uri() .
            "/extensions/blocks/accordion/accordion.js",
        ["gsap", "gsap-scroll"],
        $theme_version,
        true
    );
    wp_register_script(
        "block-testimonials",
        get_template_directory_uri() .
            "/extensions/blocks/testimonials/testimonials.js",
        ["jquery", "splide"],
        $theme_version,
        true
    );
    wp_register_script(
        "block-timeline",
        get_template_directory_uri() .
            "/extensions/blocks/timeline/timeline.js",
        ["jquery", "splide"],
        $theme_version,
        true
    );
    /*
    wp_register_script(
        "block-photo-slider",
        get_template_directory_uri() .
            "/extensions/blocks/photo-slider/photo-slider.js",
        ["jquery", "splide"],
        $theme_version
    );

    */
    wp_register_script(
        "block-photo-slider",
        get_template_directory_uri() .
            "/extensions/blocks/photo-slider/photo-slider.js",
        ["jquery", "splide"],
        $theme_version,
        true
    );

    wp_register_script(
        "block-candidate-grid",
        get_template_directory_uri() .
            "/extensions/blocks/candidate-grid/candidate-grid.js",
        ["jquery"],
        $theme_version,
        true
    );
    wp_register_script(
        "block-people-highlight",
        get_template_directory_uri() .
            "/extensions/blocks/people-highlight/people-highlight.js",
        ["jquery"],
        $theme_version,
        true
    );
    wp_register_script(
        "block-flipcards",
        get_template_directory_uri() .
            "/extensions/blocks/flipcards/flipcards.js",
        ["jquery"],
        $theme_version,
        true
    );
}

/* ENQUEUE ADMIN STYLE */
function my_admin_theme_style()
{
    wp_enqueue_style(
        "my-admin-style",
        get_stylesheet_directory_uri() . "/assets/css/admin_style.css"
    );
}
add_action("admin_enqueue_scripts", "my_admin_theme_style");

/*-------------------------------------------------------------*/
/*------------------------ Blocks -----------------------------*/
/*-------------------------------------------------------------*/

require_once dirname(__FILE__) . "/extensions/blocks/blocks-register.php";

/*-------------------------------------------------------------*/
/*-------------------- Filetypes Enable -----------------------*/
/*-------------------------------------------------------------*/
add_filter(
    "wp_check_filetype_and_ext",
    "my_svgs_disable_real_mime_check",
    10,
    4
);
function my_svgs_disable_real_mime_check($data, $file, $filename, $mimes)
{
    $wp_filetype = wp_check_filetype($filename, $mimes);
    $ext = $wp_filetype["ext"];
    $type = $wp_filetype["type"];
    $proper_filename = $data["proper_filename"];
    return compact("ext", "type", "proper_filename");
}
add_filter("upload_mimes", function ($mime_types) {
    $mime_types["svg"] = "image/svg+xml";
    $mime_types["eps"] = "application/postscript";
    $mime_types["json"] = "application/json";
    $mime_types["obj"] = "model/obj";
    $mime_types["fbx"] = "model/fbx";
    return $mime_types;
});

/*-------------------------------------------------------------*/
/*----------------------- Colors ------------------------------*/
/*-------------------------------------------------------------*/
function mytheme_setup_theme_supported_features()
{
    add_theme_support("editor-color-palette", [
        [
            "name" => esc_attr__("blue", "SUD_Theme"),
            "slug" => "blue",
            "color" => "#1582BE",
        ],
        [
            "name" => esc_attr__("orange", "SUD_Theme"),
            "slug" => "orange",
            "color" => "#DF5F31",
        ],
        [
            "name" => esc_attr__("black", "SUD_Theme"),
            "slug" => "black",
            "color" => "#454034",
        ],
        [
            "name" => esc_attr__("blue mid", "SUD_Theme"),
            "slug" => "blue-mid",
            "color" => "#6EA9D8",
        ],
        [
            "name" => esc_attr__("blue light", "SUD_Theme"),
            "slug" => "blue-light",
            "color" => "#A1CCEB",
        ],
    ]);
}

add_action("after_setup_theme", "mytheme_setup_theme_supported_features");

/*-------------------------------------------------------------*/
/*----------------------------MENU-----------------------------*/
/*-------------------------------------------------------------*/

//Menu einstellung
function wpb_custom_new_menu()
{
    register_nav_menus([
        "main-menu" => __("Hauptmenu"),
        "sprachen" => __("Sprachen"),
        "footer-menu" => __("Footermenu"),
    ]);
}
add_action("init", "wpb_custom_new_menu");

add_filter("wp_nav_menu_objects", "submenu_limit", 10, 2);

function submenu_limit($items, $args)
{
    if (empty($args->submenu)) {
        return $items;
    }

    $ids = wp_filter_object_list(
        $items,
        ["title" => $args->submenu],
        "and",
        "ID"
    );
    $parent_id = array_pop($ids);
    $children = submenu_get_children_ids($parent_id, $items);

    foreach ($items as $key => $item) {
        if (!in_array($item->ID, $children)) {
            unset($items[$key]);
        }
    }
    return $items;
}
/*------------------------MENU WALKER--------------------------*/
require get_template_directory() . "/inc/walker.php";

/*-------------------------------------------------------------*/
/*---------------------DISABLE COMMENTS------------------------*/
/*-------------------------------------------------------------*/
add_action("admin_init", function () {
    // Redirect any user trying to access comments page
    global $pagenow;

    if ($pagenow === "edit-comments.php") {
        wp_safe_redirect(admin_url());
        exit();
    }

    // Remove comments metabox from dashboard
    remove_meta_box("dashboard_recent_comments", "dashboard", "normal");

    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, "comments")) {
            remove_post_type_support($post_type, "comments");
            remove_post_type_support($post_type, "trackbacks");
        }
    }
});

// Close comments on the front-end
add_filter("comments_open", "__return_false", 20, 2);
add_filter("pings_open", "__return_false", 20, 2);

// Hide existing comments
add_filter("comments_array", "__return_empty_array", 10, 2);

// Remove comments page in menu
add_action("admin_menu", function () {
    remove_menu_page("edit-comments.php");
});

// Remove comments links from admin bar
add_action("init", function () {
    if (is_admin_bar_showing()) {
        remove_action("admin_bar_menu", "wp_admin_bar_comments_menu", 60);
    }
});

/*-------------------------------------------------------------*/
/*--------------------- SEARCH FUNCTION------------------------*/
/*-------------------------------------------------------------*/
function __search_by_title_only($search, $wp_query)
{
    global $wpdb;

    if (empty($search)) {
        return $search;
    } // skip processing - no search term in query

    $q = $wp_query->query_vars;
    $n = !empty($q["exact"]) ? "" : "%";

    $search = $searchand = "";

    foreach ((array) $q["search_terms"] as $term) {
        $term = esc_sql(like_escape($term));
        $search .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
        $searchand = " AND ";
    }

    if (!empty($search)) {
        $search = " AND ({$search}) ";
        if (!is_user_logged_in()) {
            $search .= " AND ($wpdb->posts.post_password = '') ";
        }
    }

    return $search;
}
add_filter("posts_search", "__search_by_title_only", 500, 2);

//filtering
add_filter(
    "rest_post_query",
    function ($args, $request) {
        // For Categories
        if (isset($request["cat"])) {
            $args["tax_query"][] = [
                "taxonomy" => "category",
                "terms" => explode(",", $request["cat"]),
                "operator" => "AND",
                "include_children" => false,
            ];
        }

        // For Tags
        if (isset($request["sudtag"])) {
            $args["tax_query"][] = [
                "taxonomy" => "post_tag",
                "terms" => explode(",", $request["sudtag"]),
                "operator" => "AND",
                "include_children" => false,
            ];
        }

        return $args;
    },
    10,
    2
);

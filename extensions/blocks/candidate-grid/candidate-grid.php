<?php

// Support custom "anchor" values.
$anchor = "";
if (!empty($block["anchor"])) {
    $anchor = 'id="' . esc_attr($block["anchor"]) . '" ';
}
$hide = get_field("hide_block") ? "none" : "block";
$hide_on_mobile = get_field("hide_on_mobile") ? "sud__hide_on_mobile" : "";

$args = [
    "post_type" => "candidate", // the post type
    "posts_per_page" => "-1",
    "meta_key" => "name",
    "orderby" => "meta_value",
    "order" => "ASC",
];
$canditates = new WP_Query($args);
?>

<div class="<?php echo $hide_on_mobile; ?>" style="display:<?php echo $hide; ?>">
    <div <?php echo $anchor; ?> class="candidat-grid-wrapper" style="min-height:200px;">
        <div class="candidat-grid-container">
            <?php if (count($canditates->posts) > 0) {
                foreach ($canditates->posts as $canditate) {
                    $candidateID = $canditate->ID;
                    echo '<div class="sud__canditate_box" data-candidate="' .
                        $candidateID .
                        '">';

                    if (get_field("catch_of_the_jury", $candidateID)) {
                        echo '<div class="sud__canditate_catch_of_jury"><img src="' .
                            get_template_directory_uri() .
                            '/assets/img/utils/icon-medallion_02.svg" /></div>';
                    }

                    if (get_field("innosuisse", $candidateID)) {
                        echo '<div class="sud__canditate_innosuisse"><img src="' .
                            get_template_directory_uri() .
                            '/assets/img/utils/swiss-logo-flag.svg" /><p  >powered <span>by</span> <b>Innosuisse</b></p></div>';
                    }
                    echo '<img src="' .
                        get_field("logo", $candidateID) .
                        '" height="200px" width="200px"/>';
                    echo "</div>";

                    //LIGHTBOX
                    echo '<div class="lightbox-wrapper sud__candidate_lightbox_wrapper" lbtarget="' .
                        $candidateID .
                        '">';
                    echo '<div class="lightbox-close-layer" lbcloser="' .
                        $candidateID .
                        '" ><img src="' .
                        get_template_directory_uri() .
                        '/assets/img/utils/close-cross.svg" alt=""></div>';

                    echo '<div class="lightbox-container sud__candidate_lightbox_container">';
                    echo '<div class="sud__candidate_lightbox_logo">';
                    echo '<img src="' .
                        get_field("logo", $candidateID) .
                        '" />';
                    echo "</div>";

                    echo '<div class="sud__candidate_lightbox_content">';
                    echo "<h2>" . get_field("name", $candidateID) . "</h2>";
                    echo "<p>" .
                        get_field("description", $candidateID) .
                        "</p>";
                    echo '<a href=""><div class="btn-primary btn-neg">Webseite</div></a>';
                    echo "</div>";

                    //FLAGS
                    if (get_field("catch_of_the_jury", $candidateID)) {
                        echo '<div class="sud__canditate_catch_of_jury sud__canditate_catch_of_jury_lb"><img src="' .
                            get_template_directory_uri() .
                            '/assets/img/utils/icon-medallion_02.svg" /></div>';
                    }

                    echo "</div>";

                    echo "</div>";
                }
            } ?>
        </div>
    </div>
</div>

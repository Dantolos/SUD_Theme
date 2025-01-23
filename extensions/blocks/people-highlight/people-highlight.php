<?php

// Support custom "anchor" values.
$anchor = "";
if (!empty($block["anchor"])) {
    $anchor = 'id="' . esc_attr($block["anchor"]) . '" ';
}
$hide = get_field("hide_block") ? "none" : "block";
$hide_on_mobile = get_field("hide_on_mobile") ? "sud__hide_on_mobile" : "";

$personID = get_field("person") ?: null;
?>

<div class="<?php echo $hide_on_mobile; ?>" style="display:<?php echo $hide; ?>">
    <div <?php echo str_replace(
        '"',
        "",
        $anchor
    ); ?> class="sud__people_highlight_wrapper" style="min-height:200px;">
        <?php
        echo '<div class="sud__people_highlight_container">';
        echo '<div class="sud__people_highlight_title_section">';
        echo '<h3 class="c-orange">' . get_field("title", $personID) . "</h3>";
        echo '<p class="c-blue">' .
            get_field("description", $personID) .
            "</p>";
        echo "</div>";

        echo '<div class="sud__people_highlight_person_container">';
        echo '<div class="sud__people_highlight_person_portrait" style="background-image:url(' .
            get_field("portrait", $personID) .
            ');"></div>';
        echo '<div class="sud__people_highlight_person_content">';
        echo '<h4 class="c-orange">' . get_field("quote", $personID) . "</h4>";
        echo '<p class="c-blue"><strong>' .
            get_field("namen", $personID) .
            "</strong>, " .
            get_field("funktion", $personID) .
            "</p>";

        if (get_field("cv", $personID)) {
            echo '<button class="sud__people_highlight_person_more_button" data-person="' .
                $personID .
                '">more</button>';
        }
        echo "</div>";
        echo "</div>";

        echo "</div>";

        //LIGHTBOX
        echo '<div class="lightbox-wrapper sud__people_highlight_lightbox_wrapper" lbtarget="' .
            $personID .
            '">';
        echo '<div class="lightbox-close-layer" lbcloser="' .
            $personID .
            '" ><img src="' .
            get_template_directory_uri() .
            '/assets/img/utils/close-cross.svg" alt=""></div>';

        echo '<div class="lightbox-container sud__people_highlight_lightbox_lightbox_container">';
        echo '<div class="sud__people_highlight_lightbox_lightbox_content">';
        echo '<h2 class="c-orange">' . get_field("namen", $personID) . "</h2>";
        echo '<p class="c-blue fm" style="margin:0; line-height:1.1em;">' .
            get_field("funktion", $personID) .
            "</p>";
        echo '<p class="c-blue">' . get_field("cv", $personID) . "</p>";
        echo "</div>";
        echo "</div>";

        echo "</div>";
        ?>
    </div>
</div>

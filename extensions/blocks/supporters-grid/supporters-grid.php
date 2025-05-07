<?php

// Support custom "anchor" values.
$anchor = "";
if (!empty($block["anchor"])) {
    $anchor = 'id="' . esc_attr($block["anchor"]) . '" ';
}
$hide = get_field("hide_block") ? "none" : "block";
$hide_on_mobile = get_field("hide_on_mobile") ? "sud__hide_on_mobile" : "";

$title = get_field("title") ?: false;
$description = get_field("description") ?: false;

$args = [
    "post_type" => "people",
    "meta_query" => [
        [
            "key" => "groups_supporter", // ACF field name
            "value" => "1", // '1' for true, '0' for false
            "compare" => "=",
        ],
    ],
];
$supporters = new WP_Query($args);
?>

<div class="<?php echo $hide_on_mobile; ?>" style="display:<?php echo $hide; ?>">
    <div <?php echo $anchor; ?> class="supporters-grid-wrapper" style="min-height:200px;">

        <div class="supporters-grid-container ">
            <?php
            if ($title) {
                echo '<h2 class="c-orange">' . $title . "</h2>";
            }
            if ($description) {
                echo '<p class="c-blue">' . $description . "</p>";
            }

            if ($supporters->have_posts()) {
                echo '<div class="supporters-grid-items ">';
                foreach ($supporters->posts as $supporter) {
                    // Output post ID and title
                    $supporterID = $supporter->ID;

                    $name =
                        get_field("name", $supporterID) .
                        " " .
                        get_field("surname", $supporterID);

                    if (get_field("degree", $supporterID)) {
                        $name = get_field("degree", $supporterID) . " " . $name;
                    }

                    $infoline = get_field("company", $supporterID) ?: "";

                    echo '<div class="supporters-grid-item-border ">';
                    echo '<div class="supporters-grid-item ">';
                    echo '<p class="supporters-grid-item-name fm c-orange">' .
                        $name .
                        "</p>";
                    echo '<p class="supporters-grid-item-infoline fxs c-blue">' .
                        $infoline .
                        "</p>";
                    echo "</div>";
                    echo "</div>";
                }
                echo "</div>";
            }
            ?>


        </div>
    </div>
</div>

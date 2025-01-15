<?php

// Support custom "anchor" values.
$anchor = "";
if (!empty($block["anchor"])) {
    $anchor = 'id="' . esc_attr($block["anchor"]) . '" ';
}
$hide = get_field("hide_block") ? "none" : "block";
$hide_on_mobile = get_field("hide_on_mobile") ? "sud__hide_on_mobile" : "";

// Load values and assign defaults.
$counters = get_field("counters") ?: null;
?>

<div class="<?php echo $hide_on_mobile; ?>" style="display:<?php echo $hide; ?>">
    <div <?php echo $anchor; ?>class="counter-wrapper" style="min-height:200px;">
        <?php if ($counters) {
            echo '<div class="counter-container">';
            foreach ($counters as $counter) {
                echo '<div class="counter">';
                echo '<div class="counter-value"><h3 class="c-orange">' .
                    $counter["prefix"] .
                    '<span class="count-value" count-value="' .
                    $counter["value"] .
                    '">0</span>' .
                    $counter["sufix"] .
                    "</h3></div>";
                echo '<div class="counter-label"><h5 class="c-blue gtalpina fs" style="font-weight:normal;">' .
                    $counter["label"] .
                    "</h5></div>";
                echo "</div>";
            }
            echo "</div>";
        } ?>
    </div>
</div>

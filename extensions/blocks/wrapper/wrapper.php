<?php

// Support custom "anchor" values.
$anchor = "";
if (!empty($block["anchor"])) {
    $anchor = 'id="' . esc_attr($block["anchor"]) . '" ';
}
$hide = get_field("hide_block") ? "none" : "block";
$hide_on_mobile = get_field("hide_on_mobile") ? "sud__hide_on_mobile" : "";

// $title = get_field('title') ?: '';
// $desc = get_field('description') ?: '';
// $timeline_items = get_field('timeline_items') ?: false;
?>

<div class="<?php echo $hide_on_mobile; ?>" style="display:<?php echo $hide; ?>">
    <div <?php echo $anchor; ?>class="sud__wrapper" style="min-height:200px;">
        <div class="sud__wrapper-container">

            <h1>WRAPPER</h1>
            <div class="sud__bg_elemement_01"></div>
            <div class="sud__bg_elemement_02"></div>
            <div class="sud__bg_elemement_03"></div>
            <div class="sud__bg_elemement_04"></div>

        </div>
    </div>
</div>

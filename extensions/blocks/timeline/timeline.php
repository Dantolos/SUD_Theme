<?php

// Support custom "anchor" values.
$anchor = "";
if (!empty($block["anchor"])) {
    $anchor = 'id="' . esc_attr($block["anchor"]) . '" ';
}
$hide = get_field("hide_block") ? "none" : "block";
$hide_on_mobile = get_field("hide_on_mobile") ? "sud__hide_on_mobile" : "";

$title = get_field("title") ?: "";
$desc = get_field("description") ?: "";
$timeline_items = get_field("timeline_items") ?: false;
?>

<div class="<?php echo $hide_on_mobile; ?>" style="display:<?php echo $hide; ?>">
     <div <?php echo $anchor; ?>class="timeline-wrapper" style="min-height:200px;">
          <div class="timeline-container">
               <!-- timeline headings -->
               <div class="timeline-heading ">
                    <h3 class="c-orange"><?php echo $title; ?></h3>
                    <p class="c-blue"><?php echo $desc; ?></p>
               </div>

               <!-- timeline -->
               <div class="timeline-list">
                    <?php if ($timeline_items) {
                        foreach ($timeline_items as $key => $tl_item) {
                            //check for content
                            $contentClass = $tl_item["content"]["description"]
                                ? "timeline-slot-w-content"
                                : ""; ?>
                              <div class="<?php echo $key % 2 == 0
                                  ? "timeline-item right"
                                  : "timeline-item"; ?>">
                                   <div class="timeline-date">
                                        <span class="c-blue fxs"> <?php echo $tl_item[
                                            "date"
                                        ]; ?></span>
                                   </div>
                                   <div class="timeline-line"><div class="timeline-point"></div></div>
                                   <div class="timeline-content <?php echo $contentClass; ?>">
                                        <div class="timeline-title">
                                             <h5 class="c-orange ">
                                                  <span><?php echo $tl_item[
                                                      "content"
                                                  ]["title"]; ?></span>
                                             </h5>
                                        </div>

                                        <div class="timeline-desc <?php echo $contentClass; ?>" >
                                             <p class="c-blue"><?php echo str_replace(
                                                 "<p>",
                                                 '<p class="c-blue">',
                                                 $tl_item["content"][
                                                     "description"
                                                 ]
                                             ); ?></p>
                                        </div>
                                   </div>
                              </div>
                              <?php
                        }
                    } ?>
               </div>
          </div>
     </div>
</div>

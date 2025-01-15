<?php

// Support custom "anchor" values.
$anchor = "";
if (!empty($block["anchor"])) {
    $anchor = 'id="' . esc_attr($block["anchor"]) . '" ';
}
$hide = get_field("hide_block") ? "none" : "block";
$hide_on_mobile = get_field("hide_on_mobile") ? "sud__hide_on_mobile" : "";
?>


<div class="<?php echo $hide_on_mobile; ?>" style="display:<?php echo $hide; ?>">
     <div class="flashback-teaser-wrapper">
          <div class="flashback-teaser-container">

               <h3 class="c-orange"><?php echo get_field("title"); ?></h3>
               <p  class="c-blue"><?php echo get_field("description"); ?></p>
               <div class="flashback-teaser-boxes">
                    <?php if (get_field("pages")) {
                        foreach (get_field("pages") as $page) { ?>
                         <div class="flashback-teaser-box sud-shadow" style="background-image:url('<?php echo $page[
                             "background_image"
                         ]; ?>');">
                              <div class="flashback-teaser-box-layer"></div>
                              <a href="<?php echo $page["page"][
                                  "url"
                              ]; ?>" style="width:100%; height:100%; padding: 20% 10%;">
                                   <h4 class="fxl"><?php echo $page["page"][
                                       "title"
                                   ]; ?></h4>
                              </a>
                         </div>
                    <?php }
                    } ?>
               </div>
          </div>
     </div>
</div>

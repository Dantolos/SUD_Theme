<?php

// Support custom "anchor" values.
$anchor = "";
if (!empty($block["anchor"])) {
    $anchor = 'id="' . esc_attr($block["anchor"]) . '" ';
}
$hide = get_field("hide_block") ? "none" : "block";
$hide_on_mobile = get_field("hide_on_mobile") ? "sud__hide_on_mobile" : "";

// Load values and assign defaults.
$boxes = get_field("box") ?: null;
?>


<div class="<?php echo $hide_on_mobile; ?>" style="display:<?php echo $hide; ?>">
     <div <?php echo $anchor; ?>class="box-link-wrapper" style="min-height:50px;">
          <?php if ($boxes) {
              echo '<div class="box-link-container">';
              foreach ($boxes as $key => $box) {
                  echo '<a href="' .
                      $box["link"]["url"] .
                      '" target="' .
                      $box["link"]["target"] .
                      '">';
                  echo '<div class="box-link-box primatyBox" style="z-index:22' .
                      $key .
                      ';">';
                  echo '<img class="box-link-image" src="' .
                      $box["image"]["url"] .
                      '" style=" height:' .
                      $box["scale"] .
                      "%; width:" .
                      $box["scale"] .
                      "%; top:" .
                      $box["top"] .
                      "px; right:" .
                      $box["right"] .
                      "px; bottom:" .
                      $box["bottom"] .
                      "px; left:" .
                      $box["left"] .
                      'px;" />';
                  echo '<p class="c-blue fm">' . $box["slogan"] . "</p>";
                  echo '<h4 class="c-orange">' . $box["title"] . "</h4>";
                  echo "</div>";
                  echo "</a>";
              }
              echo "</div>";
          } ?>
     </div>
</div>

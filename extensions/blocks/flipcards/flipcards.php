<?php

// Support custom "anchor" values.
$anchor = "";
if (!empty($block["anchor"])) {
    $anchor = 'id="' . esc_attr($block["anchor"]) . '" ';
}
$hide = get_field("hide_block") ? "none" : "block";
$hide_on_mobile = get_field("hide_on_mobile") ? "sud__hide_on_mobile" : "";

// Load values and assign defaults.
$cards = get_field("cards") ?: null;
$type = get_field("type") ?: "type1";
$section_title = get_field("section_title") ?: "";

//---------------------- Gross ------------------------
if (!function_exists("cast_flipcard_type_1")) {
    function cast_flipcard_type_1($cards)
    {
        foreach ($cards as &$card) {
            $link = $card["link"] ?: "";
            echo $card["link"];
            if ($link) {
                echo '<a href="' . $link . '">';
            }
            echo '<div class="flipcard-container flipcard-container-t1">';
            echo '<div class="flipcard-inner-container flipcard-inner-container-t1">';
            // front
            echo '<div class="flipcard-front flipcard-front-t1 primatyBox" style="background-image: url(' .
                $card["image"] .
                ');">';

            //echo '<img src="'.$card['image'].'" alt="image-'.$card['title'].'"/>';
            echo '<h5 class="c-orange">' . $card["title"] . "</h5>";
            echo "</div>";
            // back
            echo '<div class="flipcard-back primatyBox">';
            echo '<h5 class="c-orange">' . $card["title_content"] . "</h5>";
            echo '<p class="c-blue fxs">' . $card["content"] . "</p>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            if ($link) {
                echo "</a>";
            }
        }
    }
}

//---------------------- Klein ------------------------
if (!function_exists("cast_flipcard_type_2")) {
    function cast_flipcard_type_2($cards)
    {
        $flag_color = get_field("flagcolor")
            ? "background-color:" . get_field("flagcolor") . ";"
            : "";
        $flag_text_color = get_field("flagtextcolor")
            ? "color:" . get_field("flagtextcolor") . ";"
            : "";

        foreach ($cards as &$card) {
            $flipclass =
                $card["title_content"] || $card["content"]
                    ? "flipcard-inner-container"
                    : "";
            $link = $card["link"] ?: "";
            if ($link) {
                echo '<a href="' . $link . '" target="_blank">';
            }
            echo '<div class="flipcard-container flipcard-container-t2">';
            echo '<div class="' . $flipclass . ' flipcard-inner-container-t2">';
            // front
            echo '<div class="flipcard-front flipcard-front-t2 primatyBox">';
            if ($card["flagtext"]) {
                echo '<div class="flipcard-flag" style="' .
                    $flag_color .
                    $flag_text_color .
                    '">' .
                    $card["flagtext"] .
                    "</div>";
            }
            echo '<img src="' .
                $card["image"] .
                '" alt="image-' .
                $card["title"] .
                '"/>';
            echo '<h5 class="c-orange">' . $card["title"] . "</h5>";
            echo "</div>";
            // back
            echo '<div class="flipcard-back primatyBox">';
            echo '<h5 class="c-orange">' . $card["title_content"] . "</h5>";
            echo '<p class="c-blue fxxs">' . $card["content"] . "</p>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            if ($link) {
                echo "</a>";
            }
        }
    }
}
?>
<div class="<?php echo $hide_on_mobile; ?>" style="display:<?php echo $hide; ?>">
     <div <?php echo $anchor; ?>class="flipcards-wrapper" style="min-height:200px; ">
          <h3 class="c-orange" style="width: 100%; text-align:center; margin-bottom:40px;"><?php echo $section_title; ?></h3>
          <?php if ($cards) {
              switch ($type) {
                  case "type1":
                      echo cast_flipcard_type_1($cards);
                      break;
                  case "type2":
                      echo cast_flipcard_type_2($cards);
                      break;
                  default:
                      echo "<h4>please choose type</h4>";
                      break;
              }
          } ?>
     </div>
</div>

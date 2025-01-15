<?php

// Support custom "anchor" values.
$anchor = "";
if (!empty($block["anchor"])) {
    $anchor = 'id="' . esc_attr($block["anchor"]) . '" ';
}

$hide = get_field("hide_block") ? "none" : "block";
$hide_on_mobile = get_field("hide_on_mobile") ? "sud__hide_on_mobile" : "";

// Load values and assign defaults.
$align = get_field("align") ?: "center";
$columns = get_field("columns") ?: "2-1";
$colstyle = [
    "left-width" => "61.8%",
    "right-width" => "38.2%",
];
switch ($columns) {
    case "1-2":
        $colstyle = [
            "left-width" => "38.2%",
            "right-width" => "61.8%",
        ];
        break;
    case "1-1":
        $colstyle = [
            "left-width" => "50%",
            "right-width" => "50%",
        ];
        break;
    case "2-1":
        $colstyle = [
            "left-width" => "61.8%",
            "right-width" => "38.2%",
        ];
        break;
    default:
        $colstyle = [
            "left-width" => "50%",
            "right-width" => "50%",
        ];
        break;
}
$leftComponents = get_field("components_left") ?: null;
$rightComponents = get_field("components_right") ?: null;

echo "<pre>";
//var_dump(get_field('components_left'));
echo "</pre>";
$container_l = get_field("components_left") ?: null;
$container_r = get_field("components_right") ?: null;

if (!function_exists("sud_cast_component")) {
    function sud_cast_component($component, $col)
    {
        $componentHTML = "";
        switch ($component["acf_fc_layout"]) {
            case "spacer":
                $componentHTML .=
                    '<div class="component-spacer" style="height: ' .
                    $component["height"] .
                    'px;" >';
                $componentHTML .= "</div>";
                break;
            case "title":
                $componentHTML .= '<div class="component-title">';
                $componentHTML .=
                    '<h3 class="c-blue-mid ' .
                    $component["font_size"] .
                    '" style="color: ' .
                    $component["font_color"] .
                    ';">' .
                    $component["title"] .
                    "</h3>";
                $componentHTML .= "</div>";
                break;
            case "image":
                $componentHTML .= '<figure class="component-image">';
                $componentHTML .=
                    '<img src="' .
                    $component["image"]["url"] .
                    '" alt="' .
                    $component["image"]["alt"] .
                    '">';
                $componentHTML .= "</figure>";
                break;
            case "video":
                $componentHTML .= '<div class="component-video">';
                $componentHTML .=
                    '<video poster="' . $component["thumbnail"] . '" controls>';
                $componentHTML .=
                    '<source src="' .
                    $component["videofiles"]["webm"] .
                    '" type="video/webm">';
                if ($component["videofiles"]["mp4"]) {
                    $componentHTML .=
                        '<source src="' .
                        $component["videofiles"]["mp4"] .
                        '" type="video/mp4">';
                }
                $componentHTML .= "</video>";
                $componentHTML .= "</div>";
                break;
            case "content":
                $componentHTML .= '<div class="component-paragraph">';
                $componentHTML .= $component["content"];
                $componentHTML .= "</div>";
                break;

            case "button":
                $btnIcon = $component["icon"]
                    ? '<img class="component-button-icon" src="' .
                        $component["icon"] .
                        '"/>'
                    : "";
                switch ($component["type"]) {
                    case "link":
                        $componentHTML .=
                            '<a class="component-button" href="' .
                            $component["buttonlink"]["url"] .
                            '" target="' .
                            $component["buttonlink"]["target"] .
                            '">';
                        $componentHTML .=
                            '<div class="' . $component["button_type"] . '">';
                        $componentHTML .= $btnIcon;
                        $componentHTML .=
                            "<p>" . $component["buttontext"] . "</p>";
                        $componentHTML .= "</div>";
                        $componentHTML .= "</a>";
                        break;
                    case "lb":
                        $targeting = "lb-target-" . rand(100, 999);
                        $componentHTML .= '<div class="component-button">';
                        $componentHTML .=
                            '<button class=" ' .
                            $component["button_type"] .
                            '" onclick="sudLightbox(\'' .
                            $targeting .
                            '\')">' .
                            $btnIcon .
                            $component["buttontext"] .
                            "</button>";
                        //CONTENT
                        $componentHTML .=
                            '<div class="lightbox-wrapper" lbtarget="' .
                            $targeting .
                            '">';
                        $componentHTML .=
                            '<div class="lightbox-close-layer" lbcloser="' .
                            $targeting .
                            '" ><img src="' .
                            get_template_directory_uri() .
                            '/assets/img/utils/close-cross.svg" alt=""></div>';
                        $componentHTML .= '<div class="lightbox-container" >';
                        $componentHTML .= '<div class="lightbox-content">';
                        $componentHTML .= $component["lightbox_content"];
                        $componentHTML .= "</div>";
                        $componentHTML .=
                            '<div class="lightbox-bg-element-01"></div>';
                        $componentHTML .=
                            '<div class="lightbox-bg-element-02"></div>';
                        $componentHTML .= "</div>";
                        $componentHTML .= "</div>";
                        $componentHTML .= "</div>";
                        break;
                }
                break;
            case "button_group":
                //var_dump($component);
                $flex = $component["flex"] ? "flex" : "block";
                $flexwrap = $component["wrap"] ? "wrap" : "nowrap";
                $gap = $component["gap"] ? strval($component["gap"]) : "0";
                $justifyContent = $component["justify_content"] ?: "";
                $alignItems = $component["align_items"] ?: "";
                //$btnIcon = $component["buttons"]['icon'] ? '<img class="component-button-icon" src="'. $component["buttons"]['icon'].'"/>' : '';
                $paddingTop = $component["padding"]["top"] ?: "0";
                $paddingRight = $component["padding"]["right"] ?: "0";
                $paddingBottom = $component["padding"]["bottom"] ?: "0";
                $paddingLeft = $component["padding"]["left"] ?: "0";
                $padding =
                    $paddingTop .
                    " " .
                    $paddingRight .
                    " " .
                    $paddingBottom .
                    " " .
                    $paddingLeft;

                $componentHTML .=
                    '<div class="component-button-group" style="display:' .
                    $flex .
                    "; flex-wrap:" .
                    $flexwrap .
                    "; justify-content:" .
                    $justifyContent .
                    "; align-items:" .
                    $alignItems .
                    "; gap:" .
                    $gap .
                    "px; padding: " .
                    $padding .
                    '">';
                foreach ($component["buttons"] as $button) {
                    switch ($button["type"]) {
                        case "link":
                            $componentHTML .=
                                '<a class="component-button" style="with:fit-content;" href="' .
                                $button["buttonlink"]["url"] .
                                '" target="' .
                                $button["buttonlink"]["target"] .
                                '">';
                            $componentHTML .=
                                '<div class="' .
                                $button["button_type"] .
                                '" style="margin:0;">';
                            //$componentHTML .= $btnIcon;
                            $componentHTML .=
                                '<p style="margin:unset;">' .
                                $button["buttontext"] .
                                "</p>";
                            $componentHTML .= "</div>";
                            $componentHTML .= "</a>";
                            break;
                        case "lb":
                            $targeting = "lb-target-" . rand(100, 999);
                            $componentHTML .=
                                '<div class="component-button" style="with:fit-content; margin:0;" >';
                            $componentHTML .=
                                '<button class=" ' .
                                $button["button_type"] .
                                ' fs" style="margin:0;" onclick="sudLightbox(\'' .
                                $targeting .
                                '\')">' .
                                $button["buttontext"] .
                                "</button>";
                            //CONTENT
                            $componentHTML .=
                                '<div class="lightbox-wrapper" lbtarget="' .
                                $targeting .
                                '">';
                            $componentHTML .=
                                '<div class="lightbox-close-layer" lbcloser="' .
                                $targeting .
                                '" ><img src="' .
                                get_template_directory_uri() .
                                '/assets/img/utils/close-cross.svg" alt=""></div>';
                            $componentHTML .=
                                '<div class="lightbox-container" >';
                            $componentHTML .= '<div class="lightbox-content">';
                            $componentHTML .= $button["lightbox_content"];
                            $componentHTML .= "</div>";
                            $componentHTML .=
                                '<div class="lightbox-bg-element-01"></div>';
                            $componentHTML .=
                                '<div class="lightbox-bg-element-02"></div>';
                            $componentHTML .= "</div>";
                            $componentHTML .= "</div>";
                            $componentHTML .= "</div>";
                            break;
                    }
                }
                $componentHTML .= "</div>";
                break;
            default:
                # code...
                break;
        }

        return $componentHTML;
    }
}
?>
<div class="<?php echo $hide_on_mobile; ?>" style="display:<?php echo $hide; ?>">

     <div <?php echo $anchor; ?>class="section-wrapper reveal" style="min-height:200px;">
          <!--Design Elements-->
          <div class="sud-bg-design">
               <div class="sud-bg-element-half-circle-01 sud-element-animation" style="display:none; right:-35vw; top:-55vw; width:120vw; height:120vw; transform: rotate(180deg);"></div>
          </div>

          <div class="sud-element" sud-shape="semicircle" style=" bottom:-15%; right:-20%; width:100vw; height:100vw;"></div>

          <div class="section-container" style="align-items:<?php echo $align; ?>">
          <?php
          //var_dump($container_r);
          $r_containerstyle = "";
          if ($container_r && array_key_exists("flex", $container_r)) {
              $r_flex = $container_r["flex"] ? "flex" : "block";
              $r_flexwrap = $container_r["wrap"] ? "wrap" : "nowrap";
              $r_direction = $container_r["direction"] ? "wrap" : "row";
              $r_gap = $container_r["gap"] ? strval($container_r["gap"]) : "0";
              $r_justifyContent = $container_r["justify_content"] ?: "";
              $r_alignItems = $container_r["align_items"] ?: "";
              $r_ptop = $container_r["padding"]["top"] ?: "unset";
              $r_pright = $container_r["padding"]["right"] ?: "unset";
              $r_pbottom = $container_r["padding"]["bottom"] ?: "unset";
              $r_pleft = $container_r["padding"]["left"] ?: "unset";

              $r_containerstyle =
                  "display:" .
                  $r_flex .
                  "; flex-wrap:" .
                  $r_flexwrap .
                  "; flex-direction:" .
                  $r_direction .
                  "; justify-content:" .
                  $r_justifyContent .
                  "; align-items:" .
                  $r_alignItems .
                  "; gap:" .
                  $r_gap .
                  "px; padding-top:" .
                  $r_ptop .
                  "; padding-right:" .
                  $r_pright .
                  "; padding-bottom:" .
                  $r_pbottom .
                  "; padding-left:" .
                  $r_pleft .
                  ";";
          }

          $l_containerstyle = "";

          if ($container_l && array_key_exists("flex", $container_l)) {
              $l_flex = $container_l["flex"] ? "flex" : "block";
              $l_flexwrap = $container_l["wrap"] ? "wrap" : "nowrap";
              $l_direction = $container_l["direction"] ? "wrap" : "row";
              $l_gap = $container_l["gap"] ? strval($container_l["gap"]) : "0";
              $l_justifyContent = $container_l["justify_content"] ?: "";
              $l_alignItems = $container_l["align_items"] ?: "";
              $l_ptop = $container_l["padding"]["top"] ?: "unset";
              $l_pright = $container_l["padding"]["right"] ?: "unset";
              $l_pbottom = $container_l["padding"]["bottom"] ?: "unset";
              $l_pleft = $container_l["padding"]["left"] ?: "unset";

              $l_containerstyle =
                  "display:" .
                  $l_flex .
                  "; flex-wrap:" .
                  $l_flexwrap .
                  "; flex-direction:" .
                  $l_direction .
                  "; justify-content:" .
                  $l_justifyContent .
                  "; align-items:" .
                  $l_alignItems .
                  "; gap:" .
                  $l_gap .
                  "px; padding-top:" .
                  $l_ptop .
                  "; padding-right:" .
                  $l_pright .
                  "; padding-bottom:" .
                  $l_pbottom .
                  "; padding-left:" .
                  $l_pleft .
                  ";";
          }
          ?>

               <div class="section-col section-col-l" style="width:<?php echo $colstyle[
                   "left-width"
               ] . $l_containerstyle; ?>; ">
                    <?php if ($leftComponents) {
                        foreach (
                            $leftComponents["components"]
                            as $leftComponent
                        ) {
                            echo sud_cast_component($leftComponent, "L");
                        }
                    } ?>
               </div>

               <div class="section-col section-col-r" style="width:<?php echo $colstyle[
                   "right-width"
               ] . $r_containerstyle; ?>; ">
                    <?php if ($rightComponents) {
                        foreach (
                            $rightComponents["components"]
                            as $rightComponent
                        ) {
                            echo sud_cast_component($rightComponent, "R");
                        }
                    } ?>
               </div>
          </div>

     </div>
</div>

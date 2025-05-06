<?php

// Support custom "anchor" values.
$anchor = "";
if (!empty($block["anchor"])) {
    $anchor = 'id="' . esc_attr($block["anchor"]) . '" ';
}
$hide = get_field("hide_block") ? "none" : "block";

$type = get_field("type") ?: "type1";

$data["title"] = get_field("title") ?: "Titel ";
$data["strapline"] = get_field("strapline") ?: "Titel ";
$data["subtitle"] = get_field("subtitle") ?: "Subtitle";
$data["text"] = get_field("text") ?: "";
$data["image"] = get_field("image") ?: null;
$data["video"] = get_field("video") ?: null;

$data["callToAction"] =
    get_field("call_to_action") && get_field("call_to_action")["text"]
        ? get_field("call_to_action")
        : null;
$data["button"] = get_field("button")["link"] ? get_field("button") : null;

//------------------------------------------------------
//---------------------- TYPE 1 ------------------------
//------------------------------------------------------
if (!function_exists("cast_hero_type_1")) {
    function cast_hero_type_1($data)
    {
        $hero_type_1 = "";

        //Background
        $hero_type_1 .= '<div class="hero-background">';
        if ($data["video"]["videofiles"]["webm"]) {
            $hero_type_1 .=
                '<video id="hero_video" poster="' .
                $data["video"]["thumbnail"] .
                '" autoplay muted loop>';
            $hero_type_1 .=
                '<source src="' .
                $data["video"]["videofiles"]["webm"] .
                '" type="video/webm">';
            if ($data["video"]["videofiles"]["mp4"]) {
                $hero_type_1 .=
                    '<source src="' .
                    $data["video"]["videofiles"]["mp4"] .
                    '" type="video/mp4">';
            }
            $hero_type_1 .= "</video>";
        }
        if ($data["image"]) {
            $hero_type_1 .=
                '<img src="' . $data["image"] . '" alt="hero-image" />';
        }
        $hero_type_1 .= "</div>";

        //Call to Action
        $hero_type_1 .= '<div class="hero-bg-element ">';
        if ($data["callToAction"]) {
            $hero_type_1 .=
                '<div class="hero-cta" style="background-color:' .
                $data["callToAction"]["color"] .
                ';">';
            $hero_type_1 .=
                '<h5 style="color:' .
                $data["callToAction"]["textcolor"] .
                '; text-align:center;">' .
                $data["callToAction"]["text"] .
                "</h5>";
            $hero_type_1 .= "</div>";
        }
        $hero_type_1 .= "</div>";

        //Content
        $hero_type_1 .= '<div class="hero-content-container">';
        $hero_type_1 .= '<h1 class="fl c-orange">' . $data["title"] . "</h1>";
        $hero_type_1 .=
            '<h3 class="fs c-blue gtalpina">' . $data["subtitle"] . "</h3>";
        if ($data["button"]) {
            $hero_type_1 .=
                '<a href="' .
                $data["button"]["link"]["url"] .
                '"><button class="">' .
                $data["button"]["buttontext"] .
                "</button></a>";
        }
        $hero_type_1 .= "</div>";

        return $hero_type_1;
    }
}

//------------------------------------------------------
//---------------------- TYPE 2 ------------------------
//------------------------------------------------------
if (!function_exists("cast_hero_type_2")) {
    function cast_hero_type_2($data)
    {
        $hero_type_2 = "";
        $hero_type_2 .= '<div class="hero-t2-container">';

        $hero_type_2 .= '<div class="hero-col hero-col-left">';
        // ELEMENT
        $hero_type_2 .=
            '<div class="hero-t2-bg-element bg-blue-ultra-light"></div>';

        $hero_type_2 .= '<figure class="hero-t2-media" >';
        /* image */
        if ($data["image"] && !$data["video"]["videofiles"]["webm"]) {
            $hero_type_2 .=
                '<img src="' .
                $data["image"] .
                '" alt="hero-image-' .
                $data["title"] .
                '">';
        }
        /* Video */
        if ($data["video"]["videofiles"]["webm"]) {
            $hero_type_2 .=
                '<video id="hero_video" poster="' .
                $data["video"]["thumbnail"] .
                '" autoplay muted loop>';
            $hero_type_2 .=
                '<source src="' .
                $data["video"]["videofiles"]["webm"] .
                '" type="video/webm"/>';
            if ($data["video"]["videofiles"]["mp4"]) {
                $hero_type_2 .=
                    '<source src="' .
                    $data["video"]["videofiles"]["mp4"] .
                    '" type="video/mp4"/>';
            }
            $hero_type_2 .= "</video>";
        }
        $hero_type_2 .= "</figure>";
        $hero_type_2 .= "</div>";

        $hero_type_2 .= '<div class="hero-col hero-col-right">';
        $hero_type_2 .= '<h2 class="c-orange fl">' . $data["title"] . "</h2>";
        $hero_type_2 .= '<p class="c-blue">' . $data["text"] . "</p>";
        if ($data["button"]) {
            $hero_type_2 .=
                '<a href="' .
                $data["button"]["link"]["url"] .
                '"><button class="">' .
                $data["button"]["buttontext"] .
                "</button></a>";
        }
        $hero_type_2 .= "</div>";
        $hero_type_2 .= "</div>";

        return $hero_type_2;
    }
}

//------------------------------------------------------
//---------------------- TYPE 3 ------------------------
//------------------------------------------------------
if (!function_exists("cast_hero_type_3")) {
    function cast_hero_type_3($data)
    {
        $hero_type_1 = "";

        //Background
        $hero_video = '<div class="sud__hero_video">';
        if ($data["video"]["videofiles"]["webm"]) {
            $hero_video .=
                '<video id="hero_video" poster="' .
                $data["video"]["thumbnail"] .
                '" autoplay muted loop>';
            $hero_video .=
                '<source src="' .
                $data["video"]["videofiles"]["webm"] .
                '" type="video/webm">';
            if ($data["video"]["videofiles"]["mp4"]) {
                $hero_video .=
                    '<source src="' .
                    $data["video"]["videofiles"]["mp4"] .
                    '" type="video/mp4">';
            }
            $hero_video .= "</video>";
        }
        if ($data["image"]) {
            $hero_video .=
                '<img src="' . $data["image"] . '" alt="hero-image" />';
        }
        $hero_video .= "</div>";

        $hero_type_1 .= '<div class="sud__hero_wrapper">';
        $hero_type_1 .= '<div class="sud__hero_container">';

        //Content
        $hero_type_1 .= '<div class="sud__hero_text">';
        $hero_type_1 .= '<h1 class="fl c-orange">' . $data["title"] . "</h1>";
        $hero_type_1 .=
            '<h3 class="fs c-blue gtalpina">' . $data["subtitle"] . "</h3>";
        if ($data["button"]) {
            $hero_type_1 .=
                '<a href="' .
                $data["button"]["link"]["url"] .
                '"><button class="">' .
                $data["button"]["buttontext"] .
                "</button></a>";
        }
        $hero_type_1 .= "</div>";

        $hero_type_1 .= $hero_video;

        $hero_type_1 .= "</div>";

        $hero_type_1 .= "</div>";

        $hero_type_1 .=
            '<div class="sud__background_element" style="display:none;">';

        $hero_type_1 .= '<svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 1913 1069.9" style="enable-background:new 0 0 1913 1069.9;" xml:space="preserve">';
        $hero_type_1 .= '<style type="text/css">
	.st0{fill:none;stroke:#1582BE;stroke-miterlimit:10;}
	.st1{fill:none;stroke:#1582BE;stroke-miterlimit:10;stroke-dasharray:229.6844,45.9369;}
	.st2{fill:none;stroke:#1582BE;stroke-miterlimit:10;stroke-dasharray:271.705,54.341;}
	.st3{fill:none;stroke:#1582BE;stroke-miterlimit:10;stroke-dasharray:226.0379,45.2076;}
        </style>';
        $hero_type_1 .= "<g>";
        $hero_type_1 .= "<g>";
        $hero_type_1 .=
            '<polyline class="st0" points="110.2,451.1 1.4,389.6 123.9,364.6"/>';
        $hero_type_1 .=
            '<line class="st1" x1="168.9" y1="355.5" x2="1766.9" y2="30.2"/>';
        $hero_type_1 .=
            '<polyline class="st0" points="1789.4,25.7 1911.9,0.7 1842.8,104.9"/>';
        $hero_type_1 .=
            '<line class="st2" x1="1812.7" y1="150.1" x2="1286.8" y2="942.5"/>';
        $hero_type_1 .=
            '<polyline class="st0" points="1271.8,965.1 1202.6,1069.2 1093.8,1007.7"/>';
        $hero_type_1 .=
            '<line class="st3" x1="1054.5" y1="985.4" x2="129.9" y2="462.2"/>';
        $hero_type_1 .= "</g>";
        $hero_type_1 .= "</g>";
        $hero_type_1 .= "</svg>";
        $hero_type_1 .= "</div>";

        return $hero_type_1;
    }
}

//------------------------------------------------------
//---------------------- TYPE 4 ------------------------
//------------------------------------------------------
if (!function_exists("cast_hero_type_4")) {
    function cast_hero_type_4($data)
    {
        $hero_type_4 = "";

        //Background

        $hero_video = '<div class="sud__hero_video">';

        if ($data["video"]["videofiles"]["webm"]) {
            $hero_video .=
                '<video id="hero_video" poster="' .
                $data["video"]["thumbnail"] .
                '" autoplay muted loop>';
            $hero_video .=
                '<source src="' .
                $data["video"]["videofiles"]["webm"] .
                '" type="video/webm">';
            if ($data["video"]["videofiles"]["mp4"]) {
                $hero_video .=
                    '<source src="' .
                    $data["video"]["videofiles"]["mp4"] .
                    '" type="video/mp4">';
            }
            $hero_video .= "</video>";
        }
        if ($data["image"]) {
            $hero_video .=
                '<img src="' . $data["image"] . '" alt="hero-image" />';
        }
        $hero_video .= "</div>";

        //HERO
        $hero_type_4 .= '<div class="sud__hero_wrapper">';
        $hero_type_4 .= '<div class="sud__hero_container sud__hero_type_4">';

        //Content
        $hero_type_4 .= '<div class="sud__hero_text">';
        $hero_type_4 .=
            '<p class="sud__hero_strapline ">' . $data["strapline"] . "</p>";
        $hero_type_4 .= '<h1 class="fl c-orange">' . $data["title"] . "</h1>";
        $hero_type_4 .=
            '<h3 class="fs c-blue gtalpina">' . $data["subtitle"] . "</h3>";
        if ($data["button"]) {
            $hero_type_4 .=
                '<a href="' .
                $data["button"]["link"]["url"] .
                '"><button class="">' .
                $data["button"]["buttontext"] .
                "</button></a>";
        }
        $hero_type_4 .= "</div>";

        if ($data["image"] && !$data["video"]["videofiles"]["webm"]) {
            $hero_type_4 .= '<div class="sud__hero_image">';
            $hero_type_4 .=
                '<img src="' .
                $data["image"] .
                '" alt="hero-image-' .
                $data["title"] .
                '">';
            $hero_type_4 .= "</div>";
        }

        if ($data["video"]["videofiles"]["webm"]) {
            $hero_type_4 .= $hero_video;
        }

        $hero_type_4 .= "</div>";

        $hero_type_4 .= "</div>";

        return $hero_type_4;
    }
}

//-------------------------------------------
//-----------------OUTPUT--------------------
//-------------------------------------------
echo '<div style="display: ' . $hide . ';">';
switch ($type) {
    case "type1":
        echo "<div " .
            $anchor .
            ' class="hero-wrapper hero-wrapper-t3" style="min-height:200px;">';
        echo cast_hero_type_1($data);
        echo "</div>";
        break;
    case "type2":
        echo "<div " .
            $anchor .
            ' class="hero-wrapper hero-wrapper-t2" style="min-height:200px;">';
        echo cast_hero_type_2($data);
        echo "</div>";
        break;
    case "type3":
        echo "<div " . $anchor . ' class=" " style="min-height:200px;">';
        echo cast_hero_type_3($data);
        echo "</div>";
        break;
    case "type4":
        echo "<div " . $anchor . ' class=" " style="min-height:200px;">';
        echo cast_hero_type_4($data);
        echo "</div>";
        break;

    default:
        echo "<div " .
            $anchor .
            ' class="hero-wrapper" style="min-height:200px;">';
        echo cast_hero_type_1($data);
        echo "</div>";
        break;
}
echo "</div>";
?>

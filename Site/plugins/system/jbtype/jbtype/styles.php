<?php
defined("_JEXEC") or die ("Restricted Access");

$uriBase = JURI::base(true);

$jbTypeStyles = array(
	"core" => array(
		// Boxes
		"jb_blackbox"  => ".jb_blackbox {border: 1px solid #ddd;border-left: 8px solid #333;padding: 8px;background: #fafafa;margin: 10px 0 20px}\n" ,
		"jb_greenbox"  => ".jb_greenbox {border: 1px solid #ddd;border-left: 8px solid #CDD452;padding: 8px;background: #fafafa;margin: 10px 0 20px}" ,
		"jb_bluebox"   => ".jb_bluebox {border: 1px solid #ddd;border-left: 8px solid #417378;padding: 8px;background: #fafafa;margin: 10px 0 20px}" ,
		"jb_redbox"    => ".jb_redbox {border: 1px solid #ddd;border-left: 8px solid #521218;padding: 8px;background: #fafafa;margin: 10px 0 20px}" ,
		"jb_yellowbox" => ".jb_yellowbox {border: 1px solid #ddd;border-left: 8px solid #F2F096;padding: 8px;background: #fafafa;margin: 10px 0 20px}" ,
		"jb_brownbox"  => ".jb_brownbox {border: 1px solid #ddd;border-left: 8px solid #B05A3A;padding: 8px;background: #fafafa;margin: 10px 0 20px}" ,
		"jb_purplebox" => ".jb_purplebox {border: 1px solid #ddd;border-left: 8px solid #7F176B;padding: 8px;background: #fafafa;margin: 10px 0 20px}" ,

		// Typography
		"jb_dropcap" => "span.jb_dropcap {font-size:80px;display:block;float:left;padding:24px 16px 16px 0;margin:0;color: #666;font-family: georgia;}" ,

		// Layout
		"jb_left45"  => ".jb_left45 {float: left;width: 45%;margin: 30px 10px 30px 0;border: 1px solid #eee;border-width: 8px 0;padding: 10px 0}" ,
		"jb_right45" => ".jb_right45 {float: right;width: 45%;margin: 30px 10px 30px 0;border: 1px solid #eee;border-width: 8px 0;padding: 10px 0}" ,
		"jb_clear"   => ".jbclear {clear: both;height: 20px}",

		// Spans
		"jb_black"  => "span.jb_black {color: #000}" ,
		"jb_blue"   => "span.jb_blue {color: #417378}" ,
		"jb_red"    => "span.jb_red {color: #521218}" ,
		"jb_green"  => "span.jb_green {color: #CDD452}" ,
		"jb_yellow" => "span.jb_yellow {color: #F2F096}" ,
		"jb_white"  => "span.jb_white {color: #ddd}" ,
		"jb_brown"  => "span.jb_brown,li.jb_brown {color: #B05A3A}" ,
		"jb_purple" => "span.jb_purple {color: #7F176B}" ,
		
		"jb_img"  => '' ,
		"zenbutton"  => '' ,
		"jb_i"    => '' ,
		"jb_b"    => '' ,
		"jb_span" => '' ,
		"jb_br"   => '' ,
		"jb_breakout"   => '' ,
		"jb_action"   => '' ,
		'grid1'  => '' ,
		'grid2'  => '' ,
		'grid3'  => '' ,
		'grid4'  => '' ,
		'grid5'  => '' ,
		'grid6'  => '' ,
		'grid7'  => '' ,
		'grid8'  => '' ,
		'grid9'  => '' ,
		'grid10'  => '' ,
		'grid11'  => '' ,
		'grid12'  => '' ,
			
		// ZenlastStyle
		'grid1_last'  => '' ,
		'grid2_last'  => '' ,
		'grid3_last'  => '' ,
		'grid4_last'  => '' ,
		'grid5_last'  => '' ,
		'grid6_last'  => '' ,
		'grid7_last'  => '' ,
		'grid8_last'  => '' ,
		'grid9_last'  => '' ,
		'grid10_last' => '' ,
		'grid11_last' => '' ,
		'grid12_last' => '' ,

		
		// Lists
		"jb_listblack"  => "ul.jb_black li{list-style-type:none;padding:4px 0 4px 16px;background: url(".$uriBase."/media/jbtype/images/coquette/black.png) no-repeat left center;}" ,
		"jb_listblue"   => "ul.jb_blue li{list-style-type:none;padding:4px 0 4px 16px;background: url(".$uriBase."/media/jbtype/images/coquette/blue.png) no-repeat left center;}" ,
		"jb_listred"    => "ul.jb_red li{list-style-type:none;padding:4px 0 4px 16px;background: url(".$uriBase."/media/jbtype/images/coquette/red.png) no-repeat left center;}" ,
		"jb_listgreen"  => "ul.jb_green li{list-style-type:none;padding:4px 0 4px 16px;background: url(".$uriBase."/media/jbtype/images/coquette/green.png) no-repeat left center;}" ,
		"jb_listyellow" => "ul.jb_yellow li{list-style-type:none;padding:4px 0 4px 16px;background: url(".$uriBase."/media/jbtype/images/coquette/yellow.png) no-repeat left center;}",
		"jb_listwhite"  => "ul.jb_white li{list-style-type:none;padding:4px 0 4px 16px;background: url(".$uriBase."/media/jbtype/images/coquette/white.png) no-repeat left center;}" ,
		"jb_listbrown"  => "ul.jb_brown li{list-style-type:none;padding:4px 0 4px 16px;background: url(".$uriBase."/media/jbtype/images/coquette/brown.png) no-repeat left center;}" ,
		"jb_listpurple" => "ul.jb_purple li{list-style-type:none;padding:4px 0 4px 16px;background: url(".$uriBase."/media/jbtype/images/coquette/purple.png) no-repeat left center;}" ,
		
		
		// Discs
		"jb_bluedisc"     => "span.jb_bluedisc {background: url(".$uriBase."/media/jbtype/images/discs/blue.png) no-repeat left top;font-size:1.4em;text-align: center;margin-right: 10px;padding-top:9px;color:#fff;display: block;float: left;width:40px;height:40px}" ,
		"jb_greendisc"    => "span.jb_greendisc {background: url(".$uriBase."/media/jbtype/images/discs/green.png) no-repeat left top;font-size:1.4em;text-align: center;margin-right: 10px;padding-top:9px;color:#fff;display: block;float: left;width:40px;height:40px}" ,
		"jb_reddisc"      => "span.jb_reddisc {background: url(".$uriBase."/media/jbtype/images/discs/red.png) no-repeat left top;font-size:1.4em;text-align: center;margin-right: 10px;padding-top:9px;color:#fff;display: block;float: left;width:40px;height:40px}" ,
		"jb_browndisc"    => "span.jb_browndisc {background: url(".$uriBase."/media/jbtype/images/discs/brown.png) no-repeat left top;font-size:1.4em;text-align: center;margin-right: 10px;padding-top:9px;color:#fff;display: block;float: left;width:40px;height:40px}" ,
		"jb_greydisc"     => "span.jb_greydisc {background: url(".$uriBase."/media/jbtype/images/discs/grey.png) no-repeat left top;font-size:1.4em;text-align: center;margin-right: 10px;padding-top:9px;color:#fff;display: block;float: left;width:40px;height:40px}" ,
		"jb_charcoaldisc" => "span.jb_charcoaldisc {background: url(".$uriBase."/media/jbtype/images/discs/charcoal.png) no-repeat left top;font-size:1.4em;text-align: center;margin-right: 10px;padding-top:9px;color:#fff;display: block;float: left;width:40px;height:40px}" ,
		"jb_purpledisc"   => "span.jb_purpledisc {background: url(".$uriBase."/media/jbtype/images/discs/purple.png) no-repeat left top;font-size:1.4em;text-align: center;margin-right: 10px;padding-top:9px;color:#fff;display: block;float: left;width:40px;height:40px}" ,
		"jb_orangedisc"   => "span.jb_orangedisc {background: url(".$uriBase."/media/jbtype/images/discs/orange.png) no-repeat left top;font-size:1.4em;text-align: center;margin-right: 10px;padding-top:9px;color:#fff;display: block;float: left;width:40px;height:40px}" ,
		"jb_yellowdisc"   => "span.jb_yellowdisc {background: url(".$uriBase."/media/jbtype/images/discs/yellow.png) no-repeat left top;font-size:1.4em;text-align: center;margin-right: 10px;padding-top:9px;color:#fff;display: block;float: left;width:40px;height:40px}" ,
		"jb_blackdisc"    => "span.jb_blackdisc {background: url(".$uriBase."/media/jbtype/images/discs/black.png) no-repeat left top;font-size:1.4em;text-align: center;margin-right: 10px;padding-top:9px;color:#fff;display: block;float: left;width:40px;height:40px}" ,
		

		// iconic_ Icons
		"jb_iconic_download"  => ".jb_iconic_download {background: url(".$uriBase."/media/jbtype/images/iconic/allicons.png) no-repeat 0 -87px;display:block;height:20px;width:20px;float:left;margin-right:10px}" ,
		"jb_iconic_info"      => ".jb_iconic_info {background: url(".$uriBase."/media/jbtype/images/iconic/allicons.png) no-repeat 0 -160px;display:block;height:20px;width:20px;float:left;margin-right:10px}" ,
		"jb_iconic_star"      => ".jb_iconic_star {background: url(".$uriBase."/media/jbtype/images/iconic/allicons.png) no-repeat 0 -238px;display:block;height:20px;width:20px;float:left;margin-right:10px}" ,
		"jb_iconic_heart"     => ".jb_iconic_heart {background: url(".$uriBase."/media/jbtype/images/iconic/allicons.png) no-repeat 0 -160px;display:block;height:20px;width:20px;float:left;margin-right:10px}" ,
		"jb_iconic_tag"       => ".jb_iconic_tag {background: url(".$uriBase."/media/jbtype/images/iconic/allicons.png) no-repeat 0 -396px;display:block;height:20px;width:20px;float:left;margin-right:10px}" ,
		"jb_iconic_arrival"   => ".jb_iconic_arrival {background: url(".$uriBase."/media/jbtype/images/iconic/allicons.png) no-repeat 0 -477px;display:block;height:20px;width:20px;float:left;margin-right:10px}" ,
		"jb_iconic_truck"     => ".jb_iconic_truck {background: url(".$uriBase."/media/jbtype/images/iconic/allicons.png) no-repeat 0 -554px;display:block;height:20px;width:20px;float:left;margin-right:10px}" ,
		"jb_iconic_arrow"     => ".jb_iconic_arrow {background: url(".$uriBase."/media/jbtype/images/iconic/allicons.png) no-repeat 0 -637px;display:block;height:20px;width:20px;float:left;margin-right:10px}" ,
		"jb_iconic_article"   => ".jb_iconic_article {background: url(".$uriBase."/media/jbtype/images/iconic/allicons.png) no-repeat 0 -716px;display:block;height:20px;width:20px;float:left;margin-right:10px}" ,
		"jb_iconic_email"     => ".jb_iconic_email {background: url(".$uriBase."/media/jbtype/images/iconic/allicons.png) no-repeat 0 -796px;display:block;height:20px;width:20px;float:left;margin-right:10px}" ,
		"jb_iconic_beaker"    => ".jb_iconic_beaker {background: url(".$uriBase."/media/jbtype/images/iconic/allicons.png) no-repeat 0 -878px;display:block;height:20px;width:20px;float:left;margin-right:10px}" ,
		"jb_iconic_bolt"      => ".jb_iconic_bolt {background: url(".$uriBase."/media/jbtype/images/iconic/allicons.png) no-repeat 0 -956px;display:block;height:20px;width:20px;float:left;margin-right:10px}" ,
		"jb_iconic_book"      => ".jb_iconic_book {background: url(".$uriBase."/media/jbtype/images/iconic/allicons.png) no-repeat 0 -1036px;display:block;height:20px;width:20px;float:left;margin-right:10px}" ,
		"jb_iconic_box"       => ".jb_iconic_box {background: url(".$uriBase."/media/jbtype/images/iconic/allicons.png) no-repeat 0 -1117px;display:block;height:20px;width:20px;float:left;margin-right:10px}" ,
		"jb_iconic_calendar"  => ".jb_iconic_calendar {background: url(".$uriBase."/media/jbtype/images/iconic/allicons.png) no-repeat 0 -1198px;display:block;height:20px;width:20px;float:left;margin-right:10px}" ,
		"jb_iconic_comment"   => ".jb_iconic_comment {background: url(".$uriBase."/media/jbtype/images/iconic/allicons.png) no-repeat 0 -1276px;display:block;height:20px;width:20px;float:left;margin-right:10px}" ,
		"jb_iconic_tick"      => ".jb_iconic_tick {background: url(".$uriBase."/media/jbtype/images/iconic/allicons.png) no-repeat 0 -1355px;display:block;height:20px;width:20px;float:left;margin-right:10px}" ,
		"jb_iconic_cloud"     => ".jb_iconic_cloud {background: url(".$uriBase."/media/jbtype/images/iconic/allicons.png) no-repeat 0 -1434px;display:block;height:20px;width:20px;float:left;margin-right:10px}" ,
		"jb_iconic_document"  => ".jb_iconic_document {background: url(".$uriBase."/media/jbtype/images/iconic/allicons.png) no-repeat 0 -1517px;display:block;height:20px;width:20px;float:left;margin-right:10px}" ,
		"jb_iconic_image"     => ".jb_iconic_image {background: url(".$uriBase."/media/jbtype/images/iconic/allicons.png) no-repeat 0 -1597px;display:block;height:20px;width:20px;float:left;margin-right:10px}" ,
		"jb_iconic_quote"     => ".jb_iconic_quote {background: url(".$uriBase."/media/jbtype/images/iconic/allicons.png) no-repeat 0 -1678px;display:block;height:20px;width:20px;float:left;margin-right:10px}" ,
		"jb_iconic_lightbulb" => ".jb_iconic_lightbulb {background: url(".$uriBase."/media/jbtype/images/iconic/allicons.png) no-repeat 0 -1756px;display:block;height:20px;width:20px;float:left;margin-right:10px}" ,
		"jb_iconic_search"    => ".jb_iconic_search {background: url(".$uriBase."/media/jbtype/images/iconic/allicons.png) no-repeat 0 -1836px;display:block;height:20px;width:20px;float:left;margin-right:10px}" ,
		"jb_iconic_mail"      => ".jb_iconic_mail {background: url(".$uriBase."/media/jbtype/images/iconic/allicons.png) no-repeat 0 -1914px;display:block;height:20px;width:20px;float:left;margin-right:10px}" ,
		"jb_iconic_dash"      => ".jb_iconic_dash {background: url(".$uriBase."/media/jbtype/images/iconic/allicons.png) no-repeat 0 -1991px;display:block;height:20px;width:20px;float:left;margin-right:10px}" ,
		"jb_iconic_movie"     => ".jb_iconic_movie {background: url(".$uriBase."/media/jbtype/images/iconic/allicons.png) no-repeat 0 -2076px;display:block;height:20px;width:20px;float:left;margin-right:10px}"
		),
	"coquette" => array(
		
		// Typography
		"jb_quote"      => "blockquote {font-size: 1.5em;line-height: 1.5em;font-style: italic;font-family: georgia;padding-left: 50px;background: url(".$uriBase."/media/jbtype/images/coquette/quoteL.png) no-repeat;padding-right: 30px;margin-bottom: 30px}\n blockquote p {background: url(".$uriBase."/media/jbtype/images/coquette/quoteR.png) no-repeat right bottom;}" ,
		"jb_quoteleft"  => ".jb_quoteleft {font-size: 1.5em;line-height: 1.5em;font-style: italic;font-family: georgia;padding-left: 50px;background: url(".$uriBase."/media/jbtype/images/coquette/quoteL.png) no-repeat;float: left;width: 40%;margin: 0 30px 30px 0}\n .jb_quoteleft p {background: url(".$uriBase."/media/jbtype/images/coquette/quoteR.png) no-repeat right bottom;margin: 0;}" ,
		"jb_quoteright" => ".jb_quoteright {font-size: 1.5em;line-height: 1.5em;font-style: italic;font-family: georgia;padding-left: 50px;background: url(".$uriBase."/media/jbtype/images/coquette/quoteL.png) no-repeat;float: right;width: 40%;margin: 0 0 30px 30px;}\n .jb_quoteright p {background: url(".$uriBase."/media/jbtype/images/coquette/quoteR.png) no-repeat right bottom;margin: 0;}" ,
			"jb_author"      => "span.jb_author {font-size:90%;display:block;text-align:right;font-style:italic;margin:10px 0}" ,
		
	
		// Icons
		"jb_new"           => ".jb_new {background: url(".$uriBase."/media/jbtype/images/coquette/new.png) no-repeat left center;padding: 20px 0 20px 60px;display:block} " ,
		"jb_code"          => ".jb_code {font-family: georgia;background: url(".$uriBase."/media/jbtype/images/coquette/code.png) no-repeat left center;padding: 20px 20px 20px 80px;display: block;} " ,
		"jb_attachment"    => ".jb_attachment {background: url(".$uriBase."/media/jbtype/images/coquette/attachment.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;} " ,
		"jb_calculator"    => ".jb_calculator {background: url(".$uriBase."/media/jbtype/images/coquette/calculator.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;} " ,
		"jb_cut"           => ".jb_cut {background: url(".$uriBase."/media/jbtype/images/coquette/cut.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;} " ,
		"jb_dollar"        => ".jb_dollar {background: url(".$uriBase."/media/jbtype/images/coquette/dollar_currency_sign.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;} " ,
		"jb_euro"          => ".jb_euro {background: url(".$uriBase."/media/jbtype/images/coquette/euro_currency_sign.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;} " ,
		"jb_pound"         => ".jb_pound {background: url(".$uriBase."/media/jbtype/images/coquette/sterling_pound_currency_sign.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;} " ,
		"jb_support"       => ".jb_support {background: url(".$uriBase."/media/jbtype/images/coquette/support.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;} " ,
		"jb_next"          => ".jb_next {background: url(".$uriBase."/media/jbtype/images/coquette/next.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;} " ,
		"jb_previous"      => ".jb_previous {background: url(".$uriBase."/media/jbtype/images/coquette/previous.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;} " ,
		"jb_cart"          => ".jb_cart {background: url(".$uriBase."/media/jbtype/images/coquette/cart.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;} " ,
		"jb_save"          => ".jb_save {background: url(".$uriBase."/media/jbtype/images/coquette/save.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;} " ,
		"jb_sound"         => ".jb_sound {background: url(".$uriBase."/media/jbtype/images/coquette/sound.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;} " ,
		"jb_info"          => ".jb_info {background: url(".$uriBase."/media/jbtype/images/coquette/info.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;} " ,
		"jb_warning"       => ".jb_warning {background: url(".$uriBase."/media/jbtype/images/coquette/warning.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;} " ,
		"jb_camera"        => ".jb_camera {background: url(".$uriBase."/media/jbtype/images/coquette/camera.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;} " ,
		"jb_comment"       => ".jb_comment {background: url(".$uriBase."/media/jbtype/images/coquette/comment.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;}" ,
		"jb_chat"          => ".jb_chat {background: url(".$uriBase."/media/jbtype/images/coquette/chat.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;}" ,
		"jb_document"      => ".jb_document {background: url(".$uriBase."/media/jbtype/images/coquette/document.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;}" ,
		"jb_accessible"    => ".jb_accessible {background: url(".$uriBase."/media/jbtype/images/coquette/accessible.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;}" ,
		"jb_star"          => ".jb_star {background: url(".$uriBase."/media/jbtype/images/coquette/star.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;}" ,
		"jb_heart"         => ".jb_heart {background: url(".$uriBase."/media/jbtype/images/coquette/heart.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;}" ,
		"jb_iconic_heart"  => ".jb_iconic_heart {background: url(".$uriBase."/media/jbtype/images/iconic/allicons.png) no-repeat 0 -316px;padding: 2px 0 2px 30px;display:block;}" ,
		"jb_mail"          => ".jb_mail {background: url(".$uriBase."/media/jbtype/images/coquette/mail.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;}" ,
		"jb_film"          => ".jb_film {background: url(".$uriBase."/media/jbtype/images/coquette/film.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;}" ,
		"jb_pin"           => ".jb_pin {background: url(".$uriBase."/media/jbtype/images/coquette/pin.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;}" ,
		"jb_recycle"       => ".jb_recycle {background: url(".$uriBase."/media/jbtype/images/coquette/recycle.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;}" ,
		"jb_lightbulb"     => ".jb_lightbulb {background: url(".$uriBase."/media/jbtype/images/coquette/light_bulb.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;}"
		),
	
	"orangesticker" => array(
	
		// Typography
		"jb_quote"      => "blockquote {font-size: 1.5em;line-height: 1.5em;font-style: italic;font-family: georgia;padding-left: 50px;background: url(".$uriBase."/media/jbtype/images/orangesticker/quoteL.png) no-repeat;padding-right: 30px;margin-bottom: 30px}\n blockquote p {background: url(".$uriBase."/media/jbtype/images/orangesticker/quoteR.png) no-repeat right bottom;}" ,
		"jb_quoteleft"  => ".jb_quoteleft {font-size: 1.5em;line-height: 1.5em;font-style: italic;font-family: georgia;padding-left: 50px;background: url(".$uriBase."/media/jbtype/images/orangesticker/quoteL.png) no-repeat;float: left;width: 40%;margin: 0 30px 30px 0}\n .jb_quoteleft p {background: url(".$uriBase."/media/jbtype/images/orangesticker/quoteR.png) no-repeat right bottom;margin: 0;}" ,
		"jb_quoteright" => ".jb_quoteright {font-size: 1.5em;line-height: 1.5em;font-style: italic;font-family: georgia;padding-left: 50px;background: url(".$uriBase."/media/jbtype/images/orangesticker/quoteL.png) no-repeat;float: right;width: 40%;margin: 0 0 30px 30px;}\n .jb_quoteright p {background: url(".$uriBase."/media/jbtype/images/orangesticker/quoteR.png) no-repeat right bottom;margin: 0;}" ,
		
		// Icons 
		"jb_new"        => ".jb_new {background: url(".$uriBase."/media/jbtype/images/orangesticker/new.png) no-repeat left center;padding: 20px 0 20px 60px;display:block}",
		"jb_code"       => ".jb_code {font-family: georgia;background: url(".$uriBase."/media/jbtype/images/orangesticker/code.png) no-repeat left center;padding: 20px 20px 20px 80px;display:block}",
		"jb_attachment" => ".jb_attachment {background: url(".$uriBase."/media/jbtype/images/orangesticker/attachment.png) no-repeat left center;padding: 20px 0 20px 60px;;display:block}",
		"jb_calculator" => ".jb_calculator {background: url(".$uriBase."/media/jbtype/images/orangesticker/calculator.png) no-repeat left center;padding: 20px 0 20px 60px;;display:block}",
		"jb_cut"        => ".jb_cut {background: url(".$uriBase."/media/jbtype/images/orangesticker/cut.png) no-repeat left center;padding: 20px 0 20px 60px;;display:block}",
		"jb_dollar"     => ".jb_dollar {background: url(".$uriBase."/media/jbtype/images/orangesticker/dollar_currency_sign.png) no-repeat left center;padding: 20px 0 20px 60px;;display:block}",
		"jb_euro"       => ".jb_euro {background: url(".$uriBase."/media/jbtype/images/orangesticker/euro_currency_sign.png) no-repeat left center;padding: 20px 0 20px 60px;;display:block}",
		"jb_pound"      => ".jb_pound {background: url(".$uriBase."/media/jbtype/images/orangesticker/sterling_pound_currency_sign.png) no-repeat left center;padding: 20px 0 20px 60px;;display:block}",
		"jb_mail"       => ".jb_mail {background: url(".$uriBase."/media/jbtype/images/orangesticker/mail.png) no-repeat left center;padding: 20px 0 20px 60px;display:block}",
		"jb_save"       => ".jb_save {background: url(".$uriBase."/media/jbtype/images/orangesticker/save.png) no-repeat left center;padding: 20px 0 20px 60px;;display:block}",
		"jb_sound"      => ".jb_sound {background: url(".$uriBase."/media/jbtype/images/orangesticker/sound.png) no-repeat left center;padding: 20px 0 20px 60px;;display:block}",
		"jb_support"    => ".jb_support {background: url(".$uriBase."/media/jbtype/images/orangesticker/support.png) no-repeat left center;padding: 20px 0 20px 60px;display:block}",
		"jb_next"       => ".jb_next {background: url(".$uriBase."/media/jbtype/images/orangesticker/next.png) no-repeat left center;padding: 20px 0 20px 60px;;display:block}",
		"jb_previous"   => ".jb_previous {background: url(".$uriBase."/media/jbtype/images/orangesticker/previous.png) no-repeat left center;padding: 20px 0 20px 60px;display:block}",
		"jb_cart"       => ".jb_cart {background: url(".$uriBase."/media/jbtype/images/orangesticker/cart.png) no-repeat left center;padding: 20px 0 20px 60px;display:block}",
		"jb_info"       => ".jb_info {background: url(".$uriBase."/media/jbtype/images/orangesticker/info.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;} " ,
		"jb_warning"    => ".jb_warning {background: url(".$uriBase."/media/jbtype/images/orangesticker/warning.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;} " ,
		"jb_camera"     => ".jb_camera {background: url(".$uriBase."/media/jbtype/images/orangesticker/camera.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;} " ,
		"jb_comment"    => ".jb_comment {background: url(".$uriBase."/media/jbtype/images/orangesticker/comment.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;}" ,
		"jb_chat"       => ".jb_chat {background: url(".$uriBase."/media/jbtype/images/orangesticker/chat.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;}" ,
		"jb_document"   => ".jb_document {background: url(".$uriBase."/media/jbtype/images/orangesticker/document.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;}" ,
		"jb_accessible" => ".jb_accessible {background: url(".$uriBase."/media/jbtype/images/orangesticker/accessible.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;}" ,
		"jb_star"       => ".jb_star {background: url(".$uriBase."/media/jbtype/images/orangesticker/star.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;}" ,
		"jb_heart"      => ".jb_heart {background: url(".$uriBase."/media/jbtype/images/orangesticker/heart.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;}" ,
		"jb_film"       => ".jb_film {background: url(".$uriBase."/media/jbtype/images/orangesticker/film.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;}" ,
		"jb_pin"        => ".jb_pin {background: url(".$uriBase."/media/jbtype/images/orangesticker/pin.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;}" ,
		"jb_recycle"    => ".jb_recycle {background: url(".$uriBase."/media/jbtype/images/orangesticker/recycle.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;}" ,
		"jb_lightbulb"  => ".jb_lightbulb {background: url(".$uriBase."/media/jbtype/images/orangesticker/light_bulb.png) no-repeat left center;padding: 20px 0 20px 60px;display:block;}"
		)
);

function getTypeCss($theme, $classArray, $styleArray)
{
	$styleArray['pageset'] = array_merge($styleArray['core'], $styleArray[$theme]);
	$css = '<style type="text/css"><!--';
	
	foreach($classArray as $add)
	{
		$css .= $styleArray['pageset'][$add].' ';
	}
	
	$css .= '--></style>';
	
	return $css;
}
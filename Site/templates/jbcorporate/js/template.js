jQuery(document).ready(function(){
		// Create the dropdown base
	jQuery("<select />").appendTo("#mobilemenu");
	var mobileMenuTitle = jQuery("#mobilemenu").attr("title");
	// Create default option "Go to..."
	jQuery("<option />", {
	   "selected": "selected",
	   "value"   : "",
	   "text"    : mobileMenuTitle
	}).appendTo("#mobilemenu select");

	// Populate dropdown with menu items
	jQuery("#nav ul.menu>li>a, #nav ul.menu>li>span.mainlevel,#nav ul.menu>li>span.separator").each(function() {
	 var el = jQuery(this);
	 jQuery("<option />", {
	     "value"   : el.attr("href"),
	     "text"    : el.text()
    
	 }).appendTo("#mobilemenu select");
	getSubMenu(el);
	});

	function getSubMenu(el){
		var subMenu = jQuery('~ ul>li>a',el);
		var tab = "- ";
		if (!(subMenu.length === 0)){
			subMenu.each(function(){
				var sel = jQuery(this);
				var nodeval = tab + sel.text();
				 jQuery("<option />", {
				     "value"   : sel.attr("href"),
				     "text"    : nodeval

				 }).appendTo("#mobilemenu select");
				getSubMenu(sel);
			});
		}
	}
	
	// To make dropdown actually work
	// To make more unobtrusive: http://css-tricks.com/4064-unobtrusive-page-changer/
	jQuery("#mobilemenu select").change(function() {
	     window.location = jQuery(this).find("option:selected").val();
	});
	
	var topHeight = jQuery("#topwrap").height();
	if(topHeight > 8) {
		jQuery("#background").css("margin-top", (topHeight - 44) + 'px');
	}	

	//Arming Huang
	
	/*
	jQuery('.grid1wrap .grid_four.element:nth-child(1) .zeninner .column.grid_twelve .zenmore.element4').html("<a href=\"index.php?option=com_content&view=article&id=17&catid=178/\"><span class=\"readon\">Read More ...</span></a>");

	//for image News
	jQuery('.grid1wrap .grid_four.element:nth-child(1) .zeninner .column.grid_twelve .zenimage.element1.firstitem').html("<a href=\"./index.php?option=com_content&view=article&id=17&catid=178/\"><img src=\"images/democontent/services/father_tech_boy.jpg\" alt=\"NEWS\" title=\"NEWS\"></a>");
	//for link Read more News
	jQuery('.grid1wrap .grid_four.element:nth-child(2) .zeninner .column.grid_twelve .zenmore.element4').html("<a href=\"index.php?option=com_k2&view=itemlist&layout=category&task=category&id=67&Itemid=376/\"><span class=\"readon\">Read More ...</span></a>");

	//for image News
	jQuery('.grid1wrap .grid_four.element:nth-child(2) .zeninner .column.grid_twelve .zenimage.element1.firstitem').html("<a href=\"./index.php?option=com_k2&view=itemlist&layout=category&task=category&id=67&Itemid=376/\"><img src=\"images/democontent/services/teacher.jpg\" alt=\"NEWS\" title=\"NEWS\"></a>");

//<a href=\"/MAEF/dev-site2/index.php/component/k2/item/249-our-online-education-resource-partners\"><span class=\"readon\">Read More ...</span></a>
//\"./index.php?option=com_k2&view=itemlist&layout=category&task=category&id=67\"

	//for link RESEARCH & TRENDS Readmore
	jQuery('.grid1wrap .grid_four.element:nth-child(3) .zeninner .column.grid_twelve .zenmore.element4').html("<a href=\"index.php?option=com_content&view=article&id=8&catid=178/\"><span class=\"readon\">Read More ...</span></a>");
	
	//for image RESEARCH & TRENDS Readmore
	jQuery('.grid1wrap .grid_four.element:nth-child(3) .zeninner .column.grid_twelve .zenimage.element1.firstitem').html("<a href=\"index.php?option=com_content&view=article&id=8&catid=178/\"><img src=\"images/democontent/services/boy_play_computer.jpg\" alt=\"Research&Trends\" title=\"Research&Trends\"></a>");	
	
	/* OUR ONLINE EDUCATION RESOURCE PARTNERS  Readmore */

/*
jQuery('.grid3wrap .element:nth-child(2) .zeninner .column.grid_twelve .zenmore.element4').html("<a href=\"index.php?option=com_content&view=article&id=13&catid=178/\"><span class=\"readon\">Read More ...</span></a>");
	
*/

	/* //for image OUR ONLINE EDUCATION RESOURCE PARTNERS */
/*
	
 	jQuery('.grid3wrap .element:nth-child(2) .zeninner .column.grid_twelve .zenimage.element1.firstitem').html("<a href=\"index.php?option=com_content&view=article&id=13&catid=178/\"><img src=\"images/logo/sunshineonline-logo.png" alt=\"OUR ONLINE EDUCATION RESOURCE PARTNERS\" title=\"OUR ONLINE EDUCATION RESOURCE PARTNERS\"></a>");	
	
*/


});


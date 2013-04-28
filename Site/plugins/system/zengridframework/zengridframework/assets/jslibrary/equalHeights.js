	// Equal Heights Script
	function equalHeight(group) {
	var tallest = 0;
	group.each(function() {
		var thisHeight = jQuery(this).height();
		if(thisHeight > tallest) {
			tallest = thisHeight;
		}
	});
	group.height(tallest);
	}

	equalHeight(jQuery(".gridWrap1 .moduletable"));
	equalHeight(jQuery(".gridWrap2 .moduletable"));
	equalHeight(jQuery(".gridWrap3 .moduletable"));
	equalHeight(jQuery(".gridWrap4 .moduletable"));
	equalHeight(jQuery(".gridWrap5 .moduletable"));
	equalHeight(jQuery(".gridWrap6 .moduletable"));
	equalHeight(jQuery("#bottom .moduletable"));
	// equalHeight(jQuery("#leftCol .moduletable, #midCol"));
	
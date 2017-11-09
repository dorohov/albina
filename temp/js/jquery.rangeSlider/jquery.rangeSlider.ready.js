'use strict';
$(function() {
	var $range = $("#inputRange"),
	    $input = $("#inputRangeinput"),
	    instance,
	    min = 50,
	    max = 15000;

	$range.ionRangeSlider({
		grid: false,
	    type: "single",
	    min: min,
	    max: max,
		step: 50,
	    from: 500,
	    onStart: function (data) {
	        $input.prop("value", data.from);
	    },
	    onChange: function (data) {
	        $input.prop("value", data.from);
	    }
	});

	instance = $range.data("ionRangeSlider");

	$input.on("change keyup", function () {
	    var val = $(this).prop("value");
	    
	    // validate
	    if (val < min) {
	        val = min;
	    } else if (val > max) {
	        val = max;
	    }
	    
	    instance.update({
	        from: val
	    });
	});
});
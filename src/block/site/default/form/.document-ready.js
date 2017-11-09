$(".form__control[type='tel']").mask("+7 (999) 999-99-99",{placeholder:"+7 (___) ___-__-__"});
$(".form__block").validationEngine(
	'attach', {
		promptPosition : "bottomLeft",
		scrollOffset: 200
	}
);
$(".form__control[data-plugin='timepicki']").timepicki({
	start_time: ["10", "00", "AM"],
	show_meridian:false,
	min_hour_value:10,
	max_hour_value:18,
	step_size_minutes:10,
	overflow_minutes:true,
	add:true,
	increase_direction:'up',
	disable_keyboard_mobile: true
});

$('.form__control[data-plugin="datepicker"]').datepicker({
	language : 'ru-RU'
});
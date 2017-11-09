<link rel="stylesheet" type="text/css" href="<?=$this->path('css');?>/validationEngine.jquery.css">
<script src="<?=$this->path('js');?>/validationEngine.jquery/jquery.validationEngine.min.js" ></script>
<script src="<?=$this->path('js');?>/validationEngine.jquery/jquery.validationEngine-ru.min.js" ></script>
<script src="<?=$this->path('js');?>/jquery.maskedinput.js" ></script>
<script>		
  	$(document).ready(function () {
  		$(".form__control[type='tel']").mask("+7 (999) 999-99-99",{placeholder:"+7 (___) ___-__-__"});
		$(".form__block").validationEngine(
			'attach', {
				promptPosition : "bottomLeft",
				scrollOffset: 200
			}
		);
	});
</script>
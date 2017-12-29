<?
/*
На этапе программирования изменить ссылки на любой другой элемент с сохранением class.
Ссылки сейчас для примера.
Как вариант: добавлять ссылки к предыдущему пункту. Н-р мы находимся на странице Доставка тогда у корзины появляется ссылка, чтобы была возможность вернуться назад.

Когда пункт активный добавить is--active к list-item
*/
?>
<div class="<?=$param["block_prefix"];?>block">
	<ul class="<?=$param["block_prefix"];?>list">
		<li class="<?=$param["block_prefix"];?>list-item">
			<span class="<?=$param["block_prefix"];?>list-icon">
			<svg class="icon-svg icon-basket-step-arrow" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#basket-step-arrow"></use></svg></span>
			<a href="<?=l(311);?>" class="<?=$param["block_prefix"];?>list-link">Товары</a>
		</li>
		<li class="<?=$param["block_prefix"];?>list-item">
			<span class="<?=$param["block_prefix"];?>list-icon">
			<svg class="icon-svg icon-basket-step-arrow" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#basket-step-arrow"></use></svg></span>
			<a href="<?=l(318);?>" class="<?=$param["block_prefix"];?>list-link">Доставка</a>
		</li>
		<li class="<?=$param["block_prefix"];?>list-item">
			<a href="<?=l(320);?>" class="<?=$param["block_prefix"];?>list-link">Оплата</a> 
		</li>
	</ul>
</div> 
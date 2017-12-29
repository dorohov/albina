<?
$heading_color = get_field('heading_color', $id);
?>
<div class="<?=$param["block_prefix"];?>block  <?=$heading_color;?>">
	<div class="<?=$param["block_prefix"];?>container container">
		<div class="<?=$param["block_prefix"];?>row row  is--wrap">
			<div class="<?=$param["block_prefix"];?>cols cols  is--heading">
				<div class="<?=$param["block_prefix"];?>inner">
					<a href="<?=l(313);?>" class="<?=$param["block_prefix"];?>preview"><img src="https://placeholdit.imgix.net/~text?txtsize=15&txt=Нет фото&w=90&h=90" alt=""></a>
					<div class="breadcrumb__block  is--heading  is--blue">
						<ul class="breadcrumb__list  is--heading  is--blue">
							<li class="breadcrumb__list-item">
								<a href="/" class="breadcrumb__list-link">Главная</a>
							</li>
							<li class="breadcrumb__list-item is--active"><?=t($id);?></li>
						</ul>
					</div>	
					<div class="page-header__block  is--heading  is--blue  is--panel">
						<h1 class="page-header__heading  is--heading  is--blue  is--panel"><span>Добрый день, Алексей</span></h1>
						<h3 class="page-header__heading-small  is--heading  is--blue  is--panel">Дисконтная система PROBronze</h3>
					</div>
				</div>
			</div>
			<div class="<?=$param["block_prefix"];?>cols cols  is--sale">
				<div class="<?=$param["block_prefix"];?>sale">
					<div class="<?=$param["block_prefix"];?>sale-num">
						<span>3</span>%
					</div>	
					<div>Ваша скидка</div>
				</div>	
			</div>	
		</div>	
	</div>	
</div>
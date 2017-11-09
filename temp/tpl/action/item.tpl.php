<?
	$preview = $this->Imgs->postImg($p->ID, '520x295');
?>
<div class="content-block blog-page__content-block  is--hidden" role="main">	
	<div class="page-header-panel__block  is--action">
		<div class="page-header-panel__container container">
			<div class="breadcrumb__block  is--heading  is--blue  is--center">
				<ul class="breadcrumb__list  is--heading  is--blue  is--center">
					<li class="breadcrumb__list-item">
						<a href="/" class="breadcrumb__list-link">Главная</a>
					</li>
					<li class="breadcrumb__list-item">
						<a href="<?=l(9);?>" class="breadcrumb__list-link"><?=t(9);?></a>
					</li>
					<li class="breadcrumb__list-item is--active"><?=t($id);?></li>
				</ul>
			</div>	
			<div class="page-header__block  is--heading  is--blue  is--panel  is--center">
				<h1 class="page-header__heading  is--heading  is--blue  is--panel  is--center"><span><?=t($id);?></span></h1>	
				<?if ($heading_small != ""){?>
				<h3 class="page-header__heading-small  is--heading  is--blue  is--panel"><?=$heading_small;?></h3>		
				<?}?>
			</div>
			<?
				$this->tpl(
					'_/bg-round', 
					array(
						"block_prefix"=>"bg-round__",
					)
				);
			?>  
			<?
			$this->tpl(
				'_/bg-card', 
				array(
					"block_prefix" => "bg-plane__",
					"block_mod" => "is--action  is--speed-55",
					"block_bg" => "bg-plane-action.png",
				)
			);
			?>		
		</div>	
	</div>
	<div class="container content-block__container blog-page__container  bg-header__container">
		<div class="text__container">
			<div class="text__block">
				<?/* if ($preview != ""){?>
				<div><img src="<?=$preview;?>" alt="<?=t($id);?>"></div>
				<?}*/?>
				<?=c($this->post['id']);?>
			</div>
		</div>
	</div>
</div>
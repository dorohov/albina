<?
$bg_prefix="bg-block__";
$block_prefix="team-page__";
$breadcrumb_prefix = "breadcrumb__";
$breadcrumb_mod="is--heading  is--center";
$heading_prefix="page-header__";
$heading_mod="is--heading  is--center";
$p_id = $this->post['id'];
$heading = t($p_id);
$content = c($p_id);
$preview = $this->Imgs->postImg($p_id, '460x590');
$position = get_field('team_post', $p_id);
if($preview == ""){
	$preview = "http://via.placeholder.com/460x590";
};
$categories = wp_get_object_terms($p_id, 'ourteam-categories');
$bg = get_field('team_bg', $categories[0]);
$sert = get_field("team_sert", $p_id);

?>

<div class="content-block <?=$block_prefix;?>content-block  <?=$bg_prefix;?>block" role="main">	
	<div class="container content-block__container <?=$block_prefix;?>container <?=$bg_prefix;?>container">
		<div class="<?=$breadcrumb_prefix;?>block  <?=$breadcrumb_mod;?>">
			<ul class="<?=$breadcrumb_prefix;?>list  <?=$breadcrumb_mod;?>">
				<li class="<?=$breadcrumb_prefix;?>list-item">
					<a href="<?=l(1);?>" class="<?=$breadcrumb_prefix;?>list-link">Главная</a>
				</li>
				<li class="<?=$breadcrumb_prefix;?>list-item">
					<a href="<?=l(6);?>" class="<?=$breadcrumb_prefix;?>list-link"><?=t(6);?></a>
				</li>
				<li class="<?=$breadcrumb_prefix;?>list-item is--active"><?=$heading;?></li>
			</ul>
		</div>
		<div class="<?=$heading_prefix;?>block  <?=$heading_mod;?>">
			<h1 class="<?=$heading_prefix;?>heading  <?=$heading_mod;?>"><span><?=$heading;?></span></h1>
		</div>
		<div class="team-card-panel__note-panel">
			<div class="team-card-panel__row row  is--gutter  is--wrap">
				<div class="team-card-panel__cols cols  is--cols-screen-6  is--cols-sm-5  is--cols-xs-l-4">
					<div class="team-card-panel__preview">
						<img src="<?=$preview;?>" alt="<?=$heading;?>">
						<?
							//фоновая картинка категории
							$this->tpl(
								'_/bg', 
								array(
									"block_prefix" => "bg-block__",
									"block_mod" => "is--team-preview",
									"block_bg" => $bg,
									"block_gallery" => "true"
								)
							);
						?>
					</div>
				</div>
				<div class="team-card-panel__cols cols  is--cols-screen-6  is--cols-sm-7">
					<div class="team-card-panel__note">
						<?if($position != ""){?>
						<h3 class="team-card-panel__post"><?=$position;?></h3>
						<?}?>
						<div class="team-card-panel__text-block  text__block">
							<?=$content;?>
						</div>
						<div class="team-card-panel__btn-row row  is--wrap  is--gutter">
							<div class="team-card-panel__btn-cols cols">
								<button type="button" class="btn__item is--sm" data-toggle="modal" data-target="#modal-reserv"><span>Записаться на прием</span></button>
							</div>
							<div class="team-card-panel__btn-cols cols">
								<button type="button" class="btn__item   " data-toggle="modal" data-target="#modal-сonsultation"><span>Консультация</span></button>
							</div>
						</div>
					</div>
				</div>
			</div> 
		</div> 
		<?
			if(count($sert)) {
		?>
		<div class="team-card-panel__sert-panel">
			<h3 class="team-card-panel__sert-heading">Сертификаты специалиста</h3>
			<div class="team-card-panel__sert-row row  is--wrap  is--gutter">
				<?				
					foreach($sert as $id) {
						$preview = $this->Imgs->rawImg($id, '9999x175');
						$preview_full = $this->Imgs->rawImg($id, 'fancybox_full');
						$preview_xs = $this->Imgs->rawImg($id, '310x220');
				?>		
				<div class="team-card-panel__sert-cols cols">
					<a href="<?=$preview_full;?>" data-fancybox="sert-gallery">
						<picture class="team-card-panel__preview-picture"> 
							<source media="(min-width: 1025px)" 
									srcset="<?=$preview;?>">
							<img src="<?=$preview_xs;?>" alt="">
						</picture>
					</a>
				</div>
				<? } ?>
				</div>
			</div>
		</div>
		<?} ?>	
		<?
			//фоновые картинки
			$this->tpl(
				'_/bg', 
				array(
					"block_prefix" => "bg-block__",
					"block_mod" => "is--flover-leaf  is--team-item",
					"block_bg" => "bg-flover-leaf.png",
				)
			);
		?>
	</div>
</div>
<?
$this->tpl(
	'blog/panel', 
	array(
		"block_prefix"=>"blog-panel__",
		"block_mod"=>"is--index",
		"heading_prefix"=>"page-header__",
		"heading_mod"=>"is--heading  is--center  is--blog-panel-index",
		"heading"=>"Мнения наших специалистов",
	)
);?>
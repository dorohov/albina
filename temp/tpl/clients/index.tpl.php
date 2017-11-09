<?
$block_prefix = "clients-page__";
$posts = new WP_Query(array(
	'post_type' => 'page',
	'posts_per_page' => -1,
	'post_parent' => 34,
	'post_status' => 'any',
	'orderby' => array(
		'menu_order' => 'ASC',
		'date' => 'DESC',
		'ID' => 'DESC',
		'name' => 'ASC',
	),
));
$heading_small = get_field('page_heading_small', $id);
$heading_color = get_field('heading_color', $id);

$form_heading = get_field('form_heading', $id);
$form_btn_name = get_field('form_btn_name', $id);
if($form_heading == ""){
	$form_heading = "Узнайте стоимость под ваш проект";
};
if($form_btn_name == ""){
	$form_btn_name = "Отправить";
}
$form_heading_page = t($id);

?>
<div class="content-block <?=$block_prefix;?>content-block  is--hidden" role="main">
	<div class="page-header-panel__block  <?=$heading_color;?>">
		<div class="page-header-panel__container container">
			<div class="breadcrumb__block  is--heading  is--blue">
				<ul class="breadcrumb__list  is--heading  is--blue">
					<li class="breadcrumb__list-item">
						<a href="/" class="breadcrumb__list-link">Главная</a>
					</li>
					<li class="breadcrumb__list-item is--active"><?=t($id);?></li>
				</ul>
			</div>	
			<div class="page-header__block  is--heading  is--blue  is--panel">
				<h1 class="page-header__heading  is--heading  is--blue  is--panel"><span><?=t($id);?></span></h1>	
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
		</div>	 
		<?
		$this->tpl(
			'_/bg-card', 
			array(
				"block_prefix" => "bg-plane__",
				"block_mod" => "is--clients-left  is--speed-25",
				"block_bg" => "bg-plane-clients-white.png",
			)
		);
		?>
		<?
		$this->tpl(
			'_/bg-card', 
			array(
				"block_prefix" => "bg-plane__",
				"block_mod" => "is--clients-right  is--speed-10",
				"block_bg" => "bg-plane-clients-blue.png",
			)
		);
		?>	
	</div>
	<div class="container content-block__container <?=$block_prefix;?>container  bg-header__container  is--noheight">
		<div class="clients-panel__block">
			<div class="clients-panel__row row  is--gutter  is--wrap">
				<?
					while($posts->have_posts()) {
						$posts->the_post();
						$id = get_the_ID();
						$link = l($id);
						$title = t($id);
						$note = c($id);
						$sale = get_field('sale', $id);
						$preview = $this->Imgs->postImg($id, 'full');
						
				?>
				<div class="clients-panel__cols cols  is--cols-screen-4  is--cols-sm-4">
					<div class="clients-item__card"  data-heading="<?=$title;?>">	
						<div class="clients-item__row row  is--wrap  is--gutter15">
							<div class="clients-item__cols cols  is--preview">
								<div class="clients-item__preview">
									<img src="<?=$preview;?>" alt="<?=t($id);?> - PRO <?=$title;?>">
								</div>
							</div>
							<div class="clients-item__cols cols  is--note">
								<div class="clients-item__note">
									<h4 class="clients-item__heading">PRO <?=$title;?></h4>
									<div class="clients-item__text"><?=$note;?></div>
									<div class="clients-item__sale"><span><?=$sale;?><small>%</small></span> скидка</div>
								</div>
							</div>
						</div>
					</div>
				</div>				
				<?
				}
				wp_reset_postdata();
				?>
			</div>
		</div>		
	</div>		
	<?
	$this->tpl(
		'_/form/panel', 
		array(
			"block_prefix" => "form-panel__",
			"block_tpl" => "fio-comp-email-pass",
			"block_mod" => "is--lg",
			"block_bg" => "bg-form-panel.jpg",
			"block_heading" => $form_heading,
			"block_form_heading" => $form_heading_page,
			"block_form_prefix" => "form__",
			"block_form_mod" => "is--inline  is--cols-2-5",
			"block_form_color" => "is--white",
			"block_form_id" => "fcab",
			"block_btn_name" => $form_btn_name,
			"block_btn_mod" => "is--form-inline  is--white",
		)
	);
	?> 
</div>
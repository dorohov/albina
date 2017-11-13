<?
$bg_prefix="bg-block__";
$block_prefix="blog-page__";
$breadcrumb_prefix = "breadcrumb__";
$breadcrumb_mod="is--heading  is--center";
$heading_prefix="page-header__";
$heading_mod="is--heading  is--center";
?>
<div class="content-block <?=$block_prefix;?>content-block  <?=$bg_prefix;?>block" role="main">	
	<div class="container content-block__container <?=$block_prefix;?>container <?=$bg_prefix;?>container">
		<div class="<?=$breadcrumb_prefix;?>block  <?=$breadcrumb_mod;?>">
			<ul class="<?=$breadcrumb_prefix;?>list  <?=$breadcrumb_mod;?>">
				<li class="<?=$breadcrumb_prefix;?>list-item">
					<a href="<?=l(1);?>" class="<?=$breadcrumb_prefix;?>list-link">Главная</a>
				</li>
				<li class="<?=$breadcrumb_prefix;?>list-item">
					<a href="<?=l(4);?>" class="<?=$breadcrumb_prefix;?>list-link"><?=t(4);?></a>
				</li>
				<?
				$categories = get_the_category($id);				
				if(count($categories)) {
					foreach($categories as $cat) {
						$link = get_category_link($cat->term_id);
				?>					
					<li class="<?=$breadcrumb_prefix;?>list-item"><a href="<?=$link;?>" class="<?=$breadcrumb_prefix;?>list-link"><?=$cat->name;?></a></li>
				<?
					}
				}
				?>
				<li class="<?=$breadcrumb_prefix;?>list-item is--active"><?=t();?></li>
			</ul>
		</div>
		<div class="<?=$heading_prefix;?>block  <?=$heading_mod;?>">
			<h1 class="<?=$heading_prefix;?>heading  <?=$heading_mod;?>"><span><?=t();?></span></h1>
		</div>

		<div class="text__container">
			<div class="text__block">
				<?=c($this->post['id']);?>
			</div>
		</div>
	</div>
	<?
		//фоновые картинки
		$this->tpl(
			'_/bg', 
			array(
				"block_prefix" => "bg-block__",
				"block_mod" => "is--leaf-xl  is--blog-item",
				"block_bg" => "bg-leaf-xl.png",
			)
		);
		$this->tpl(
			'_/bg', 
			array(
				"block_prefix" => "bg-block__",
				"block_mod" => "is--syringes-insulin  is--blog-item",
				"block_bg" => "bg-syringes-insulin.png",
			)
		);
		$this->tpl(
			'_/bg', 
			array(
				"block_prefix" => "bg-block__",
				"block_mod" => "is--cream-leaf  is--blog-item",
				"block_bg" => "bg-cream-leaf.png",
			)
		);
		$this->tpl(
			'_/bg', 
			array(
				"block_prefix" => "bg-block__",
				"block_mod" => "is--cream-tube  is--blog-item",
				"block_bg" => "bg-cream-tube.png",
			)
		);
		$this->tpl(
			'_/bg', 
			array(
				"block_prefix" => "bg-block__",
				"block_mod" => "is--flover-white  is--blog-item",
				"block_bg" => "bg-flover-white.png",
			)
		);
	?>
</div>
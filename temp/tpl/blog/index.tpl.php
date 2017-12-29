<?
$bg_prefix="bg-block__";
$block_prefix="blog-page__";
$posts = $this->getItems(array(
	'post_type' => 'post',
	'posts_per_page' => 10,
	'orderby' => array(
		'menu_order' => 'ASC',
		'date' => 'DESC',
		'ID' => 'DESC',
		'name' => 'ASC',
	),

	'tax_query' => array(array(
		'taxonomy' => 'category',
		'field' => 'slug',
		'terms' => array('blog'),
	)),

));
$heading_small = get_field('page_heading_small', $id);
$heading_color = get_field('heading_color', $id);
?>
<div class="content-block <?=$block_prefix;?>content-block  <?=$bg_prefix;?>block" role="main">	
	<div class="container content-block__container <?=$block_prefix;?>container <?=$bg_prefix;?>container">
		<?
		// хлебные крошки первого уровня
		$this->tpl(
			'_/bread', 
			array(
				"block_prefix" => "breadcrumb__",
				"block_mod" => "is--heading  is--center"
			)
		);
		// заголовок страницы		
		$this->tpl(
			'_/heading', 
			array(
				"block_prefix" => "page-header__",
				"block_mod" => "is--heading  is--center"
			)
		);
		?>
		<div class="blog-panel__block">
			<?	
			// навигация по разделам		
			$this->tpl(
				'blog/navbar', 
				array(
					"block_prefix" => "navbar-category__",
					"block_mod" => "is--nofixed"
				)
			);
			?>
			<div class="blog-panel__row row  is--gutter  is--wrap">
				<?
				if(count($posts)) {
					foreach($posts as $p) {						
						$link = l($p->ID);
						$title = $p->post_title;
						//$note = get_field('blog__note', $p->ID);
						$preview = $this->Imgs->postImg($p->ID, '385x330');
						$team_item_get = get_field('blog_team_item', $p->ID);
						$team_item = $team_item_get->post_title;
						$team_post = get_field('team_post', $team_item_get->ID);
						if ($preview == ""){
							$preview = "http://via.placeholder.com/385x330";
						}						
				?>
				<div class="blog-panel__cols cols  is--cols-screen-3  is--cols-sm-4">
					<article class="blog-card__item">
						<a href="<?=$link;?>" class="blog-card__preview block-hover__block">
							<img src="<?=$preview;?>" alt="<?=$title;?>"  class="block-hover__img  img-responsive"> 
							<div class="block-hover__item">
								<div class="block-hover__icon"> 
									<div class="block-hover__icon-inner">
										<svg class="icon-svg icon-plus" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#plus"></use></svg>
									</div>
								</div>
							</div>
						</a> 			
						<div class="blog-card__note">
							<h4 class="blog-card__heading"><a href="<?=$link;?>"><?=$title;?></a></h4>
							<?if($team_item !=""){?>
							<div class="blog-card__text-block  text__block"><?=$team_item;?> - <?=$team_post;?></div>
							<?}?>
						</div> 
					</article>
				</div>							
				<?
					}
				}
				?>
			</div>
		</div>
	</div>
	<?
		//фоновые картинки
		$this->tpl(
			'_/bg', 
			array(
				"block_prefix" => "bg-block__",
				"block_mod" => "is--candle",
				"block_bg" => "bg-candle.png",
			)
		);
	?>
</div>
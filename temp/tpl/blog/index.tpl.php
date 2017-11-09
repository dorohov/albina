<?
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
<div class="content-block blog-page__content-block  is--hidden" role="main">	
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
	<div class="container content-block__container blog-page__container  bg-header__container">
		<div class="blog-panel__block">
			<div class="blog-panel__row row  is--gutter  is--wrap">
				<?
				if(count($posts)) {
					foreach($posts as $p) {						
						$link = l($p->ID);
						$title = $p->post_title;
						$note = get_field('blog__note', $p->ID);
						$preview = $this->Imgs->postImg($p->ID, '795x440');
						$date_iso = get_the_date('Y-m-d', $p);
						$date = get_the_date('d F', $p);  //28 июля
						$date_ago = "3 дня назад"; //настроить !!!
						if ($preview == ""){
							$preview = "https://placeholdit.imgix.net/~text?txtsize=30&txt=795x440&w=795&h=440";
						}						
				?>
				<div class="blog-panel__cols cols  is--cols-12">
					<article class="blog-card__item">
						<div class="blog-card__row row  is--wrap  is--gutter">
							<div class="{blog-card__cols cols  is--cols-6  is--preview">
								<a href="<?=$link;?>" class="blog-card__preview">
									<img src="<?=$preview;?>" alt="<?=$title;?>">
								</a> 
							</div>
							<div class="blog-card__cols cols  is--cols-6  is--note">			
								<div class="blog-card__note">
									<time class="blog-card__date" datatime="<?=$date_iso?>"><span><?=$date;?></span> <?=$date_ago;?></time>
									<h3 class="blog-card__heading">
										<a href="<?=$link;?>"><?=$title;?></a>
									</h3>
									<div class="blog-card__text-block  text__block"><?=$note;?></div>
									<div class="blog-card__btn">
										<a href="<?=$link;?>" class="btn-link__item"><span>Читать далее</span></a>	
									</div>
								</div> 
							</div>
						</div>
					</article>
				</div>			
				<?
					}
				}
				?>
			</div>
			<div class="pagination-panel__block">
				<ol class="pagination-panel__list">
					<li class="pagination-panel__item">
						<div class="pagination-panel__line"></div>
					</li>
					<li class="pagination-panel__item  is--active">
						<a href="#" class="pagination-panel__link  is--active">1</a>
					</li>
					<li class="pagination-panel__item">
						<a href="#" class="pagination-panel__link">2</a>
					</li>
					<li class="pagination-panel__item">
						<a href="#" class="pagination-panel__link">3</a>
					</li>
					<li class="pagination-panel__item  is--notround">
						<a href="#" class="pagination-panel__link  is--notround">...</a>
					</li>
					<li class="pagination-panel__item">
						<a href="#" class="pagination-panel__link">6</a>
					</li>				
					<li class="pagination-panel__item">
						<div class="pagination-panel__line"></div>
					</li>	
				</ol>
			</div> 
			<h1 style="text-align: center;">Настроить пагинацию!!!</h1>
		</div>
	</div>	
</div>
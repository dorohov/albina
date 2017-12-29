<?
$category_active = get_queried_object();
$category_parent = $param['category_parent'];
$categories = $param['categories'];
/*
$categories = get_categories(array(
	'type'					=> 'post',
	'child_of'				=> $category_parent,
	//'child_of'				=> 4,
	'parent'				=> '',
	'orderby'				=> 'menu_order',
	'order'					=> 'DESC',
	'hide_empty'			=> 0,
	'hierarchical'			=> 0,
	'exclude'				=> '',
	'include'				=> '',
	'number'				=> 0,
	'pad_counts'			=> false,
));*/
?>
<?
if(count($categories)) {			
?>
<div class="blog-panel__block-cols cols  is--cols-screen-3">
	<div class="<?=$param["block_prefix"];?>block dropdown  <?=$param["block_mod"];?>">
		<a href="#" data-toggle="dropdown" class="<?=$param["block_prefix"];?>btn-block">
			<div class="container">
				<div class="<?=$param["block_prefix"];?>btn">
					<div class="<?=$param["block_prefix"];?>btn-hamb">
						<div class="<?=$param["block_prefix"];?>btn-hamb-item  is--top"></div>
						<div class="<?=$param["block_prefix"];?>btn-hamb-item  is--center"></div>
						<div class="<?=$param["block_prefix"];?>btn-hamb-item  is--bottom"></div>
					</div>
					<div class="<?=$param["block_prefix"];?>btn-name">
						Другие разделы
					</div>
				</div>		
			</div>		
		</a>
		<div class="<?=$param["block_prefix"];?>dropdown  <?=$param["block_mod"];?>">
			<div class="<?=$param["block_prefix"];?>dropdown-inner">
				<ul class="<?=$param["block_prefix"];?>nav  <?=$param["block_mod"];?>">
					<?
						foreach($categories as $cat) {
							$link = get_category_link($cat->term_id);
							$name = $cat->name;
					?>
					<li class="<?=$param["block_prefix"];?>item  <?=$param["block_mod"];?>">
						<a class="<?=$param["block_prefix"];?>link  <?if($category_active->term_id == $cat->term_id){echo 'is--active';}?>  <?=$param["block_mod"];?>" href="<?=$link;?>"><span><?=$name;?></span></a>
					</li>
					<?}?>
				</ul>
			</div>
		</div>
	</div>
</div>
<?}?>
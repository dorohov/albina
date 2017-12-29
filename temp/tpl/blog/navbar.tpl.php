<?
$category_active = &$param['category_active'];

$categories = get_categories(array(
	'type'					=> 'post',
	'child_of'				=> '',
	'parent'				=> 3,
	'orderby'				=> 'menu_order',
	'order'					=> 'DESC',
	'hide_empty'			=> 0,
	'hierarchical'			=> 0,
	'exclude'				=> '',
	'include'				=> '',
	'number'				=> 0,
	'pad_counts'			=> false,
));
?>
<?
if(count($categories)) {			
?>
<div class="<?=$param["block_prefix"];?>block  <?=$param["block_mod"];?>">	
	<ul class="<?=$param["block_prefix"];?>nav  <?=$param["block_mod"];?>">
		<?
			foreach($categories as $cat) {
				$link = get_category_link($cat->term_id);
				$name = $cat->name;
		?>
		<li class="<?=$param["block_prefix"];?>item  <?=$param["block_mod"];?> ">
			<a class="<?=$param["block_prefix"];?>link  btn-link__item  <?=$param["block_mod"];?>  <?if($category_active->term_id == $cat->term_id){echo 'is--active';}?>" href="<?=$link;?>"><span><?=$name;?></span></a>
		</li>
		<?}?>
	</ul>
</div>
<?}?>
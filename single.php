<?php get_header(); ?>
<main class="bg-cream">
	<div class="container">
			<div class="row py-3">
			<div class="col-md-8 col-12 pb-5 mx-auto">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<!--メインコンテンツ-->
				<div class="bg-white py-3">
		<!--記事タイトル-->
				<div class="px-3 py-1 font-weight-bolder">
					<h1 class="h4"><?php the_title(); ?></h1>
				</div>
		<!--日付-->
				<p class="px-3 text-secondary"><?php the_time('Y/n/j'); ?></p>
		<!--カテゴリ-->
		<!--カテゴリー-->
		<?php
		$category = get_the_category();
		 
		if (!empty( $category )) { ?>
		<ul class="px-2">
		<?php
		foreach($category as $cat){
				
		echo '<li class="d-inline px-1"><a class="p-1 text-white bg-cyan" href="' . get_category_link( $cat->cat_ID ) . '">' . $cat->cat_name . '</a></li>';
		 
		} ?>
		    
		</ul>
		<?php } ?>
		<!--サムネイル-->
				<div class="pb-3">
						<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( '', array('class' => 'img-fluid' ) ); ?>
						<?php else : ?>
						<img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/image/noimage.jpg" alt="">
						<?php endif; ?>
					</div>
		<!--本文-->
					<div class="text-left px-3">
					<?php the_content(); ?></div>
				</div>
				<?php endwhile; else : ?>
		<p>記事がありません。</p>
		<?php endif; ?>
		</div>
	<?php get_sidebar(); ?>
</div>
</div>
	<!--フッター-->
<?php get_footer(); ?>


<?php get_header(); ?>

<main class="bg-cream">
	<div class="container">
	<!--ピックアップ記事-->
	<div class="row py-3">
		<div class="col-md-8">
	<!--メインコンテンツ-->
	<div class="row">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<div class="col-6 pb-3">
		<div class="bg-white pb-1">
		<!--サムネイル-->
			<div class="pb-3"><a href="<?php the_permalink(); ?>">
						<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( '', array('class' => 'img-fluid' ) ); ?>
						<?php else : ?>
						<img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/image/noimage.jpg" alt="">
						<?php endif; ?>
					</a>
					</div>
		<!--記事タイトル-->
		<h2 class="h5 bg-white px-3 py-1 font-weight-bolder"><a class="text-dark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
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
		<!--日付-->
		<p class="px-3 text-secondary"><?php the_time('Y/n/j'); ?></p>
		</div>
		</div>

		<?php endwhile; else : ?>
		<p>記事がありません。</p>
		<?php endif; ?>
	</div>
</div>
	<?php get_sidebar(); ?>
	</div>
</div>
<!--フッター-->
<?php get_footer(); ?>
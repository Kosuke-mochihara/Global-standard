<?php get_header(); ?>
<main class="main">
	<article class="">
		<ul class="">
			<!-- カテゴリーのタブメニューを表示(詳細は右を参照) -->
		</ul>

		<!-- カテゴリー名出力 -->
		<h1>
			<?php $cat_info = get_category($cat); ?>
			<?php echo wp_specialchars($cat_info->name); ?>
		</h1>

		<ul class="">
			<!-- 記事のループ処理開始 -->
			<?php
			$cat_info = get_category(get_query_var('cat'));
			$paged = get_query_var('paged') ? get_query_var('paged') : 1;
			?>
			<?php
			if (wp_is_mobile()) {
				$num = 4; // スマホの表示数(全件は-1)
			} else {
				$num = 8; // PCの表示数(全件は-1)
			}
			$args = array(
				'post_type' => array('post'), // 投稿タイプのスラッグ(通常投稿なので'post')
				'paged' => $paged, // ページネーションがある場合に必要
				'posts_per_page' => $num, // 表示件数（変更不要）
				'category_name' => $cat_info->slug,
			);
			$wp_query = new WP_Query($args);
			if ($wp_query->have_posts()) : while ($wp_query->have_posts()) :
					$wp_query->the_post();
			?>
					<li class="">
						<!-- 記事へのリンク -->
						<a href="<?php the_permalink(); ?>" class="">
							<!-- アイキャッチ -->
							<div class="">
								<?php the_post_thumbnail('post-thumbnail', array('alt' => the_title_attribute('echo=0'))); ?>
							</div>
							<p class="">
								<!-- 投稿日 -->
								<time datetime="<?php the_time('Y.n.j'); ?>">
									<?php the_time('Y.m.d'); ?>
								</time>
							</p>
							<div class="">
								<!-- カテゴリー1件表示(カテゴリー順の上にある方が表示される) -->
								<?php
								$category = get_the_category();
								echo '<span class="' . $category->slug . '">' . $category[0]->name . '</span>';
								?>
								<!-- カテゴリー全部表示 -->
								<?php
								$categories = get_the_category();
								foreach ($categories as $cat) {
									echo '<span class="' . $cat->slug . '">' . $cat->name . '</span>';
								}
								?>
							</div>
							<h2 class="">
								<!-- タイトル -->
								<?php the_title(); ?>
							</h2>
							<div class="">
								<!-- 本文の抜粋 -->
								<?php the_excerpt(); ?>
							</div>
						</a>
					</li>
			<?php
				endwhile;
			endif;
			wp_reset_postdata();
			?>
			<!-- 記事のループ処理終了 -->
		</ul>
		<!-- ページネーション(数字あり) -->
		<div class="">
			<?php
			global $wp_query;
			$big = 9999999999;
			$arg = array(
				'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
				'current' => max(1, get_query_var('paged')),
				'total'   => $wp_query->max_num_pages,
				'mid_size' => 1,
				// 前後をテキスト
				'prev_text' => '前へ',
				'next_text' => '次へ',
				// 前後を画像
				'prev_text' => '<img src="' . get_template_directory_uri() . '画像の相対パス">',
				'next_text' => '<img src="' . get_template_directory_uri() . '画像の相対パス">',
			);
			echo paginate_links($arg);
			?>
		</div>
		<!-- ページネーション(前後のみ：テキスト) -->
		<div class="">
			<div class="page-numbers prev">
				<?php previous_posts_link('前へ'); ?>
			</div>
			<div class="page-numbers next">
				<?php next_posts_link('次へ'); ?>
			</div>
		</div>
		<!-- ページネーション(前後のみ：画像) -->
		<div class="">
			<div class="page-numbers prev">
				<?php previous_posts_link('<img src="' . get_template_directory_uri() . '画像のパス">'); ?>
			</div>
			<div class="page-numbers next">
				<?php next_posts_link('<img src="' . get_template_directory_uri() . '画像のパス">'); ?>
			</div>
		</div>
	</article>
</main>
<?php get_footer(); ?>
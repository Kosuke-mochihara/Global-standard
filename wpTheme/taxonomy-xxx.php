<?php get_header(); ?>
<main class="main">
	<article class="">
		<!-- カテゴリー(ターム)名 -->
		<h1>
			<?php single_term_title(); ?>
		</h1>

		<ul class="">
			<!-- 記事のループ処理開始 -->
			<?php
			if (wp_is_mobile()) {
				$num = 4; // スマホの表示数(全件は-1)
			} else {
				$num = 8; // PCの表示数(全件は-1)
			}
			$paged = get_query_var('paged') ? get_query_var('paged') : 1;
			$type = get_query_var('blog_category'); // タクソノミーのスラッグ
			$args = [
				'post_type' => 'blog', // 投稿タイプスラッグ
				'paged' => $paged, // ページネーションがある場合に必要
				'posts_per_page' => $num, // 表示件数（変更不要）
				'tax_query' => array(
					array(
						'taxonomy' => 'blog_category', // タクソノミーのスラッグ
						'field' => 'slug', // ターム名をスラッグで指定する（変更不要）
						'terms' => $type,
					),
				)
			];
			$wp_query = new WP_Query($args);
			if (have_posts()) : while (have_posts()) : the_post();
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
								<!-- カテゴリー(ターム)1つ表示 -->
								<?php
								$taxonomy_terms = get_the_terms($post->ID, 'タクソノミースラッグ');
								if ($taxonomy_terms) {
									echo '<span>' . $taxonomy_terms[0]->name . '</span>';
								}
								?>
								<!-- カテゴリー(ターム)全部表示 -->
								<?php
								$taxonomy_terms = get_the_terms($post->ID, 'タクソノミースラッグ');
								foreach ($taxonomy_terms as $taxonomy_term) {
									echo '<span class="' . $taxonomy_term->slug . '">' . $taxonomy_term->name . '</span>';
								}
								?>
								<!-- 指定したカテゴリー(ターム)のみ表示 -->
								<?php
								$taxonomy_terms = get_the_terms($post->ID, 'タクソノミースラッグ');
								foreach ($taxonomy_terms as $taxonomy_term) {
									if (!in_array($taxonomy_term->slug, array('表示したいタームスラッグ', '表示したいタームスラッグ')))
										continue;
									echo '<span class="' . $taxonomy_term->slug . '">' . $taxonomy_term->name . '</span>';
								}
								?>
								<!-- 指定したカテゴリー(ターム)を除外 -->
								<?php
								$taxonomy_terms = get_the_terms($post->ID, 'タクソノミースラッグ');
								foreach ($taxonomy_terms as $taxonomy_term) {
									if (in_array($taxonomy_term->slug, array('除外したいタームスラッグ', '除外したいタームスラッグ')))
										continue;
									echo '<span class="' . $taxonomy_term->slug . '">' . $taxonomy_term->name . '</span>';
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
				<?php endwhile;
			else : ?>
			<?php endif ?>
			<?php wp_reset_postdata(); ?>
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
		<!-- ページネーション(前へ、次へのみ：テキスト) -->
		<div class="">
			<div class="page-numbers prev">
				<?php previous_posts_link('前へ'); ?>
			</div>
			<div class="page-numbers next">
				<?php next_posts_link('次へ'); ?>
			</div>
		</div>
		<!-- ページネーション(前へ、次へのみ：画像) -->
		<div class="">
			<div class="page-numbers prev">
				<?php previous_posts_link('<img src="' . get_template_directory_uri() . '画像の相対パス">'); ?>
			</div>
			<div class="page-numbers next">
				<?php next_posts_link('<img src="' . get_template_directory_uri() . '画像の相対パス">'); ?>
			</div>
		</div>
	</article>
</main>
<?php get_footer(); ?>
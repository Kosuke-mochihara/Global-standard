<?php get_header(); ?>
<main class="main">
	<article class="">
		<ul class="">
			<!-- カテゴリーのリンクを全て表示 -->
			<?php
			// $args = array(
			// 	'title_li' => '', // デフォルトの「カテゴリー」を非表示
			// 	'show_option_all' => 'すべて', // 全カテゴリーに表示する文字(空欄にすると全カテゴリーのメニューが非表示)
			// 	'echo'     => 0,
			// );
			// $categories = wp_list_categories($args);
			// $cat_serch   = '"cat-item'; // 変換前の文字列(変更不要)
			// $cat_replace = '"tab-menu'; // 変換後の文字列(liタグに付与したいclass名を書く)
			// $categories  = str_replace($cat_serch, $cat_replace, $categories);
			// if (strpos($categories, 'current-cat') == false) {
			// 	$categories = str_replace('cat-item-all', 'tab-menu current-cat', $categories);
			// } // 'tab-menu'には変換後の文字列で書いたclass名を書く
			// echo $categories;
			?>

			<!-- カテゴリーのリンクを特定のカテゴリーを指定して表示（liタグにclass名付与） -->
			<?php
			// $args = array(
			// 	'title_li' => '', // デフォルトの「カテゴリー」を非表示
			// 	'show_option_all' => 'すべて', // 全カテゴリーに表示する文字(空欄にすると全カテゴリーのメニューが非表示)
			// 	'include'  => '1,3,5', // 表示させたいカテゴリーID
			// 	'echo'     => 0,
			// );
			// $categories = wp_list_categories($args);
			// $cat_serch   = '"cat-item'; // 変換前の文字列(ここは変えない)
			// $cat_replace = '"tab-menu'; // 変換後の文字列(liタグに付与したいclass名を書く)
			// $categories  = str_replace($cat_serch, $cat_replace, $categories);
			// if (strpos($categories, 'current-cat') == false) {
			// 	$categories = str_replace('cat-item-all', 'tab-menu current-cat', $categories);
			// } // 'tab-menu'には変換後の文字列で書いたclass名を書く
			// echo $categories;
			?>

			<!-- カテゴリーのリンクを特定のカテゴリーを除外して表示（liタグにclass名付与） -->
			<?php
			// $args = array(
			// 	'title_li' => '', // デフォルトの「カテゴリー」を非表示
			// 	'show_option_all' => 'すべて', // 全カテゴリーに表示する文字(空欄にすると全カテゴリーのメニューが非表示)
			// 	'exclude'  => '1,3,5', // 表示させないカテゴリーID('include'がある場合は無効)
			// 	'echo'     => 0,
			// );
			// $categories = wp_list_categories($args);
			// $cat_serch   = '"cat-item'; // 変換前の文字列(ここは変えない)
			// $cat_replace = '"tab-menu'; // 変換後の文字列(liタグに付与したいclass名を書く)
			// $categories  = str_replace($cat_serch, $cat_replace, $categories);
			// if (strpos($categories, 'current-cat') == false) {
			// 	$categories = str_replace('cat-item-all', 'tab-menu current-cat', $categories);
			// } // 'tab-menu'には変換後の文字列で書いたclass名を書く
			// echo $categories;
			?>
		</ul>
		<ul class="">
			<!-- 記事のループ処理開始 -->
			<?php
			if (wp_is_mobile()) {
				$num = 3; // スマホの表示数(全件は-1)
			} else {
				$num = 5; // PCの表示数(全件は-1)
			}
			$paged = get_query_var('paged') ? get_query_var('paged') : 1;
			$args = [
				'post_type' => 'post', // 投稿タイプのスラッグ(通常投稿なので'post')
				'paged' => $paged, // ページネーションがある場合に必要
				'posts_per_page' => $num, // 表示件数
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
				<?php endwhile;
			else : ?>
				<p>まだ記事がありません</p>
			<?php endif ?>
			<?php wp_reset_postdata(); ?>
			<!-- 記事のループ処理終了 -->
		</ul>
		<!-- ページネーション(数字あり) -->
		<div class="">
			<?php
			the_posts_pagination(array(
				'mid_size' => 1,
				'prev_text' => '前へ',
				'next_text' => '次へ'
			));
			?>
		</div>
		<!-- ページネーション(前へ、次へのみ) -->
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
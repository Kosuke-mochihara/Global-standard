<?php get_header(); ?>
<main class="">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<article class="">
				<!-- 投稿タイトル -->
				<h1 class="">
					<?php the_title(); ?>
				</h1>

				<!-- 投稿日 -->
				<p class="">
					<time class="" datetime="<?php the_time('Y-m-d'); ?>">
						<?php the_time('Y.m.d'); ?>
					</time>
				</p>

				<!-- カテゴリー -->
				<!-- カテゴリーを全部表示(リンクあり) -->
				<?php
				// $categories = get_the_category();
				// echo '<ul class="">';
				// foreach ($categories as $category) {
				// 	echo '<li class=""><a href="' . get_category_link($category->cat_ID) . '">' . $category->name . '</a></li>';
				// }
				// echo '</ul>';
				?>

				<!-- カテゴリーを全部表示(リンクなし) -->
				<?php
				// $categories = get_the_category();
				// echo '<ul class="">';
				// foreach ($categories as $category) {
				// 	echo '<li class="">' . $category->name . '</li>';
				// }
				// echo '</ul>';
				?>

				<!-- 指定したカテゴリーのみ表示(投稿に含まれているもののみ：リンクあり) -->
				<?php
				// $categories = get_the_category();
				// echo '<ul class="">';
				// foreach ($categories as $category) {
				// 	if (!in_array($category->slug, array('表示したいカテゴリースラッグ', '表示したいカテゴリースラッグ')))
				// 		continue;
				// 	echo '<li class=""><a href="' . get_category_link($category->cat_ID) . '">' . $category->name . '</a></li>';
				// }
				// echo '</ul>';
				?>

				<!-- 指定したカテゴリーのみ表示(投稿に含まれているもののみ：リンクなし) -->
				<?php
				// $categories = get_the_category();
				// echo '<ul class="">';
				// foreach ($categories as $category) {
				// 	if (!in_array($category->slug, array('表示したいカテゴリースラッグ', '表示したいカテゴリースラッグ')))
				// 		continue;
				// 	echo '<li class="' . $category->slug . '">' . $category->name . '</li>';
				// }
				// echo '</ul>';
				?>

				<!-- 指定したカテゴリーを除外(リンクあり) -->
				<?php
				// $categories = get_the_category();
				// echo '<ul class="">';
				// foreach ($categories as $category) {
				// 	if (in_array($category->slug, array('除外したいカテゴリースラッグ', '除外したいカテゴリースラッグ')))
				// 		continue;
				// 	echo '<li class=""><a href="' . get_category_link($category->cat_ID) . '">' . $category->name . '</a></li>';
				// }
				// echo '</ul>';
				?>

				<!-- 指定したカテゴリーを除外(リンクなし) -->
				<?php
				// $categories = get_the_category();
				// echo '<ul class="">';
				// foreach ($categories as $category) {
				// 	if (in_array($category->slug, array('除外したいカテゴリースラッグ', '除外したいカテゴリースラッグ')))
				// 		continue;
				// 	echo '<li class="' . $category->slug . '">' . $category->name . '</li>';
				// }
				// echo '</ul>';
				?>

				<!-- アイキャッチ -->
				<div class="">
					<?php the_post_thumbnail('post-thumbnail', array('alt' => the_title_attribute('echo=0'))); ?>
				</div>

				<!-- 投稿本文 -->
				<div class="">
					<?php the_content(); ?>
				</div>

				<!-- ページネーション(前へ・次へをテキスト) -->
				<?php
				the_post_navigation(array(
					'prev_text' => '前へ',
					'next_text' => '次へ',
				));
				?>
				<!-- ページネーション(前へ・次へを画像) -->
				<?php
				the_post_navigation(array(
					'prev_text' => '<img src="' . get_template_directory_uri() . '画像の相対パス">',
					'next_text' => '<img src="' . get_template_directory_uri() . '画像の相対パス">',
				));
				?>

				<!-- 関連記事(同じタグを持つ記事) -->
				<ul class="">
					<?php
					if (wp_is_mobile()) {
						$num = 3; // スマホの表示数(全件は-1)
					} else {
						$num = 5; // PCの表示数(全件は-1)
					}
					$current_tags = get_the_tags();
					//この記事がタグを持っているかどうか判別
					if ($current_tags) :
						foreach ($current_tags as $tag) {
							$current_tag_list[] = $tag->term_id;
						}
						$args = array(
							'tag__in' => $current_tag_list, // 表示中の記事と同じタグを表示
							'post__not_in' => array($post->ID), // 表示中の記事は除く
							'posts_per_page' => $num, // 表示件数
							'orderby' =>  'rand', // ランダムに投稿を取得
						);
						$related_posts = new WP_Query($args);
						// 関連する記事があるかどうか判別
						if ($related_posts->have_posts()) :
					?>
							<?php
							// 関連する記事を表示
							while ($related_posts->have_posts()) :
								$related_posts->the_post();
							?>
								<li class="">
									<!-- liタグ内の書き方はhome.phpを参照 -->
								</li>
							<?php endwhile;
						else : ?>
							<p>関連記事はありません</p>
						<?php endif ?>
					<?php endif ?>
					<?php wp_reset_postdata(); ?>
				</ul>

			</article>
	<?php endwhile;
	endif; ?>
</main>
<?php get_footer(); ?>
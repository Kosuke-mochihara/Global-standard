<?php get_header(); ?>
<main class="">
	<?php if(have_posts()): while(have_posts()): the_post(); ?>
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

		<!-- カテゴリーの表示に関しては右を参照) -->


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
		  the_post_navigation( array(
		    'prev_text' => '前へ',
		    'next_text' => '次へ',
		  ) );
		?>
		<!-- ページネーション(前へ・次へを画像) -->
		<?php
		  the_post_navigation( array(
		    'prev_text' => '<img src="' . get_template_directory_uri() . '画像の相対パス">',
		    'next_text' => '<img src="' . get_template_directory_uri() . '画像の相対パス">',
		  ) );
		?>

		<!-- 関連記事(同じタームを持つ記事) -->
		<ul class="">
			<?php
		    if( wp_is_mobile() ){
		      $num = 3; // スマホの表示数(全件は-1)
		    } else {
		      $num = 5; // PCの表示数(全件は-1)
		    }
				$post_type_slug = 'blog', // カスタム投稿の投稿タイプスラッグ
			  $taxonomy_slug = 'blog_category', // タクソノミーのスラッグ
			  $post_terms = wp_get_object_terms($post->ID, $taxonomy_slug);
			  if( $post_terms && !is_wp_error($post_terms)) {
			    $terms_slug = array();
			    foreach( $post_terms as $value ){
			      $terms_slug[] = $value->slug;
			    }
			  }
			  $args = array (
			    'post_type' => $post_type_slug,
			    'posts_per_page' => $num, // 表示件数
			    'post__not_in' => array($post->ID), // 表示中の記事は除く
			    'orderby' =>  'rand', // ランダムに投稿を取得
			    'tax_query' => array (
			      array(
			        'taxonomy' => $taxonomy_slug,
			        'field' => 'slug',
			        'terms' => $terms_slug,
			      )
			    )
			  );
			  $the_query = new WP_Query($args); if($the_query->have_posts()):
			?>
			<?php while ($the_query->have_posts()): $the_query->the_post(); ?>
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
						  if ( $taxonomy_terms ) {
						    echo '<span>'.$taxonomy_terms[0]->name.'</span>';
						  }
						?>
		        <!-- カテゴリー(ターム)全部表示 -->
						<?php
						  $taxonomy_terms = get_the_terms($post->ID,'タクソノミースラッグ');
						  foreach( $taxonomy_terms as $taxonomy_term ) {
						    echo '<span class="'.$taxonomy_term->slug.'">'.$taxonomy_term->name.'</span>';
						  }
						?>
		        <!-- 指定したカテゴリー(ターム)のみ表示 -->
						<?php
						  $taxonomy_terms = get_the_terms($post->ID,'タクソノミースラッグ');
						  foreach( $taxonomy_terms as $taxonomy_term ) {
						    if ( !in_array( $taxonomy_term->slug, array( '表示したいタームスラッグ','表示したいタームスラッグ') ) )
						    continue;
						    echo '<span class="'.$taxonomy_term->slug.'">'.$taxonomy_term->name.'</span>';
						  }
						?>
		        <!-- 指定したカテゴリー(ターム)を除外 -->
						<?php
						  $taxonomy_terms = get_the_terms($post->ID,'タクソノミースラッグ');
						  foreach( $taxonomy_terms as $taxonomy_term ) {
						    if ( in_array( $taxonomy_term->slug, array( '除外したいタームスラッグ','除外したいタームスラッグ') ) )
						    continue;
						    echo '<span class="'.$taxonomy_term->slug.'">'.$taxonomy_term->name.'</span>';
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
			<?php endwhile; else: ?>
			<p>関連記事がありません</p>
			<?php endif ?>
			<?php wp_reset_postdata(); ?>
		</ul>

	</article>
	<?php endwhile; endif; ?>
</main>
<?php get_footer(); ?>

<aside class="sidebar-single" aria-label="Sidebar">
	<?php if(get_post_type() == 'post'): ?>		
		<?php if ( is_active_sidebar( 'news-sidebar' ) ) : ?>
			<?php dynamic_sidebar( 'news-sidebar' ); ?>
		<?php endif; ?>
	<?php endif; ?>
</aside>

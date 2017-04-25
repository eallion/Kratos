<?php
/**
 * 宽版页面
 *
 * @package custom
 */
 if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
	<div class="container">
		<div class="row">
            <section id="main" class='col-md-12'>
				<article>
					<div class="kratos-hentry kratos-post-inner clearfix">
						<header class="kratos-entry-header">
							<h1 class="kratos-entry-title text-center"><?php $this->title(); ?></h1>
						</header>
						<div class="kratos-post-content">
                        <?php parseContent($this); ?>
						</div>
					</div>
				</article>
			</section>
		</div>
	</div>
</div>
<?php $this->need('footer.php'); ?>
<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
	<div class="container">
		<div class="row">
		<section id="main" class='col-md-12'>
			<article>
				<div class="kratos-hentry kratos-post-inner clearfix"><div class="kratos-post-content">
				<h1>404 . Not Found</h1>
				<h2>沒有找到你要的内容！</h2>
				<p class="text-center"><a class="btn btn-primary" href="<?php $this->options ->siteUrl(); ?>">返回 <?php $this->options->title();?> 首页</a></p>
				</div></div>
			</article>
		</div>
	</div>
<?php $this->need('footer.php'); ?>
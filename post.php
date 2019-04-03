<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package Vtrois
 * @version 2.3
 */ 
 if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
	<div class="container">
		<div class="row">
            <section id="main" class='col-md-8'>
				<article>
					<div class="kratos-hentry kratos-post-inner clearfix">
						<header class="kratos-entry-header">
							<h1 class="kratos-entry-title text-center"><?php $this->title(); ?></h1>
							<div class="kratos-post-meta text-center">
								<span>
								<i class="fa fa-calendar"></i> <?php $this->date('F j, Y'); ?>
				                <i class="fa fa-commenting-o"></i> <?php $this->commentsNum('0', '1', '%d'); ?> Comments
								<?php if($this->category == "sz"): ?>
								<i class="fa fa-user"></i> 作者：<?php $this->author(); ?>
								<?php endif; ?>     
				                <i class="fa fa-eye"></i> <?php get_post_view($this); ?> Views
								<?php if($this->user->hasLogin()): ?>
								<i class="fa fa-edit"></i> <a href="https://eallion.com/admin/write-post.php?cid=<?php echo $this->cid;?>" >编辑</a>
								<?php endif; ?> 
								</span>
							</div>
						</header>
						<div class="kratos-post-content">
                        <?php parseContent($this); ?>
						</div>
						<footer class="kratos-entry-footer clearfix">
							<div class="footer-tag clearfix">
								<div class="pull-left">
								<i class="fa fa-tags"></i>
								<?php $this->tags(' ', true, '<a>没有标签</a>'); ?>
								</div>
							</div>
						</footer>
					</div>
					<div class="kratos-hentry kratos-copyright text-center clearfix">
						<h5>本作品采用 知识共享 <ins><a rel="license nofollow" target="_blank" href="https://creativecommons.org/licenses/by/4.0/deed.zh"><i class="fa fa-creative-commons"></i> 署名 4.0 国际</a></ins> 许可协议<?php if($this->category == "code"): ?> &bull; 代码遵循 <ins><a rel="license nofollow" target="_blank" href="https://opensource.org/licenses/mit-license.html">MIT协议</a></ins> </h5>
						<?php endif; ?>
					</div>
					<nav class="navigation post-navigation clearfix" role="navigation">
						<div class="nav-previous clearfix">
							<?php $this->thePrev(' %s ','已经是第一篇了',array('title' => '上一篇')); ?>
						</div>
						<div class="nav-next">
							<?php $this->theNext(' %s ','已经是最后了',array('title' => '下一篇')); ?>
						</div>
					</nav>
					<?php $this->need('comments.php'); ?>
				</article>
			</section>
				<aside id="kratos-widget-area" class="col-md-4 hidden-xs hidden-sm scrollspy">
	                <div id="sidebar">
	                    <?php $this->need('sidebar.php'); ?>
	                </div>
	            </aside>
		</div>
	</div>
</div>
<?php $this->need('footer.php'); ?>
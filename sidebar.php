<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div id="sidebar">
<?php //作者简介 ?>
	<aside id="kratos_about-5" class="widget amadeus_about clearfix">
		<div class="photo-background">
			<div class="photo-background" style="background:url(https://getcdn.org/eallion/themes/Kratos/images/about.jpg) no-repeat center center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
			</div>
		</div>
		<div class="photo-wrapper clearfix">
			<div class="photo-wrapper-tip text-center"><img class="about-photo" src="https://getcdn.org/eallion/themes/Kratos/images/author.jpg">
			</div>
		</div>
		<div class="textwidget"><p align="center">Chance favors the prepared mind.</p></div>
	</aside>

<?php //搜索框 ?>
	<aside id="kratos_search" class="widget widget_kratos_search clearfix"><h4 class="widget-title">搜索</h4><form role="search" method="get" action="https://eallion.com/"><div class="form-group"> <input type="text" name="s" id="s" placeholder="Search…" class="form-control" x-webkit-speech=""></div></form></aside>

<?php //热门随机文章 ?>
    <aside class="widget widget_kratos_poststab">
		<ul id="tabul" class="nav nav-tabs nav-justified visible-lg">
			<li><a href="#newest" data-toggle="tab"> 最新文章</a></li>
			<li class=""><a href="#hot" data-toggle="tab"> 热点文章</a></li>
			<li><a href="#rand" data-toggle="tab">随机文章</a></li>
		</ul>
		<ul id="tabul" class="nav nav-tabs nav-justified visible-md">
			<li><a href="#newest" data-toggle="tab"> 最新</a></li>
			<li class=""><a href="#hot" data-toggle="tab"> 热点</a></li>
			<li><a href="#rand" data-toggle="tab">随机</a></li>
		</ul>
	<div class="tab-content">
		<div class="tab-pane fade" id="newest">
			<ul class="list-group">
				<?php $this->widget('Widget_Contents_Post_Recent','pageSize=6')->to($post); ?>
				<?php while($post->next()): ?>
					<a class="list-group-item visible-lg" title="<?php $post->title(); ?>" href="<?php $post->permalink(); ?>" rel="bookmark"><i class="fa  fa-book"></i> <?php $post->title(); ?></a> 
					<a class="list-group-item visible-md" title="<?php $post->title(); ?>" href="<?php $post->permalink(); ?>" rel="bookmark"><i class="fa  fa-book"></i> <?php $post->title(); ?></a>
				<?php endwhile; ?>
			</ul>
		</div>
		<div class="tab-pane fade  in active" id="hot">
			<ul class="list-group"> 
				<?php rmcp('30',6); ?>
			</ul>
		</div>
		<div class="tab-pane fade" id="rand">
			<ul class="list-group"> 
				<?php theme_random_posts(); ?>
			</ul>
		</div>
	</div>
	</aside>

<?php //分类目录 ?>
	<aside id="categories-6" class="widget widget_categories clearfix">
		<h4 class="widget-title">分类目录</h4>
			<ul><?php $this->widget('Widget_Metas_Category_List')->to($cats);?>
				<?php while ($cats->next()): ?>
				<li class="cat-item"><a href="<?php $cats->permalink()?>"><?php $cats->name()?></a> (<?php $cats->count()?>)</li><?php endwhile; ?>
			</ul>
	</aside>

<?php //标签云 ?>
	<aside id="kratos_tags" class="widget widget_kratos_tags clearfix">
		<div class="tag_clouds">
			<?php $this->widget('Widget_Metas_Tag_Cloud', 'ignoreZeroCount=1&limit=20')->to($tags); ?>
			<?php while($tags->next()): ?>
				<a href="<?php $tags->permalink(); ?>" class="tag-link tag-link-position"  title="<?php $tags->count(); ?>个话题" style="font-size: 14px;"><?php $tags->name(); ?></a>
			<?php endwhile; ?>
		</div>
	</aside>

<?php //广告位 ?>
<!--
	<aside id="kratos_ad-2" class="widget widget_kratos_ad clearfix">
	
    </aside>
-->
</div><!-- end #sidebar -->

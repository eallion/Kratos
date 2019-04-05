﻿﻿<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/* 后台设置 */
function themeConfig($form) {
	//header部分
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点LOGO地址'), _t('在这里填入一个图片URL地址, 以在网站标题前加上一个LOGO'));
	$form->addInput($logoUrl->addRule('xssCheck', _t('请不要在图片链接中使用特殊字符')));
	$logoTxt = new Typecho_Widget_Helper_Form_Element_Text('logoTxt', NULL, NULL, _t('居中标题'), _t('Banner正中展示的简单标题'));
	$form->addInput($logoTxt);

	$bannerimg = new Typecho_Widget_Helper_Form_Element_Text('bannerimg', NULL, NULL, _t('顶部Banner图片'), _t('顶部Banner图片链接'));
    $form->addInput($bannerimg);

	$site_bw = new Typecho_Widget_Helper_Form_Element_Radio('site_bw',
        array('able'=>_t('开启'),'disable'=>_t('关闭')),
        'disable',
        _t("站点黑白模式"),
        _t("开启后站点呈现为黑白模式")
        );
    $form->addInput($site_bw);

	
	//侧边栏
	$sidebarlr = new Typecho_Widget_Helper_Form_Element_Radio('sidebarlr',
        array('left_side' => _t('左边栏'),
            'right_side' => _t('右边栏'),
			'single' => _t('无边栏'),
        ),
        'right_side', _t('非首页侧边栏设置'), _t('默认右边栏'));
    $form->addInput($sidebarlr);
	
    $sidebarBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('sidebarBlock', 
    array('ShowAuthor' => _t('作者简介'),
    'ShowSearch' => _t('搜索框'),
    'ShowRecent' => _t('最新文章'),
	'ShowCategory' => _t('分类目录'),
	'ShowTags' => _t('标签云')),
    array('ShowAuthor', 'ShowSearch', 'ShowRecent', 'ShowCategory', 'ShowTags'), _t('侧边栏显示'));    
    $form->addInput($sidebarBlock->multiMode());
	
	$authordesc = new Typecho_Widget_Helper_Form_Element_Text('authordesc', null, NULL, _t('作者简介'), _t('侧边栏的作者简介以&lt;br&gt;换行 图片请自行替换images文件夹中about.jpg和author.jpg 或者自行修改sidebar.php'));
	$form->addInput($authordesc);



	//社交
    $socialweixin = new Typecho_Widget_Helper_Form_Element_Text('socialweixin', NULL, NULL, _t('输入微信二维码链接'), _t('在这里输入微信二维码链接,图片格式,支持 http:// 或 https:// 或 //'));
    $form->addInput($socialweixin->addRule('xssCheck', _t('请不要在图片链接中使用特殊字符')));
	$socialweibo = new Typecho_Widget_Helper_Form_Element_Text('socialweibo', NULL, NULL, _t('输入微博链接'), _t('在这里输入微博链接,支持 http:// 或 https:// 或 //'));
    $form->addInput($socialweibo->addRule('xssCheck', _t('请不要在链接中使用特殊字符')));
    $socialtwitter = new Typecho_Widget_Helper_Form_Element_Text('socialtwitter', NULL, NULL, _t('输入Twitter链接'), _t('在这里输入twitter链接,支持 http:// 或 https:// 或 //'));
    $form->addInput($socialtwitter->addRule('xssCheck', _t('请不要在链接中使用特殊字符')));
	$socialfacebook = new Typecho_Widget_Helper_Form_Element_Text('socialfacebook', NULL, NULL, _t('输入Facebook链接'), _t('在这里输入Facebook链接,支持 http:// 或 https:// 或 //'));
    $form->addInput($socialfacebook->addRule('xssCheck', _t('请不要在链接中使用特殊字符')));
	$socialrss = new Typecho_Widget_Helper_Form_Element_Text('socialrss', NULL, NULL, _t('输入RSS链接'), _t('在这里输入rss链接,留空不输出，站点原版请输入off,支持 http:// 或 https:// 或 //'));
    $form->addInput($socialrss->addRule('xssCheck', _t('请不要在链接中使用特殊字符')));
		
	//图片CDN
    $srcAddress = new Typecho_Widget_Helper_Form_Element_Text('src_add', NULL, NULL, _t('图片CDN替换前地址'), _t('即你的附件存放链接，一般为http://www.yourblog.com/usr/uploads/'));
    $form->addInput($srcAddress->addRule('xssCheck', _t('请不要在链接中使用特殊字符')));
    $cdnAddress = new Typecho_Widget_Helper_Form_Element_Text('cdn_add', NULL, NULL, _t('图片CDN替换后地址'), _t('即你的七牛云存储域名，一般为http://yourblog.qiniudn.com/，可能也支持其他有镜像功能的CDN服务'));
    $form->addInput($cdnAddress->addRule('xssCheck', _t('请不要在链接中使用特殊字符')));
    $default_thumb = new Typecho_Widget_Helper_Form_Element_Text('default_thumb', NULL, '', _t('默认缩略图'),_t('文章没有图片时的默认缩略图，留空则无，一般为http://www.yourblog.com/image.png'));
    $form->addInput($default_thumb->addRule('xssCheck', _t('请不要在链接中使用特殊字符')));
	
	
    $ad_postend = new Typecho_Widget_Helper_Form_Element_Text('ad_postend', NULL, NULL, _t('文章尾部广告图片链接'), _t('图片链接,支持 http:// 或 https:// 或 //'));
    $form->addInput($ad_postend->addRule('xssCheck', _t('请不要在图片链接中使用特殊字符')));
	$ad_sidebar = new Typecho_Widget_Helper_Form_Element_Text('ad_sidebar', NULL, NULL, _t('侧边栏广告'), _t('自定义广告代码'));
    $form->addInput($ad_sidebar);

	

}



/**
 * 解析内容以实现附件加速
 * @access public
 * @param string $content 文章正文
 * @param Widget_Abstract_Contents $obj
 */
function parseContent($obj) {
    $options = Typecho_Widget::widget('Widget_Options');
    if (!empty($options->src_add) && !empty($options->cdn_add)) {
        $obj->content = str_ireplace($options->src_add, $options->cdn_add, $obj->content);
    }
    $obj->content = preg_replace("/<a href=\"([^\"]*)\">/i", "<a href=\"\\1\" target=\"_blank\">", $obj->content);
    echo trim($obj->content);
}


/*文章阅读次数统计*/
function get_post_view($archive) {
    $cid = $archive->cid;
    $db = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
        echo 0;
        return;
    }
    $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
    if ($archive->is('single')) {
        $views = Typecho_Cookie::get('extend_contents_views');
        if (empty($views)) {
            $views = array();
        } else {
            $views = explode(',', $views);
        }
        if (!in_array($cid, $views)) {
            $db->query($db->update('table.contents')->rows(array('views' => (int)$row['views'] + 1))->where('cid = ?', $cid));
            array_push($views, $cid);
            $views = implode(',', $views);
            Typecho_Cookie::set('extend_contents_views', $views); //记录查看cookie
            
        }
    }
    echo $row['views'];
}


/*Typecho 24小时发布文章数量*/
function get_recent_posts_number($days = 1,$display = true)
{
$db = Typecho_Db::get();
$today = time() + 3600 * 8;
$daysago = $today - ($days * 24 * 60 * 60);
$total_posts = $db->fetchObject($db->select(array('COUNT(cid)' => 'num'))
->from('table.contents')
->orWhere('created < ? AND created > ?', $today,$daysago)
->where('type = ? AND status = ? AND password IS NULL', 'post', 'publish'))->num;
if($display) {
echo $total_posts;
} else {
return $total_posts;
}
}

//热门文章（评论最多）
function rmcp($days = 30,$num = 5){
$defaults = array(
'before' => '',
'after' => '',
'xformat' => '<a class="list-group-item visible-lg" title="{title}" href="{permalink}" rel="bookmark"><i class="fa  fa-book"></i> {title}</a> 
	<a class="list-group-item visible-md" title="{title}" href="{permalink}" rel="bookmark"><i class="fa  fa-book"></i> {title}</a>'
);
$time = time() - (24 * 60 * 60 * $days);
$db = Typecho_Db::get();
$sql = $db->select()->from('table.contents')
->where('created >= ?', $time)
->where('type = ?', 'post')
->limit($num)
->order('commentsNum',Typecho_Db::SORT_DESC);
$result = $db->fetchAll($sql);
echo $defaults['before'];
foreach($result as $val){
$val = Typecho_Widget::widget('Widget_Abstract_Contents')->filter($val);
echo str_replace(array('{permalink}', '{title}', '{commentsNum}'), array($val['permalink'], $val['title'], $val['commentsNum']), $defaults['xformat']);
}
echo $defaults['after'];
}

//随机文章
function theme_random_posts(){
$defaults = array(
'number' => 6,
'before' => '',
'after' => '',
'xformat' => '<a class="list-group-item visible-lg" title="{title}" href="{permalink}" rel="bookmark"><i class="fa  fa-book"></i> {title}</a> 
	<a class="list-group-item visible-md" title="{title}" href="{permalink}" rel="bookmark"><i class="fa  fa-book"></i> {title}</a>'
);
$db = Typecho_Db::get();
 
$sql = $db->select()->from('table.contents')
->where('status = ?','publish')
->where('type = ?', 'post')
->where('created <= unix_timestamp(now())', 'post') //添加这一句避免未达到时间的文章提前曝光
->limit($defaults['number'])
->order('RAND()');
 
$result = $db->fetchAll($sql);
echo $defaults['before'];
foreach($result as $val){
$val = Typecho_Widget::widget('Widget_Abstract_Contents')->filter($val);
echo str_replace(array('{permalink}', '{title}'),array($val['permalink'], $val['title']), $defaults['xformat']);
}
echo $defaults['after'];
}

//缩略图调用
function showThumb($obj,$size=null,$link=false){
    preg_match_all( "/<[img|IMG].*?src=[\'|\"](.*?)[\'|\"].*?[\/]?>/", $obj->content, $matches );
    $thumb = '';
    $options = Typecho_Widget::widget('Widget_Options');
    $attach = $obj->attachments(1)->attachment;
    if (isset($attach->isImage) && $attach->isImage == 1){
        $thumb = $attach->url;
        if(!empty($options->src_add) && !empty($options->cdn_add)){
            $thumb = str_ireplace($options->src_add,$options->cdn_add,$thumb);
        }
    }elseif(isset($matches[1][0])){
        $thumb = $matches[1][0];
        if(!empty($options->src_add) && !empty($options->cdn_add)){
            $thumb = str_ireplace($options->src_add,$options->cdn_add,$thumb);
        }
    }
    if(empty($thumb) && empty($options->default_thumb)){
		$thumb= $options->themeUrl .'/images/thumb/' . rand(1, 20) . '.jpg';
		//去掉下面4行双斜杠 启用BING美图随机缩略图
		//$str = file_get_contents('http://cn.bing.com/HPImageArchive.aspx?format=js&idx='.rand(1, 30).'&n=1');
        //$array = json_decode($str);
		//$imgurl = $array->{"images"}[0]->{"urlbase"};
        //$thumb = '//i'.rand(0, 2).'.wp.com/cn.bing.com'.$imgurl.'_1920x1080.jpg?resize=220,150';
		
        return $thumb;
    }else{
        $thumb = empty($thumb) ? $options->default_thumb : $thumb;
    }
    if($link){
        return $thumb;
    }
}

/* 随机格言 */
	function eallion($type)
	{
		$i = 0;
		$saying="";
		switch ($type)
		{
			case "notice":
			$saying='天行geek，君子以自强bullshit，地势queen，君子以hold载物。';
			break;
			case "ad":
			$i=rand(0,1);
			{
			if ($i==0)
			{$saying="莺花犹怕春光老，岂可教人枉度春";}
			else
			{$saying="马行无力皆因瘦，人不风流只为贫";}
			break;
			}
			default:
				$ads = array(
					'昔时贤文 诲汝谆谆 集韵增文 多见多闻',
					'观今宜鉴古 无古不成今',
					'知己知彼 将心比心',
					'酒逢知己饮 诗向会人吟',
					'相识满天下 知心能几人',
					'相逢好似初相识 到老终无怨恨心',
					'近水知鱼性 近山识鸟音',
					'易涨易退山溪水 易反易覆小人心',
					'运去金成铁 时来铁似金 读书须用意 一字值千金',
					'逢人且说三分话 未可全抛一片心',
					'有意栽花花不发 无心插柳柳成阴',
					'画虎画皮难画骨 知人知面不知心',
					'钱财如粪土 仁义值千金',
					'流水下滩非有意 白云出岫本无心',
					'当时若不登高望 谁信东流海洋深',
					'路遥知马力 事久见人心',
					'两人一般心 无钱堪买金 一人一般心 有钱难买针',
					'相见易得好 久住难为人',
					'马行无力皆因瘦 人不风流只为贫',
					'饶人不是痴汉 痴汉不会饶人',
					'是亲不是亲 非亲却是亲',
					'美不美 乡中水 亲不亲 故乡人',
					'莺花犹怕春光老 岂可教人枉度春',
					'相逢不饮空归去 洞口桃花也笑人',
					'红粉佳人休使老 风流浪子莫教贫',
					'在家不会迎宾客 出外方知少主人',
					'黄金无假 阿魏无真',
					'客来主不顾 应恐是痴人',
					'贫居闹市无人问 富在深山有远亲',
					'谁人背后无人说 哪个人前不说人',
					'有钱道真语 无钱语不真',
					'不信但看筵中酒 杯杯先劝有钱人',
					'闹里有钱 静处安身',
					'来如风雨 去似微尘',
					'长江后浪推前浪 世上新人赶旧人',
					'近水楼台先得月 向阳花木早逢春',
					'莫道君行早 更有早行人',
					'莫信直中直 须防仁不仁',
					'山中有直树 世上无直人',
					'自恨枝无叶 莫怨太阳偏',
					'大家都是命 半点不由人',
					'一年之计在于春 一日之计在于寅 一家之计在于和 一生之计在于勤',
					'责人之心责己 恕己之心恕人',
					'守口如瓶 防意如城',
					'宁可人负我 切莫我负人',
					'再三须慎意 第一莫欺心',
					'虎生犹可近 人熟不堪亲',
					'来说是非者 便是是非人',
					'远水难救近火 远亲不如近邻',
					'有茶有酒多兄弟 急难何曾见一人',
					'人情似纸张张薄 世事如棋局局新',
					'山中也有千年树 世上难逢百岁人',
					'力微休负重 言轻莫劝人',
					'无钱休入众 遭难莫寻亲',
					'平生莫作皱眉事 世上应无切齿人',
					'士者国之宝 儒为席上珍',
					'若要断酒法 醒眼看醉人',
					'求人须求大丈夫 济人须济急时无',
					'渴时一滴如甘露 醉后添杯不如无',
					'久住令人贱 频来亲也疏',
					'酒中不语真君子 财上分明大丈夫',
					'出家如初 成佛有馀',
					'积金千两 不如明解经书',
					'养子不教如养驴 养女不教如养猪',
					'有田不耕仓廪虚 有书不读子孙愚',
					'仓廪虚兮岁月乏 子孙愚兮礼义疏',
					'同君一席话 胜读十年书',
					'人不通今古 马牛如襟裾',
					'茫茫四海人无数 哪个男儿是丈夫',
					'白酒酿成缘好客 黄金散尽为收书',
					'救人一命 胜造七级浮屠',
					'城门失火 殃及池鱼',
					'庭前生瑞草 好事不如无',
					'欲求生富贵 须下死工夫',
					'百年成之不足 一旦败之有馀',
					'人心似铁 官法如炉',
					'善化不足 恶化有馀',
					'水太清则无鱼 人至察则无徒',
					'知者减半 省者全无',
					'在家由父 出家从夫',
					'痴人畏妇 贤女敬夫',
					'是非终日有 不听自然无',
					'宁可正而不足 不可邪而有馀',
					'宁可信其有 不可信其无',
					'竹篱茅舍风光好 道院僧堂终不如',
					'命里有时终须有 命里无时莫强求',
					'道院迎仙客 书堂隐相儒',
					'庭栽栖凤竹 池养化龙鱼',
					'结交须胜己 似我不如无',
					'但看三五日 相见不如初',
					'人情似水分高下 世事如云任卷舒',
					'会说说都是 不会说无礼',
					'磨刀恨不利 刀利伤人指',
					'求财恨不得 财多害自己',
					'知足常足 终身不辱',
					'知止常止 终身不耻',
					'有福伤财 无福伤己',
					'差之毫厘 失之千里',
					'若登高必自卑 若涉远必自迩',
					'三思而行 再思可矣',
					'使口不如自走 求人不如求己',
					'小时是兄弟 长大各乡里',
					'妒财莫妒食 怨生莫怨死',
					'人见白头嗔 我见白头喜',
					'多少少年亡 不到白头死',
					'墙有逢 壁有耳',
					'好事不出门 恶事传千里',
					'贼是小人 知过君子',
					'君子固穷 小人穷斯滥也',
					'贫穷自在 富贵多忧',
					'不以我为德 反以我为仇',
					'宁向直中取 不可曲中求',
					'人无远虑 必有近忧',
					'知我者谓我心忧 不知我者谓我何求',
					'晴天不肯去 只待雨淋头',
					'成事莫说 覆水难收',
					'是非只为多开口 烦恼皆因强出头',
					'忍得一时之气 免得百日之忧',
					'近来学得乌龟法 得缩头时且缩头',
					'惧法朝朝乐 欺公日日忧',
					'人生一世 草生一春',
					'黑发不知勤学早 看看又是白头翁',
					'月到十五光明少 人到中年万事休',
					'儿孙自有儿孙福 莫为儿孙作马牛',
					'人生不满百 常怀千岁忧',
					'今朝有酒今朝醉 明日愁来明日忧',
					'路逢险处难回避 事到头来不自由',
					'药能医假病 酒不解真愁',
					'人贫不语 水平不流',
					'一家有女百家求 一马不行百马忧',
					'有花方酌酒 无月不登楼',
					'三杯通大道 一醉解千愁',
					'深山毕竟藏猛虎 大海终须纳细流',
					'惜花须检点 爱月不梳头',
					'大抵选他肌骨好 不擦红粉也风流',
					'受恩深处宜先退 得意浓时便可休',
					'莫待是非来入耳 从前恩爱反为仇',
					'留得五湖明月在 不愁无处下金钩',
					'休别有鱼处 莫恋浅滩头',
					'去时终须去 再三留不住',
					'忍一句 息一怒 饶一著 退一步',
					'三十不豪 四十不富 五十将来寻死路',
					'生不论魂 死不认尸',
					'父母恩深终有别 夫妻义重也分离',
					'人生似鸟同林宿 大限来时各自飞',
					'人善被人欺 马善被人骑',
					'人无横财不富 马无野草不肥',
					'人恶人怕天不怕 人善人欺天不欺',
					'善恶到头终有报 只争来早与来迟',
					'黄河尚有澄清日 岂可人无得运时',
					'得宠思辱 安居虑危',
					'念念有如临敌日 心心常似过桥时',
					'英雄行险道 富贵似花枝',
					'人情莫道春光好 只怕秋来有冷时',
					'送君千里 终须一别',
					'但将冷眼看螃蟹 看你横行到几时',
					'见事莫说 问事不知',
					'闲事休管 无事早归',
					'假缎染就真红色 也被旁人说是非',
					'善事可作 恶事莫为',
					'许人一物 千金不移',
					'龙生龙子 虎生豹儿',
					'龙游浅水遭虾戏 虎落平阳被犬欺',
					'一举首登龙虎榜 十年身到凤凰池',
					'十年窗下无人问 一举成名天下知',
					'酒债寻常行处有 人生七十古来稀',
					'养儿待老 积谷防饥',
					'鸡豚狗彘之畜 无失其时',
					'数家之口 可以无饥矣',
					'常将有日思无日 莫把无时当有时',
					'时来风送腾王阁 运去雷轰荐福碑',
					'入门休问荣枯事 观看容颜便得知',
					'官清书吏瘦 神灵庙祝肥',
					'息却雷霆之怒 罢却虎狼之威',
					'饶人算人之本 输人算人之机',
					'好言难得 恶语易施',
					'一言既出 驷马难追',
					'道吾好者是吾贼 道吾恶者是吾师',
					'路逢侠客须呈剑 不是才人莫献诗',
					'三人同行 必有我师 择其善者而从之 其不善者而改之',
					'少壮不努力 老大徒悲伤',
					'人有善愿 天必佑之',
					'莫饮卯时酒 昏昏醉到酉',
					'莫骂酉时妻 一夜受孤凄',
					'种麻得麻 种豆得豆',
					'天眼恢恢 疏而不漏',
					'见官莫向前 做客莫在后',
					'宁添一斗 莫添一口',
					'螳螂捕蝉 岂知黄雀在后',
					'不求金玉重重贵 但愿儿孙个个贤',
					'一日夫妻 百世姻缘',
					'百世修来同船渡 千世修来共枕眠',
					'杀人一万 自损三千',
					'伤人一语 利如刀割',
					'枯木逢春犹再发 人无两度再少年',
					'未晚先投宿 鸡鸣早看天',
					'将相胸前堪走马 公候肚里好撑船',
					'富人思来年 穷人思眼前',
					'世上若要人情好 赊去物件莫取钱',
					'死生有命 富贵在天',
					'击石原有火 不击乃无烟',
					'为学始知道 不学亦徒然',
					'莫笑他人老 终须还到老',
					'但能依本分 终须无烦恼',
					'君子爱财 取之有道',
					'贞妇爱色 纳之以礼',
					'善有善报 恶有恶报',
					'不是不报 日子不到',
					'人而无信 不知其可也',
					'一人道好 千人传实',
					'凡事要好 须问三老',
					'若争小可 便失大道',
					'年年防饥 夜夜防盗',
					'学者如禾如稻 不学者如蒿如草',
					'遇饮酒时须饮酒 得高歌处且高歌',
					'因风吹火 用力不多',
					'不因渔父引 怎得见波涛',
					'无求到处人情好 不饮从他酒价高',
					'知事少时烦恼少 识人多处是非多',
					'入山不怕伤人虎 只怕人情两面刀',
					'强中更有强中手 恶人须用恶人磨',
					'会使不在家豪富 风流不用著衣多',
					'光阴似箭 日月如梭',
					'天时不如地利 地利不如人和',
					'黄金未为贵 安乐值钱多',
					'世上万般皆下品 思量唯有读书高',
					'世间好语书说尽 天下名山僧占多',
					'为善最乐 为恶难逃',
					'羊有跪乳之恩 鸦有反哺之义',
					'你急他未急 人闲心不闲',
					'隐恶扬善 执其两端',
					'妻贤夫祸少 子孝父心宽',
					'既坠釜甑 反顾无益',
					'翻覆之水 收之实难',
					'人生知足何时足 人老偷闲且是闲',
					'但有绿杨堪系马 处处有路透长安',
					'见者易 学者难',
					'莫将容易得 便作等闲看',
					'用心计较般般错 退步思量事事难',
					'道路各别 养家一般',
					'从俭入奢易 从奢入俭难',
					'知音说与知音听 不是知音莫与弹',
					'点石化为金 人心犹未足',
					'信了肚 卖了屋',
					'他人观花 不涉你目',
					'他人碌碌 不涉你足',
					'谁人不爱子孙贤 谁人不爱千钟粟',
					'莫把真心空计较 五行不是这题目',
					'与人不和 劝人养鹅',
					'与人不睦 劝人架屋',
					'但行好事 莫问前程',
					'河狭水急 人急计生',
					'明知山有虎 莫向虎山行',
					'路不行不到 事不为不成',
					'人不劝不善 钟不打不鸣',
					'无钱方断酒 临老始看经',
					'点塔七层 不如暗处一灯',
					'万事劝人休瞒昧 举头三尺有神明',
					'但存方寸土 留与子孙耕',
					'灭却心头火 剔起佛前灯',
					'惺惺常不足 懵懵作公卿',
					'众星朗朗 不如孤月独明',
					'兄弟相害 不如自生',
					'合理可作 小利莫争',
					'牡丹花好空入目 枣花虽小结实成',
					'欺老莫欺小 欺人心不明',
					'随分耕锄收地利 他时饱满谢苍天',
					'得忍且忍 得耐且耐',
					'不忍不耐 小事成大',
					'相论逞英雄 家计渐渐退',
					'贤妇令夫贵 恶妇令夫败',
					'一人有庆 兆民咸赖',
					'人老心未老 人穷志莫穷',
					'人无千日好 花无百日红',
					'杀人可恕 情理难容',
					'乍富不知新受用 乍贫难改旧家风',
					'座上客常满 樽中酒不空',
					'屋漏更遭连年雨 行船又遇打头风',
					'笋因落箨方成竹 鱼为奔波始化龙',
					'记得少年骑竹马 看看又是白头翁',
					'礼义生于富足 盗贼出于贫穷',
					'天上众星皆拱北 世间无水不朝东',
					'君子安平 达人知命',
					'忠言逆耳利于行 良药苦口利于病',
					'顺天者存 逆天者亡',
					'人为财死 鸟为食亡',
					'夫妻相合好 琴瑟与笙簧',
					'有儿贫不久 无子富不长',
					'善必寿老 恶必早亡',
					'爽口食多偏作药 快心事过恐生殃',
					'富贵定要安本分 贫穷不必枉思量',
					'画水无风空作浪 绣花虽好不闻香',
					'贪他一斗米 失却半年粮',
					'争他一脚豚 反失一肘羊',
					'龙归晚洞云犹湿 麝过春山草木香',
					'平生只会量人短 何不回头把自量',
					'见善如不及 见恶如探汤',
					'人贫志短 马瘦毛长',
					'自家心里急 他人未知忙',
					'贫无达士将金赠 病有高人说药方',
					'触来莫与说 事过心清凉',
					'秋至满山多秀色 春来无处不花香',
					'凡人不可貌相 海水不可斗量',
					'清清之水 为土所防',
					'济济之士 为酒所伤',
					'蒿草之下 或有兰香',
					'茅茨之屋 或有侯王',
					'无限朱门生饿殍 几多白屋出卿相',
					'醉后乾坤大 壶中日月长',
					'万事皆已定 浮生空白茫',
					'千里送毫毛 礼轻仁义重',
					'一人传虚 百人传实',
					'世事明如镜 前程暗似漆',
					'光阴黄金难买 一世如驹过隙',
					'良田万倾 日食一升',
					'大厦千间 夜眠八尺',
					'千经万典 孝义为先',
					'一字入公门 九牛拖不出',
					'衙门八字开 有理无钱莫进来',
					'富从升合起 贫因不算来',
					'家中无才子 官从何处来',
					'万事不由人计较 一生都是命安排',
					'急行慢行 前程只有多少路',
					'人间私语 天闻若雷',
					'暗室亏心 神目如电',
					'一毫之恶 劝人莫作',
					'一毫之善 与人方便',
					'欺人是祸 饶人是福',
					'天眼恢恢 报应甚速',
					'圣贤言语 神钦鬼伏',
					'人各有心 心各有见',
					'口说不如身逢 耳闻不如目见',
					'养军千日 用在一朝',
					'国清才子贵 家富小儿骄',
					'利刀割体痕易合 恶语伤人恨不消',
					'公道世间唯白发 贵人头上不曾饶',
					'有钱堪出众 无衣懒出门',
					'为官须作相 及第必争先',
					'苗从地发 树向枝分',
					'父子和而家不退 兄弟和而家不分',
					'官有正条 民有和约',
					'闲时不烧香 急时抱佛脚',
					'幸生太平无事日 恐逢年老不多时',
					'国乱思良将 家贫思贤妻',
					'池塘积水须防旱 田地勤耕足养家',
					'根深不怕风摇动 树正无愁月影斜',
					'奉劝君子 各宜守己',
					'只此程式 万无一失',
			);
		$rand = array_rand($ads);
		$saying=$ads[$rand];
		}
		echo $saying;
	}

// 网站运行时间
// 若要使用<!--?php getBuildTime(); ?-->
// 设置时区
date_default_timezone_set('Asia/Shanghai');
/**
* 秒转时间，格式 年 月 日 时 分 秒
*
* @author Roogle
* @return html
*/
function getBuildTime(){
// 在下面按格式输入本站创建的时间
	$site_create_time = strtotime('2006-05-22 00:00:00');
	$time = time() - $site_create_time;
	if(is_numeric($time)){
		$value = array("years" => 0, "days" => 0, "hours" => 0,"minutes" => 0, "seconds" => 0,);
		if($time >= 31556926){
			$value["years"] = floor($time/31556926);$time = ($time%31556926);
			}	
		if($time >= 86400){
			$value["days"] = floor($time/86400);
			$time = ($time%86400);
			}
		if($time >= 3600){
			$value["hours"] = floor($time/3600);
			$time = ($time%3600);
			}
		if($time >= 60){
			$value["minutes"] = floor($time/60);
			$time = ($time%60);
			}
			$value["seconds"] = floor($time);
 
		echo '<span class="btime">'.$value['days'].' days</span>';
		}
	else{
		echo '';
		}
	}

?>
﻿<?php
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
 * 文章链接在新窗口打开
 */
 /**
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
					'昔時賢文 誨汝諄諄 集韻增文 多見多聞',
					'觀今宜鑒古 無古不成今',
					'知己知彼 將心比心',
					'酒逢知己飲 詩向會人吟',
					'相識滿天下 知心能幾人',
					'相逢好似初相識 到老終無怨恨心',
					'近水知魚性 近山識鳥音',
					'易漲易退山溪水 易反易覆小人心',
					'運去金成鐵 時來鐵似金 讀書須用意 一字值千金',
					'逢人且說三分話 未可全拋一片心',
					'有意栽花花不發 無心插柳柳成陰',
					'畫虎畫皮難畫骨 知人知面不知心',
					'錢財如糞土 仁義值千金',
					'流水下灘非有意 白雲出岫本無心',
					'當時若不登高望 誰信東流海洋深',
					'路遙知馬力 事久見人心',
					'兩人一般心 無錢堪買金 一人一般心 有錢難買針',
					'相見易得好 久住難為人',
					'馬行無力皆因瘦 人不風流只為貧',
					'饒人不是癡漢 癡漢不會饒人',
					'是親不是親 非親卻是親',
					'美不美 鄉中水 親不親 故鄉人',
					'鶯花猶怕春光老 豈可教人枉度春',
					'相逢不飲空歸去 洞口桃花也笑人',
					'紅粉佳人休使老 風流浪子莫教貧',
					'在家不會迎賓客 出外方知少主人',
					'黃金無假 阿魏無真',
					'客來主不顧 應恐是癡人',
					'貧居鬧市無人問 富在深山有遠親',
					'誰人背後無人說 哪個人前不說人',
					'有錢道真語 無錢語不真',
					'不信但看筵中酒 杯杯先勸有錢人',
					'鬧里有錢 靜處安身',
					'來如風雨 去似微塵',
					'長江後浪推前浪 世上新人趕舊人',
					'近水樓臺先得月 向陽花木早逢春',
					'莫道君行早 更有早行人',
					'莫信直中直 須防仁不仁',
					'山中有直樹 世上無直人',
					'自恨枝無葉 莫怨太陽偏',
					'大家都是命 半點不由人',
					'一年之計在於春 一日之計在於寅',
					'一家之計在於和 一生之計在於勤',
					'責人之心責己 恕己之心恕人',
					'守口如瓶 防意如城',
					'寧可人負我 切莫我負人',
					'再三須慎意 第一莫欺心',
					'虎生猶可近 人熟不堪親',
					'來說是非者 便是是非人',
					'遠水難救近火 遠親不如近鄰',
					'有茶有酒多兄弟 急難何曾見一人',
					'人情似紙張張薄 世事如棋局局新',
					'山中也有千年樹 世上難逢百歲人',
					'力微休負重 言輕莫勸人',
					'無錢休入眾 遭難莫尋親',
					'平生莫作皺眉事 世上應無切齒人',
					'士者國之寶 儒為席上珍',
					'若要斷酒法 醒眼看醉人',
					'求人須求大丈夫 濟人須濟急時無',
					'渴時一滴如甘露 醉後添杯不如無',
					'久住令人賤 頻來親也疏',
					'酒中不語真君子 財上分明大丈夫',
					'出家如初 成佛有餘',
					'積金千兩 不如明解經書',
					'養子不教如養驢 養女不教如養豬',
					'有田不耕倉廩虛 有書不讀子孫愚',
					'倉廩虛兮歲月乏 子孫愚兮禮義疏',
					'同君一席話 勝讀十年書',
					'人不通今古 馬牛如襟裾',
					'茫茫四海人無數 哪個男兒是丈夫',
					'白酒釀成緣好客 黃金散盡為收書',
					'救人一命 勝造七級浮屠',
					'城門失火 殃及池魚',
					'庭前生瑞草 好事不如無',
					'欲求生富貴 須下死工夫',
					'百年成之不足 一旦敗之有餘',
					'人心似鐵 官法如爐',
					'善化不足 惡化有餘',
					'水太清則無魚 人至察則無徒',
					'知者減半 省者全無',
					'在家由父 出家從夫',
					'癡人畏婦 賢女敬夫',
					'是非終日有 不聽自然無',
					'寧可正而不足 不可邪而有餘',
					'寧可信其有 不可信其無',
					'竹籬茅舍風光好 道院僧堂終不如',
					'命裡有時終須有 命里無時莫強求',
					'道院迎仙客 書堂隱相儒',
					'庭栽棲鳳竹 池養化龍魚',
					'結交須勝己 似我不如無',
					'但看三五日 相見不如初',
					'人情似水分高下 世事如雲任卷舒',
					'會說說都是 不會說無禮',
					'磨刀恨不利 刀利傷人指',
					'求財恨不得 財多害自己',
					'知足常足 終身不辱',
					'知止常止 終身不恥',
					'有福傷財 無福傷己',
					'差之毫厘 失之千里',
					'若登高必自卑 若涉遠必自邇',
					'三思而行 再思可矣',
					'使口不如自走 求人不如求己',
					'小時是兄弟 長大各鄉里',
					'妒財莫妒食 怨生莫怨死',
					'人見白頭嗔 我見白頭喜',
					'多少少年亡 不到白頭死',
					'墻有逢 壁有耳',
					'好事不出門 惡事傳千里',
					'賊是小人 知過君子',
					'君子固窮 小人窮斯濫也',
					'貧窮自在 富貴多憂',
					'不以我為德 反以我為仇',
					'寧向直中取 不可曲中求',
					'人無遠慮 必有近憂',
					'知我者謂我心憂 不知我者謂我何求',
					'晴天不肯去 只待雨淋頭',
					'成事莫說 覆水難收',
					'是非只為多開口 煩惱皆因強出頭',
					'忍得一時之氣 免得百日之憂',
					'近來學得烏龜法 得縮頭時且縮頭',
					'懼法朝朝樂 欺公日日憂',
					'人生一世 草生一春',
					'黑發不知勤學早 看看又是白頭翁',
					'月到十五光明少 人到中年萬事休',
					'兒孫自有兒孫福 莫為兒孫作馬牛',
					'人生不滿百 常懷千歲憂',
					'今朝有酒今朝醉 明日愁來明日憂',
					'路逢險處難回避 事到頭來不自由',
					'藥能醫假病 酒不解真愁',
					'人貧不語 水平不流',
					'一家有女百家求 一馬不行百馬憂',
					'有花方酌酒 無月不登樓',
					'三杯通大道 一醉解千愁',
					'深山畢竟藏猛虎 大海終須納細流',
					'惜花須檢點 愛月不梳頭',
					'大抵選他肌骨好 不擦紅粉也風流',
					'受恩深處宜先退 得意濃時便可休',
					'莫待是非來入耳 從前恩愛反為仇',
					'留得五湖明月在 不愁無處下金鉤',
					'休別有魚處 莫戀淺灘頭',
					'去時終須去 再三留不住',
					'忍一句 息一怒 饒一著 退一步',
					'三十不豪 四十不富 五十將來尋死路',
					'生不論魂 死不認尸',
					'父母恩深終有別 夫妻義重也分離',
					'人生似鳥同林宿 大限來時各自飛',
					'人善被人欺 馬善被人騎',
					'人無橫財不富 馬無野草不肥',
					'人惡人怕天不怕 人善人欺天不欺',
					'善惡到頭終有報 只爭來早與來遲',
					'黃河尚有澄清日 豈可人無得運時',
					'得寵思辱 安居慮危',
					'念念有如臨敵日 心心常似過橋時',
					'英雄行險道 富貴似花枝',
					'人情莫道春光好 只怕秋來有冷時',
					'送君千里 終須一別',
					'但將冷眼看螃蟹 看你橫行到幾時',
					'見事莫說 問事不知',
					'閑事休管 無事早歸',
					'假緞染就真紅色 也被旁人說是非',
					'善事可作 惡事莫為',
					'許人一物 千金不移',
					'龍生龍子 虎生豹兒',
					'龍游淺水遭蝦戲 虎落平陽被犬欺',
					'一舉首登龍虎榜 十年身到鳳凰池',
					'十年窗下無人問 一舉成名天下知',
					'酒債尋常行處有 人生七十古來稀',
					'養兒待老 積穀防饑',
					'雞豚狗彘之畜 無失其時',
					'數家之口 可以無饑矣',
					'常將有日思無日 莫把無時當有時',
					'時來風送騰王閣 運去雷轟薦福碑',
					'入門休問榮枯事 觀看容顏便得知',
					'官清書吏瘦 神靈廟祝肥',
					'息卻雷霆之怒 罷卻虎狼之威',
					'饒人算人之本 輸人算人之機',
					'好言難得 惡語易施',
					'一言既出 駟馬難追',
					'道吾好者是吾賊 道吾惡者是吾師',
					'路逢俠客須呈劍 不是才人莫獻詩',
					'三人同行 必有我師 擇其善者而從之 其不善者而改之',
					'少壯不努力 老大徒悲傷',
					'人有善願 天必佑之',
					'莫飲卯時酒 昏昏醉到酉',
					'莫罵酉時妻 一夜受孤淒',
					'種麻得麻 種豆得豆',
					'天眼恢恢 疏而不漏',
					'見官莫向前 做客莫在後',
					'寧添一斗 莫添一口',
					'螳螂捕蟬 豈知黃雀在後',
					'不求金玉重重貴 但願兒孫個個賢',
					'一日夫妻 百世姻緣',
					'百世修來同船渡 千世修來共枕眠',
					'殺人一萬 自損三千',
					'傷人一語 利如刀割',
					'枯木逢春猶再發 人無兩度再少年',
					'未晚先投宿 雞鳴早看天',
					'將相胸前堪走馬 公候肚裡好撐船',
					'富人思來年 窮人思眼前',
					'世上若要人情好 賒去物件莫取錢',
					'死生有命 富貴在天',
					'擊石原有火 不擊乃無煙',
					'為學始知道 不學亦徒然',
					'莫笑他人老 終須還到老',
					'但能依本分 終須無煩惱',
					'君子愛財 取之有道',
					'貞婦愛色 納之以禮',
					'善有善報 惡有惡報',
					'不是不報 日子不到',
					'人而無信 不知其可也',
					'一人道好 千人傳實',
					'凡事要好 須問三老',
					'若爭小可 便失大道',
					'年年防饑 夜夜防盜',
					'學者如禾如稻 不學者如蒿如草',
					'遇飲酒時須飲酒 得高歌處且高歌',
					'因風吹火 用力不多',
					'不因漁父引 怎得見波濤',
					'無求到處人情好 不飲從他酒價高',
					'知事少時煩惱少 識人多處是非多',
					'入山不怕傷人虎 只怕人情兩面刀',
					'強中更有強中手 惡人須用惡人磨',
					'會使不在家豪富 風流不用著衣多',
					'光陰似箭 日月如梭',
					'天時不如地利 地利不如人和',
					'黃金未為貴 安樂值錢多',
					'世上萬般皆下品 思量唯有讀書高',
					'世間好語書說盡 天下名山僧占多',
					'為善最樂 為惡難逃',
					'羊有跪乳之恩 鴉有反哺之義',
					'你急他未急 人閑心不閑',
					'隱惡揚善 執其兩端',
					'妻賢夫禍少 子孝父心寬',
					'既墜釜甑 反顧無益',
					'翻覆之水 收之實難',
					'人生知足何時足 人老偷閑且是閑',
					'但有綠楊堪系馬 處處有路透長安',
					'見者易 學者難',
					'莫將容易得 便作等閑看',
					'用心計較般般錯 退步思量事事難',
					'道路各別 養家一般',
					'從儉入奢易 從奢入儉難',
					'知音說與知音聽 不是知音莫與彈',
					'點石化為金 人心猶未足',
					'信了肚 賣了屋',
					'他人觀花 不涉你目',
					'他人碌碌 不涉你足',
					'誰人不愛子孫賢 誰人不愛千鐘粟',
					'莫把真心空計較 五行不是這題目',
					'與人不和 勸人養鵝',
					'與人不睦 勸人架屋',
					'但行好事 莫問前程',
					'河狹水急 人急計生',
					'明知山有虎 莫向虎山行',
					'路不行不到 事不為不成',
					'人不勸不善 鐘不打不鳴',
					'無錢方斷酒 臨老始看經',
					'點塔七層 不如暗處一燈',
					'萬事勸人休瞞昧 舉頭三尺有神明',
					'但存方寸土 留與子孫耕',
					'滅卻心頭火 剔起佛前燈',
					'惺惺常不足 懵懵作公卿',
					'眾星朗朗 不如孤月獨明',
					'兄弟相害 不如自生',
					'合理可作 小利莫爭',
					'牡丹花好空入目 棗花雖小結實成',
					'欺老莫欺小 欺人心不明',
					'隨分耕鋤收地利 他時飽滿謝蒼天',
					'得忍且忍 得耐且耐',
					'不忍不耐 小事成大',
					'相論逞英雄 家計漸漸退',
					'賢婦令夫貴 惡婦令夫敗',
					'一人有慶 兆民咸賴',
					'人老心未老 人窮志莫窮',
					'人無千日好 花無百日紅',
					'殺人可恕 情理難容',
					'乍富不知新受用 乍貧難改舊家風',
					'座上客常滿 樽中酒不空',
					'屋漏更遭連年雨 行船又遇打頭風',
					'筍因落籜方成竹 魚為奔波始化龍',
					'記得少年騎竹馬 看看又是白頭翁',
					'禮義生於富足 盜賊出於貧窮',
					'天上眾星皆拱北 世間無水不朝東',
					'君子安平 達人知命',
					'忠言逆耳利於行 良藥苦口利於病',
					'順天者存 逆天者亡',
					'人為財死 鳥為食亡',
					'夫妻相合好 琴瑟與笙簧',
					'有兒貧不久 無子富不長',
					'善必壽老 惡必早亡',
					'爽口食多偏作藥 快心事過恐生殃',
					'富貴定要安本分 貧窮不必枉思量',
					'畫水無風空作浪 繡花雖好不聞香',
					'貪他一斗米 失卻半年糧',
					'爭他一腳豚 反失一肘羊',
					'龍歸晚洞雲猶濕 麝過春山草木香',
					'平生只會量人短 何不回頭把自量',
					'見善如不及 見惡如探湯',
					'人貧志短 馬瘦毛長',
					'自家心裏急 他人未知忙',
					'貧無達士將金贈 病有高人說藥方',
					'觸來莫與說 事過心清涼',
					'秋至滿山多秀色 春來無處不花香',
					'凡人不可貌相 海水不可斗量',
					'清清之水 為土所防',
					'濟濟之士 為酒所傷',
					'蒿草之下 或有蘭香',
					'茅茨之屋 或有侯王',
					'無限朱門生餓殍 幾多白屋出卿相',
					'醉後乾坤大 壺中日月長',
					'萬事皆已定 浮生空白茫',
					'千里送毫毛 禮輕仁義重',
					'一人傳虛 百人傳實',
					'世事明如鏡 前程暗似漆',
					'光陰黃金難買 一世如駒過隙',
					'良田萬傾 日食一升',
					'大廈千間 夜眠八尺',
					'千經萬典 孝義為先',
					'一字入公門 九牛拖不出',
					'衙門八字開 有理無錢莫進來',
					'富從升合起 貧因不算來',
					'家中無才子 官從何處來',
					'萬事不由人計較 一生都是命安排',
					'急行慢行 前程只有多少路',
					'人間私語 天聞若雷',
					'暗室虧心 神目如電',
					'一毫之惡 勸人莫作',
					'一毫之善 與人方便',
					'欺人是禍 饒人是福',
					'天眼恢恢 報應甚速',
					'聖賢言語 神欽鬼伏',
					'人各有心 心各有見',
					'口說不如身逢 耳聞不如目見',
					'養軍千日 用在一朝',
					'國清才子貴 家富小兒驕',
					'利刀割體痕易合 惡語傷人恨不消',
					'公道世間唯白發 貴人頭上不曾饒',
					'有錢堪出眾 無衣懶出門',
					'為官須作相 及第必爭先',
					'苗從地發 樹向枝分',
					'父子和而家不退 兄弟和而家不分',
					'官有正條 民有和約',
					'閑時不燒香 急時抱佛腳',
					'幸生太平無事日 恐逢年老不多時',
					'國亂思良將 家貧思賢妻',
					'池塘積水須防旱 田地勤耕足養家',
					'根深不怕風搖動 樹正無愁月影斜',
					'奉勸君子 各宜守己',
					'只此程式 萬無一失',
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
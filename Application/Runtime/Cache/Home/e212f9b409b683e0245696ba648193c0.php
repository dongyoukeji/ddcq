<?php if (!defined('THINK_PATH')) exit();?><ul>
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
			<span>[<?php echo ($vo["date"]); ?>]</span>
			【公告】
			<a href="<?php echo U('index/notice?id='.$vo['id']);?>" class="author"><?php echo ($vo["title"]); ?></a>
		</li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
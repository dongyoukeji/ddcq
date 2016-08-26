<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <title>嘟嘟传奇</title>
    <meta name="Description" content="《嘟嘟传奇》游戏延续了传奇经典玩法，攻城、PK,还原经典！全新精细画质,复古热血传奇的玩法,全新战场,公平竞争,现热血辉煌启幕，诚邀您来战。">
    <meta name="Keywords" content="嘟嘟传奇 嘟嘟传奇官网 嘟嘟 传奇 高清传奇">
    <link rel="stylesheet" type="text/css" href="/duduchuanqi/Public/Home/css/base.css">
    <link rel="stylesheet" type="text/css" href="/duduchuanqi/Public/Home/css/style.css">
    <script type="text/javascript" src="/duduchuanqi/Public/Home/js/jquery.min-1.7.1.js"></script>
    <script type="text/javascript" src="/duduchuanqi/Public/Home/js/kxbdMarquee.js"></script>
</head>
<body>
    <div class="weball">
        <div class="header">
            <img src="/duduchuanqi/Public/Home/images/logo.fw.png" class="logo" />
            <img src="/duduchuanqi/Public/Home/images/font.fw.png" class="font" />
            <img src="/duduchuanqi/Public/Home/images/person.fw.png" class="person" />
            <ul class="nav">
                <li class="active"><a href="<?php echo U('index');?>">官方首页</a></li>
                <li><a href="#">新闻中心</a></li>
                <li><a href="#">游戏介绍</a></li>
                <li><a href="#">用户中心</a></li>
                <li><a href="#">账号注册</a></li>
                <li><a href="#">充值</a></li>
            </ul>
        </div>
		<div class="main">
			<div class="main_left" style="width: 780px; padding: 25px">
				<div class="title">
					<h1><?php echo ($vo["title"]); ?></h1>
					<span><?php echo (date("y-m-d",$vo["date"])); ?></span>
				</div>
				<div class="notice_info">
					<?php echo ($vo["content"]); ?>
				</div>
			</div>
			<div class="main_right" style="width: 345px;">
				<div class="info_right" style="width:315px;">
					<div class="right_title">
						<b>DUDU公告</b>
						<a href="<?php echo U('notice_list');?>">MORE</a>
					</div>
					<style type="text/css">
						.right_content ul li a{
							width: 50%;
						}
					</style>
					<div class="right_content right_content1">
						
					</div>
				</div>
				<div class="cross_indro">
					<div class="cross_list" style="margin-left:30px;">
						<h2 class="cross1">新手入门</h2>
						<a href="#">师徒系统</a>
						<a href="#">聊天系统</a>
						<a href="#" style="border:none;">交易系统</a>
						<a href="#">包裹系统</a>
						<a href="#">助手系统</a>
						<a href="#" style="border:none;">摆摊系统</a>
					</div>
					<div class="cross_list" style="margin-left:30px;">
						<h2 class="cross2">高手进阶</h2>
						<a href="#">战士技能</a>
						<a href="#">法师技能</a>
						<a href="#" style="border:none;">道士技能</a>
						<a href="#">结婚系统</a>
						<a href="#">行会系统</a>
						<a href="#" style="border:none;">称号系统</a>
					</div>
					<div class="cross_list" style="margin-left:30px;">
						<h2 class="cross3">特色玩法</h2>
						<a href="#">世界怪物</a>
						<a href="#">元宝捐赠</a>
						<a href="#" style="border:none;">领地系统</a>
						<a href="#">沙巴克攻</a>
						<a href="#">虚空幻境</a>
						<a href="#" style="border:none;">幸运农场</a>
					</div>
					<div class="cross_list" style="margin: 0 0 0 30px;">
						<h2 class="cross4">道具装备</h2>
						<a href="#">普通道具</a>
						<a href="#">普通材料</a>
						<a href="#" style="border:none;">套装系统</a>
						<a href="#">赤月系列</a>
						<a href="#">祖玛系列</a>
						<a href="#" style="border:none;">沃玛系列</a>
					</div>
				</div>
			</div>
<div class="game_img">
                <b>
                    <img src="/duduchuanqi/Public/Home/images/game1.jpg">
                    比奇皇宫
                </b>
                <b>
                    <img src="/duduchuanqi/Public/Home/images/game2.jpg">
                    苍月码头
                </b>
                <b>
                    <img src="/duduchuanqi/Public/Home/images/game3.jpg">
                    白日门
                </b>
                <b style="margin-right:0;">
                    <img src="/duduchuanqi/Public/Home/images/game4.jpg">
                    封魔城门
                </b>
            </div>
        </div>
        <div class="footer">
            <p>抵制不良游戏 拒绝盗版游戏 注意自我保护 谨防受骗上当 适度游戏益脑 沉迷游戏伤身 合理安排时间 享受健康生活</p>
            <p>经营许可证：苏ICP备16011318号-1 <span>苏州东游网络科技有限公司</span></p>
        </div>
        <div class="clear"></div>
    </div>
</body>

<script type="text/javascript">
$(function () {
        num = $("#PicCont .Pic").size();
        i = 0;
        for (i = 0; i < num; i++) {
            $("#PicNum").append("<div class='Text'></div>");
        }
        theInt = null;
        $("#PicCont .Pic").eq(0).fadeIn(1000);
        $("#PicNum .Text").eq(0).addClass("cur");
        $("#PicNum .Text").each(function (i) {
            $(this).click(function () {
                HuanDeng(i);
                $("#PicCont .Pic").fadeOut(1000);
                $("#PicCont .Pic").eq(i).fadeIn(1000);
                $("#PicNum .Text").removeClass("cur");
                $(this).addClass("cur");
            });
        });
        HuanDeng = function (p) {
            clearInterval(theInt);
            theInt = setInterval(function () {
                p++;
                if (p < num) {
                    $("#PicCont .Pic").fadeOut(1000);
                    $("#PicCont .Pic").eq(p).fadeIn(1000);
                    $("#PicNum .Text").removeClass("cur");
                    $("#PicNum .Text").eq(p).addClass("cur");
                } else {
                    p = 0
                    $("#PicCont .Pic").fadeOut(1000);
                    $("#PicCont .Pic").eq(p).fadeIn(1000);
                    $("#PicNum .Text").removeClass("cur");
                    $("#PicNum .Text").eq(0).addClass("cur");
                }
            }, 4000);
        }
        HuanDeng(0);
    });

    $(function(){
        $.post('/duduchuanqi/Home/Index/get_article_list',{s:8},function(data){
            console.log(data);
            if(data.status==1){
                $('.right_content1').html(data.list);
            }

        });

        $('.user_pj').kxbdMarquee({
            direction: 'up',
            isEqual: false
        });

        $('.right_title').find('em').mouseover(function(){
            var index = $(this).index();
            $('div.pro_job').eq(--index).show().siblings('div.pro_job').hide();
        });
    });

</script>
</html>
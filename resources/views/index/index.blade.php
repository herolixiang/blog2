<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title>Hello MUI</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">

		<!--标准mui.css-->
		<link rel="stylesheet" href="/index/css/mui.min.css">
		<!--App自定义的css-->
		<link rel="stylesheet" type="text/css" href="/index/css/app.css"/>
		<link rel="stylesheet" type="text/css" href="/index/css/icons-extra.css">
		<!--自定义iconfont-->
		<link rel="stylesheet" type="text/css" href="/index/css/iconfont.css">
	</head>

	<body style="background: #fff;">
		<header class="mui-bar mui-bar-nav seach-header">
			<div class="top-sch-box flex-col">
				<a href="examples/search.html">
		            <div class="centerflex">
		                <i class="fdj  icon  iconfont icon-sousuo1"></i>
		                <div class="sch-txt">连衣裙就是你的女人味儿</div>
		                <span class="shaomiao"><i class="iconfont icon-saoma"></i></span>
		            </div>
		        </a>
	        </div>
	        <a class="btn" href="examples/new-newsCenter.html">
	            <span class="icon iconfont icon-xiaoxi"></span>
	        </a>
	        <a class="btn" href="examples/new-shopping-card.html">
	            <span class="icon iconfont icon-gouwuche1"></span>
	        </a>
		</header>
		<div class="nav-bottom">
			<!--图片轮播-->
			<div id="slider" class="mui-slider" >
				<div class="mui-slider-group mui-slider-loop">
					<!-- 额外增加的一个节点(循环轮播：第一个节点是最后一张轮播) -->
					<div class="mui-slider-item mui-slider-item-duplicate"><a href="#"><img src="/index/images/banner1.jpg"></a></div>
					<div class="mui-slider-item"><a href="#"><img src="/index/images/banner1.jpg"></a></div>
					<div class="mui-slider-item"><a href="#"><img src="/index/images/banner2.jpg"></a></div>
					<div class="mui-slider-item"><a href="#"><img src="/index/images/banner1.jpg"></a></div>
					<div class="mui-slider-item"><a href="#"><img src="/index/images/banner2.jpg"></a></div>
					<div class="mui-slider-item mui-slider-item-duplicate"><a href="#"><img src="/index/images/banner1.jpg"></a></div>
				</div>
				<div class="mui-slider-indicator">
					<div class="mui-indicator mui-active"></div>
					<div class="mui-indicator"></div>
					<div class="mui-indicator"></div>
					<div class="mui-indicator"></div>
				</div>
			</div>
			<!--商品分类-->
			<div class="mui-content new-pattern-con">
		        <ul class="mui-table-view mui-grid-view mui-grid-12 pattern-con-icon">
		            <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3"><a href="examples/new-commodity.html">
		                    <span class="mui-icon iconfont icon-remenshangpin"></span>
		                    <div class="mui-media-body">热门商品</div></a></li>
		            <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3"><a href="examples/new-commodity.html">
		                    <span class="mui-icon-extra mui-icon-extra-new"></span>
		                    <div class="mui-media-body">新款推荐</div></a></li>
		            <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3"><a href="examples/new-commodity.html">
		                    <span class="icon iconfont icon-yushou-huang"></span>
		                    <div class="mui-media-body">预售款</div></a></li>
		            <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3"><a href="examples/new-commodity.html">
		                    <span class="icon iconfont icon-fendi_shuangjianbao"></span>
		                    <div class="mui-media-body">双肩包</div></a></li>
		            <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3"><a href="examples/new-commodity.html">
		                    <span class="icon iconfont icon-dabaozhuang"></span>
		                    <div class="mui-media-body">大包&小包</div></a></li>
		            <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3"><a href="examples/new-commodity.html">
		                    <span class="icon iconfont icon-qianbao"></span>
		                    <div class="mui-media-body">钱包&手拿包</div></a></li>
		            <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3"><a href="examples/new-commodity.html">
		                    <span class="icon iconfont icon-prada_danjianbao"></span>
		                    <div class="mui-media-body">单肩包&斜跨</div></a></li>
		            <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3"><a href="examples/new-commodity.html">
		                    <span class="icon iconfont icon-gucci_shoutibao"></span>
		                    <div class="mui-media-body">手提包</div></a></li>
		        </ul> 
			</div>
			<!--新款发售-->
			<div class="new-pattern">
				<img class="w100" class="home-imgtit" src="/index/images/hometit1.jpg" alt="" />
				<ul class="pattern-list">
					<li class="mui-card-footer">
						<div class="mui-card">
							<a href="examples/new-personal-details.html">
								<div class="mui-card-header mui-card-media" style="height:40vw;"><img class="w100" src="/index/images/list-ph01.png" /></div>
								<div class="mui-card-content">
									<div class="mui-card-content-inner">
										<p style="color: #333;">韩版青少年休闲修身长袖紧身衬衫</p>
									</div>
								</div>
								<div class="pattern-list__p">
									<p class="font-color-pink">￥<label>168</label></p>
									<p>库存<label>538</label></p>
								</div>
							</a>
						</div>
						<div class="mui-card">
							<a href="examples/new-personal-details.html">
								<div class="mui-card-header mui-card-media" style="height:40vw;"><img class="w100" src="/index/images/list-ph01.png" /></div>
								<div class="mui-card-content">
									<div class="mui-card-content-inner">
										
										<p style="color: #333;">韩版青少年休闲修身长袖紧身衬衫</p>
									</div>
								</div>
								<div class="pattern-list__p">
									<p class="font-color-pink">￥<label>168</label></p>
									<p>库存:<label>538</label></p>
								</div>
							</a>
						</div>
					</li>
					<li class="mui-card-footer">
						<div class="mui-card">
							<a href="examples/new-personal-details.html">
								<div class="mui-card-header mui-card-media" style="height:40vw;"><img class="w100" src="/index/images/list-ph01.png" /></div>
								<div class="mui-card-content">
									<div class="mui-card-content-inner">
										
										<p style="color: #333;">韩版青少年休闲修身长袖紧身衬衫</p>
									</div>
								</div>
								<div class="pattern-list__p">
									<p class="font-color-pink">￥<label>168</label></p>
									<p>库存:<label>538</label></p>
								</div>
							</a>
						</div>
						<div class="mui-card">
							<a href="examples/new-personal-details.html">
								<div class="mui-card-header mui-card-media" style="height:40vw;"><img class="w100" src="/index/images/list-ph01.png" /></div>
								<div class="mui-card-content">
									<div class="mui-card-content-inner">
										
										<p style="color: #333;">韩版青少年休闲修身长袖紧身衬衫</p>
									</div>
								</div>
								<div class="pattern-list__p">
									<p class="font-color-pink">￥<label>168</label></p>
									<p>库存:<label>538</label></p>
								</div>
							</a>
						</div>
					</li>
				</ul>
			</div>
		</div>
		
		<div class="nav-footer">
			<a class="icon-active" href="">
				<span class="mui-icon mui-icon-home"></span>
				<span class="mui-tab-label">首页</span>
			</a>
			<a href="examples/new-classification.html">
				<span class="mui-icon mui-icon-list"></span>
				<span class="mui-tab-label">分类</span>
			</a>
			<a href="examples/new-shopping-card.html">
				<span class="mui-icon mui-icon-extra mui-icon-extra-cart"></span>
				<span class="mui-tab-label">购物车</span>
			</a>
			<a href="examples/new-mine.html">
				<span class="mui-icon mui-icon-contact"></span>
				<span class="mui-tab-label">个人中心</span>
			</a>
		</div>
		
		<script src="/index/js/mui.min.js"></script>
		<script src="/index/js/jquery.min.js"></script>
		<script type="text/javascript" charset="utf-8">
			  mui.init({
                swipeBack:true 
            });
            var slider = mui("#slider");
                    slider.slider({
                        interval: 2000//自动轮播周期，若为0则不自动播放，默认为0；
                    });
		</script>
	</body>

</html>


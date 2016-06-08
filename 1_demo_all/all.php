<?php
require_once "../jssdk.php";
$jssdk = new JSSDK("APP_ID_HERE", "APP_SECRET_HERE");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>WeChat JS-SDK</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
	<link rel="stylesheet" href="css/jssdk-style.css">
</head>
<body ontouchstart>
	<div class="wxapi_container">

		<div class="wxapi_index_container">
			<ul class="label_box lbox_close wxapi_index_list">
				<li class="label_item wxapi_index_item"><a class="label_inner" href="#menu-basic">Basic API</a></li>
				<li class="label_item wxapi_index_item"><a class="label_inner" href="#menu-share">Sharing API</a></li>
				<li class="label_item wxapi_index_item"><a class="label_inner" href="#menu-image">Image API</a></li>
				<li class="label_item wxapi_index_item"><a class="label_inner" href="#menu-voice">Voice API</a></li>
				<li class="label_item wxapi_index_item"><a class="label_inner" href="#menu-smart">Intelligent API</a></li>
				<li class="label_item wxapi_index_item"><a class="label_inner" href="#menu-device">Equipment Information API</a></li>
				<li class="label_item wxapi_index_item"><a class="label_inner" href="#menu-location">Geographic Location APPI</a></li>
				<li class="label_item wxapi_index_item"><a class="label_inner" href="#menu-webview">Interface Controls API</a></li>
				<li class="label_item wxapi_index_item"><a class="label_inner" href="#menu-scan">Scan QR Code API</a></li>
				<li class="label_item wxapi_index_item"><a class="label_inner" href="#menu-card">WeChat Coupons API</a></li>
			</ul>
		</div>

		<div class="lbox_close wxapi_form">
			<h3 id="menu-basic">Basic</h3>
			<span class="desc">Check API compatibility</span>
			<button class="btn btn_primary" id="checkJsApi">checkJsApi</button>

			<h3 id="menu-share">Sharing</h3>
			<span class="desc">Share on Moments</span>
			<button class="btn btn_primary" id="onMenuShareTimeline">onMenuShareTimeline</button>
			<span class="desc">Send to Chat</span>
			<button class="btn btn_primary" id="onMenuShareAppMessage">onMenuShareAppMessage</button>

			<h3 id="menu-image">Images</h3>
			<span class="desc">Take photos or choose from mobile album</span>
			<button class="btn btn_primary" id="chooseImage">chooseImage</button>
			<span class="desc">Preview images</span>
			<button class="btn btn_primary" id="previewImage">previewImage</button>
			<span class="desc">Upload image</span>
			<button class="btn btn_primary" id="uploadImage">uploadImage</button>
			<span class="desc">Download image</span>
			<button class="btn btn_primary" id="downloadImage">downloadImage</button>

			<h3 id="menu-voice">Voice</h3>
			<span class="desc">Start Recording</span>
			<button class="btn btn_primary" id="startRecord">startRecord</button>
			<span class="desc">Stop Recording</span>
			<button class="btn btn_primary" id="stopRecord">stopRecord</button>
			<span class="desc">Play</span>
			<button class="btn btn_primary" id="playVoice">playVoice</button>
			<span class="desc">Pause</span>
			<button class="btn btn_primary" id="pauseVoice">pauseVoice</button>
			<span class="desc">Stop</span>
			<button class="btn btn_primary" id="stopVoice">stopVoice</button>
			<span class="desc">Upload Voice</span>
			<button class="btn btn_primary" id="uploadVoice">uploadVoice</button>
			<span class="desc">Download Voice</span>
			<button class="btn btn_primary" id="downloadVoice">downloadVoice</button>

			<h3 id="menu-smart">Intelligent</h3>
			<span class="desc">Translate Voice to Text</span>
			<button class="btn btn_primary" id="translateVoice">translateVoice</button>

			<h3 id="menu-device">Equipment Information</h3>
			<span class="desc">Get Network Type</span>
			<button class="btn btn_primary" id="getNetworkType">getNetworkType</button>

			<h3 id="menu-location">Geographic Location</h3>
			<span class="desc">View location with build-in map</span>
			<button class="btn btn_primary" id="openLocation">openLocation</button>
			<span class="desc">Get user's location</span>
			<button class="btn btn_primary" id="getLocation">getLocation</button>

			<h3 id="menu-webview">Interface Controls</h3>
			<span class="desc">Hide option menu</span>
			<button class="btn btn_primary" id="hideOptionMenu">hideOptionMenu</button>
			<span class="desc">Show option menu</span>
			<button class="btn btn_primary" id="showOptionMenu">showOptionMenu</button>
			<span class="desc">Close current window</span>
			<button class="btn btn_primary" id="closeWindow">closeWindow</button>
			<span class="desc">Hide menu items</span>
			<button class="btn btn_primary" id="hideMenuItems">hideMenuItems</button>
			<span class="desc">Show menu items</span>
			<button class="btn btn_primary" id="showMenuItems">showMenuItems</button>
			<span class="desc">Hide all non-base menu items</span>
			<button class="btn btn_primary" id="hideAllNonBaseMenuItem">hideAllNonBaseMenuItem</button>
			<span class="desc">Show all non-base menu items</span>
			<button class="btn btn_primary" id="showAllNonBaseMenuItem">showAllNonBaseMenuItem</button>

			<h3 id="menu-scan">Scan QR Code</h3>
			<span class="desc">Scanning result processed by WeChat</span>
			<button class="btn btn_primary" id="scanQRCode0">scanQRCode(0)</button>
			<span class="desc">Scanning result directly returned</span>
			<button class="btn btn_primary" id="scanQRCode1">scanQRCode(1)</button>


			<h3 id="menu-card">WeChat Coupons</h3>
			<span class="desc">Add coupons</span>
			<button class="btn btn_primary" id="addCard">addCard</button>
			<span class="desc">Choose coupon</span>
			<button class="btn btn_primary" id="chooseCard">chooseCard</button>
			<span class="desc">Open coupon</span>
			<button class="btn btn_primary" id="openCard">openCard</button>

		</div>
	</div>
</body>
<!-->@todo change url<-->
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
	 /*
	 * NOTE:
	 * 1. All APIs can only be called within the domain bound to your Official Accout. To bind a domain, log in to the WeChat Official Account Admin Platform, and choose "Account Info > Functions" to fill in "JS API Security Domain Name".
	 * 2. If there are issues while using the sharing API in Android, please download the lateast WeChat Android client at officail website. The sharing API is available in Android v6.0.2.58 and above.
	 * 3. Full documentation and common errors and solutions can be refered at @todo
	 *
	 * If you have any questions while using the JS SDK, please consulContent: t appendix 5 in the documentation. You can also post feedbacks via email if the documentation is not helping:
	 * Email address: @todo
	 * Subject: [WeChat JS SDK Feedback] problem description
	 * Content: Discript the problem with context, can also attach the relevant screenshot. We will feed back to you as soon as possible.
	 */

	//injection authentication
	wx.config({
		debug: true,
		appId: '<?php echo $signPackage["appId"];?>',
		timestamp: <?php echo $signPackage["timestamp"];?>,
		nonceStr: '<?php echo $signPackage["nonceStr"];?>',
		signature: '<?php echo $signPackage["signature"];?>',
		// list all APIs you are going to call in jsApiList
		jsApiList: [
				'checkJsApi',
				'onMenuShareTimeline',
				'onMenuShareAppMessage',
				'hideMenuItems',
				'showMenuItems',
				'hideAllNonBaseMenuItem',
				'showAllNonBaseMenuItem',
				'translateVoice',
				'startRecord',
				'stopRecord',
				'onRecordEnd',
				'playVoice',
				'pauseVoice',
				'stopVoice',
				'uploadVoice',
				'downloadVoice',
				'chooseImage',
				'previewImage',
				'uploadImage',
				'downloadImage',
				'getNetworkType',
				'openLocation',
				'getLocation',
				'hideOptionMenu',
				'showOptionMenu',
				'closeWindow',
				'scanQRCode',
				'addCard',
				'chooseCard',
				'openCard'
			]
	});
</script>
<script src="demo.js"></script>
</html>

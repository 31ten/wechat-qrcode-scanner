// call APIs in wx.ready after a successful authentication
wx.ready(function () {
	//Basic API
	//Determining Whether the Current Client Version Supports the Provided JS
	document.querySelector('#checkJsApi').onclick = function () {
		wx.checkJsApi({
			jsApiList: [
				'getNetworkType',
				'previewImage'
			],
			success: function (res) {
				alert(JSON.stringify(res));
			}
		});
	};

	//Sharing API
	document.querySelector('#onMenuShareAppMessage').onclick = function () {
		wx.onMenuShareAppMessage({
			title: 'Share Title',
			desc: 'Share Description',
			link: 'http://movie.douban.com/subject/25785114/',
			imgUrl: 'http://img3.douban.com/view/movie_poster_cover/spst/public/p2166127561.jpg',
			trigger: function (res) {
				alert('"Send to Chat" is clicked');
			},
			success: function (res) {
				alert('Sharing succeeds');
			},
			cancel: function (res) {
				alert('Sharing Canceled');
			},
			fail: function (res) {
				alert(JSON.stringify(res));
			}
		});
		alert('Listen "Send to Chat" Event');
	};

	document.querySelector('#onMenuShareTimeline').onclick = function () {
		wx.onMenuShareTimeline({
			title: 'Share Title',
			link: 'http://movie.douban.com/subject/25785114/',
			imgUrl: 'http://img3.douban.com/view/movie_poster_cover/spst/public/p2166127561.jpg',
			trigger: function (res) {
				alert('"Share on Moments" is clicked');
			},
			success: function (res) {
				alert('Sharing succeeds');
			},
			cancel: function (res) {
				alert('Sharing Canceled');
			},
			fail: function (res) {
				alert(JSON.stringify(res));
			}
		});
		alert('Listen "Share on Moments" Event');
	};

	//Intelligent API
	// Voice dictation: translate voice to text(only Mandarin Chinese supported currently)
	var voice = {
		localId: '',
		serverId: ''
	};

	document.querySelector('#translateVoice').onclick = function () {
		if (voice.localId == '') {
			alert('Please use "startRecord" to record a piece of voice first');
			return;
		}
		wx.translateVoice({
			localId: voice.localId,
			complete: function (res) {
				if (res.hasOwnProperty('translateResult')) {
					alert('Translate Result：' + res.translateResult);
				} else {
					alert('Translating failed');
				}
			}
		});
	};

	//Voice API
	document.querySelector('#startRecord').onclick = function () {
		wx.startRecord({
			cancel: function () {
				alert('Record permission denied');
			}
		});
	};

	document.querySelector('#stopRecord').onclick = function () {
		wx.stopRecord({
			success: function (res) {
				voice.localId = res.localId;
			},
			fail: function (res) {
				alert(JSON.stringify(res));
			}
		});
	};

	wx.onVoiceRecordEnd({
		complete: function (res) {
			voice.localId = res.localId;
			alert('Recording Stopped. Reocrding can last for 60 seconds at most.');
		}
	});

	document.querySelector('#playVoice').onclick = function () {
		if (voice.localId == '') {
			alert('Please use "startRecord" to record a piece of voice first');
			return;
		}
		wx.playVoice({
			localId: voice.localId
		});
	};

	document.querySelector('#pauseVoice').onclick = function () {
		wx.pauseVoice({
			localId: voice.localId
		});
	};

	document.querySelector('#stopVoice').onclick = function () {
		wx.stopVoice({
			localId: voice.localId
		});
	};

	wx.onVoicePlayEnd({
		complete: function (res) {
			alert('Finish playing voice record(' + res.localId + ').');
		}
	});

	document.querySelector('#uploadVoice').onclick = function () {
		if (voice.localId == '') {
			alert('Please use "startRecord" to record a piece of voice first');
			return;
		}
		wx.uploadVoice({
			localId: voice.localId,
			success: function (res) {
				alert('Uploading succeeds and serverId is' + res.serverId);
				voice.serverId = res.serverId;
			}
		});
	};

	document.querySelector('#downloadVoice').onclick = function () {
		if (voice.serverId == '') {
			alert('Please use "uploadVoice" to upload voice first');
			return;
		}
		wx.downloadVoice({
			serverId: voice.serverId,
			success: function (res) {
				alert('Downloading succeeds, localId is' + res.localId);
				voice.localId = res.localId;
			}
		});
	};

	//Image API
	var images = {
		localId: [],
		serverId: []
	};
	document.querySelector('#chooseImage').onclick = function () {
		wx.chooseImage({
			success: function (res) {
				images.localId = res.localIds;
				alert(res.localIds.length + 'images chose');
			}
		});
	};

	document.querySelector('#previewImage').onclick = function () {
		wx.previewImage({
			current: 'http://img5.douban.com/view/photo/photo/public/p1353993776.jpg',
			urls: [
				'http://img3.douban.com/view/photo/photo/public/p2152117150.jpg',
				'http://img5.douban.com/view/photo/photo/public/p1353993776.jpg',
				'http://img3.douban.com/view/photo/photo/public/p2152134700.jpg'
			]
		});
	};

	document.querySelector('#uploadImage').onclick = function () {
		if (images.localId.length == 0) {
			alert('Please use "chooseImage" to choose an image first');
			return;
		}
		var i = 0, length = images.localId.length;
		images.serverId = [];
		function upload() {
			wx.uploadImage({
				localId: images.localId[i],
				success: function (res) {
					i++;
					alert('Uploaded：' + i + '/' + length);
					images.serverId.push(res.serverId);
					if (i < length) {
						upload();
					}
				},
				fail: function (res) {
					alert(JSON.stringify(res));
				}
			});
		}
		upload();
	};

	document.querySelector('#downloadImage').onclick = function () {
		if (images.serverId.length === 0) {
			alert('Please use "uploadImage" to upload an image first');
			return;
		}
		var i = 0, length = images.serverId.length;
		images.localId = [];
		function download() {
			wx.downloadImage({
				serverId: images.serverId[i],
				success: function (res) {
					i++;
					alert('Downloaded：' + i + '/' + length);
					images.localId.push(res.localId);
					if (i < length) {
						download();
					}
				}
			});
		}
		download();
	};

	//Equipment Information API
	document.querySelector('#getNetworkType').onclick = function () {
		wx.getNetworkType({
			success: function (res) {
				alert(res.networkType);
			},
			fail: function (res) {
				alert(JSON.stringify(res));
			}
		});
	};

	//Geographic Location API
	document.querySelector('#openLocation').onclick = function () {
		wx.openLocation({
			latitude: 23.099994,
			longitude: 113.324520,
			name: 'TIT 创意园',
			address: '广州市海珠区新港中路 397 号',
			scale: 14,
			infoUrl: 'http://weixin.qq.com'
		});
	};

	document.querySelector('#getLocation').onclick = function () {
		wx.getLocation({
			success: function (res) {
				alert(JSON.stringify(res));
			},
			cancel: function (res) {
				alert('LBS permission denied.');
			}
		});
	};

	//Interface Controls API
	document.querySelector('#hideOptionMenu').onclick = function () {
		wx.hideOptionMenu();
	};

	document.querySelector('#showOptionMenu').onclick = function () {
		wx.showOptionMenu();
	};

	document.querySelector('#hideMenuItems').onclick = function () {
		wx.hideMenuItems({
			menuList: [
				'menuItem:readMode',
				'menuItem:share:timeline',
				'menuItem:copyUrl'
			],
			success: function (res) {
				alert('Menu items hidden.');
			},
			fail: function (res) {
				alert(JSON.stringify(res));
			}
		});
	};

	document.querySelector('#showMenuItems').onclick = function () {
		wx.showMenuItems({
			menuList: [
				'menuItem:readMode',
				'menuItem:share:timeline',
				'menuItem:copyUrl'
			],
			success: function (res) {
				alert('Menu items shown.');
			},
			fail: function (res) {
				alert(JSON.stringify(res));
			}
		});
	};

	document.querySelector('#hideAllNonBaseMenuItem').onclick = function () {
		wx.hideAllNonBaseMenuItem({
			success: function () {
				alert('All menu items hidden');
			}
		});
	};

	document.querySelector('#showAllNonBaseMenuItem').onclick = function () {
		wx.showAllNonBaseMenuItem({
			success: function () {
				alert('All menu items shown.');
			}
		});
	};

	document.querySelector('#closeWindow').onclick = function () {
		wx.closeWindow();
	};

	//Scan QR Code API
	// scanning result processed by wechat
	document.querySelector('#scanQRCode0').onclick = function () {
		wx.scanQRCode({
			desc: 'scanQRCode desc'
		});
	};
	// scanning result directly returned
	document.querySelector('#scanQRCode1').onclick = function () {
		wx.scanQRCode({
			needResult: 1,
			desc: 'scanQRCode desc',
			success: function (res) {
				alert(JSON.stringify(res));
			}
		});
	};

	//WeChat Coupons API
	document.querySelector('#addCard').onclick = function () {
		wx.addCard({
			cardList: [
				{
					cardId: 'pDF3iY9tv9zCGCj4jTXFOo1DxHdo',
					cardExt: '{"code": "", "openid": "", "timestamp": "1418301401", "signature":"64e6a7cc85c6e84b726f2d1cbef1b36e9b0f9750"}'
				},
				{
					cardId: 'pDF3iY9tv9zCGCj4jTXFOo1DxHdo',
					cardExt: '{"code": "", "openid": "", "timestamp": "1418301401", "signature":"64e6a7cc85c6e84b726f2d1cbef1b36e9b0f9750"}'
				}
			],
			success: function (res) {
				alert('Coupons added：' + JSON.stringify(res.cardList));
			}
		});
	};

	document.querySelector('#chooseCard').onclick = function () {
		wx.chooseCard({
			cardSign: '97e9c5e58aab3bdf6fd6150e599d7e5806e5cb91',
			timestamp: 1417504553,
			nonceStr: 'k0hGdSXKZEj3Min5',
			success: function (res) {
				alert('Coupons chosed：' + JSON.stringify(res.cardList));
			}
		});
	};

	document.querySelector('#openCard').onclick = function () {
		alert("Cannot open coupon. You don't have any coupons of this Officail Account");
		wx.openCard({
			cardList: [
			]
		});
	};

	var shareData = {
		title: 'WeChat JS-SDK Demo',
		desc: 'WeChat JS-SDK, help to develop powerful web application',
		link: 'http://demo.open.weixin.qq.com/jssdk/',
		imgUrl: 'http://mmbiz.qpic.cn/mmbiz/icTdbqWNOwNRt8Qia4lv7k3M9J1SKqKCImxJCt7j9rHYicKDI45jRPBxdzdyREWnk0ia0N5TMnMfth7SdxtzMvVgXg/0'
	};
	wx.onMenuShareAppMessage(shareData);
	wx.onMenuShareTimeline(shareData);
});

// process a failed authentication
wx.error(function (res) {
	alert(res.errMsg);
});

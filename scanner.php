<?php
require_once "jssdk.php";
$jssdk = new JSSDK("", "");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Wechat Scanner App</title>
	  <!-- Compiled and minified CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!-- Compiled and minified JavaScript -->
      
	</head>
	<style>
    	.container {
	        margin-bottom: 70px;
    	}
    	.wrapper nav .brand-logo {
    	    font-size: 17px;
    	}
	    .scan-button {    
            position: fixed;
            bottom: 0px;
            height: 50px;
            width: 100%;
            line-height: 50px;
        }
        .card-panel {
            overflow:hidden;
        }
	</style>
	<body>
	
	<div class="wrapper">
    	 <nav>
            <div class="nav-wrapper">
              <a href="#" class="brand-logo">31TEN Wechat Scanner</a>
            </div>
          </nav>
          
    	<a class="scan-button waves-effect waves-light btn" id="scanQRCode1"><i class="material-icons left">aspect_ratio</i>Scan QRcode</a>
    	
        <div class="container">
        	<div id="result" class="container">
            	
        	</div>
    	</div>
	</div>
		
		<!-- jQuery -->
	<script src="https://code.jquery.com/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
		<!-- Bootstrap JavaScript -->
		<!--<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>-->
		
	<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script>

	//injection authentication
	wx.config({
		debug: false,
		appId: '<?php echo $signPackage["appId"];?>',
		timestamp: <?php echo $signPackage["timestamp"];?>,
		nonceStr: '<?php echo $signPackage["nonceStr"];?>',
		signature: '<?php echo $signPackage["signature"];?>',
		// list all APIs you are going to call in jsApiList
		jsApiList: [
				'scanQRCode'
			]
    	});
    </script>
    <script>
        
        function generateBox(string){
            var html =  '<div class="col s12 m5">\
                            <div class="card-panel">\
                              <span class="blue-text text-darken-2">\
                                '+string+'\
                              </span>\
                            </div>\
                        </div>';
            $("#result").append(html);
        }
       
        
        
        $(document).ready(function(){
            generateBox("Click on the button scan to get QRcode information");
           
        });
        
        wx.ready(function () {
           // scanning result directly returned
        	document.querySelector('#scanQRCode1').onclick = function () {
        		wx.scanQRCode({
        			needResult: 1,
        			desc: 'scanQRCode desc',
        			success: function (res) {
        			    answer = res.resultStr;
        			    result = "";
        			    if( answer.startsWith("http://") || 
        			        answer.startsWith("https://")){
        			            if( answer.endsWith(".gif") || 
                			        answer.endsWith(".jpeg") || 
                			        answer.endsWith(".jpg") || 
                			        answer.endsWith(".png"))
            			        {
                			        result = "<img width='100%' src='"+answer+"' />";
                			    }else{
                			        result = answer+"&nbsp;&nbsp;<a class='waves-effect waves-light btn' href='"+answer+"' > <i class='material-icons'>language</i></a> ";
                			    }
    			        }else{
    			            result = answer;
    			        }
        			    generateBox(result);
        			}
        		});
        	}; 
        });
        
        // process a failed authentication
        wx.error(function (res) {
        	alert(res.errMsg);
        });

    </script>
	</body>
</html>

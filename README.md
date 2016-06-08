### An HTML5 Page with the QRcode functionality using Wechat JS SDK

* This code has been simplified of any libraries and framework for a better clarity. It is part of the following tutorial.
* The purpose of this code is for demonstration only! Be aware that :
  * The token and ticket are now stored in JSON accessible by everybody now if you don't make sure securing it properly.
  * The scanner.php file is mixing css and js for simplicity reasons. Those should be separated on production.

* For more information about WeChat's JS SDK please refer to their documentation page that can be found here http://admin.wechat.com/wiki/index.php?title=JS_SDK_DOCUMENT

#### Files description

        www
        |-- 1_demo_all            => Folder with the official JS SDK demo of all the functionalities
        |    |-- all.php           
        |    |-- demo.js      
        +-- 2_qrcode_app          => Folder with the qrcode app scanner example
              |-- scanner.php     => File with the qrcode app, please note the file includes JS, CSS that should be splitted in different files for production use
        |-- access_token.json     => Where the access token retrieved is stored
        |-- jsapi_ticket.json     => Where the access ticket retrieved is stored
        |-- jssdk.php             => The jssdk php class that handle all the authentification process and store the token/ticket inside the json files
        |-- README.md              

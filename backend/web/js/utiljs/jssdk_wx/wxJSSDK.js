var wxJSSDK ={//声明微信全局变量，防止污染外部环境
    version:"1.0",//版本号
    appName:"", //使用当前库的开发者,可以配置应用名字
    isReady:false,//微信jssdk是否初始化完毕
    access_token:"",//令牌
    ticket:"",//微信临时票据
    readySuccessCall:[],//微信初始化成功后的执行事务
    interface_server_host:js_root+"site/api/horsespread/",
    config:{
        debug: false, //开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
        appId: '', //必填，公众号的唯一标识
        timestamp: Math.ceil(new Date().getTime()/1000).toString(), //必填，生成签名的时间戳
        nonceStr: 'wgk_wxJSSDK', //必填，生成签名的随机串
        signature: '',//必填，签名，见附录1
        jsApiList: [//音频API配置列表
            "openLocation",
            "getLocation",
            "translateVoice"
        ] //必填，需要使用的JS接口列表，所有JS接口列表见附录2
    },
    /*
		函数功能：初始化
     */
    init:function(){
        if(!wx){//验证是否存在微信的js组件
            alert("微信接口调用失败，请检查是否引入微信js！");
            return;
        }
        var that = this;//保存当前作用域，方便回调函数使用
        //获取appid
        that.wx_get_appid(function(data){
            that.config.appId = data.data;

            //获取票据
            that.wx_get_ticket(function(data){
                that.ticket = data.data;

                //获取签名
                that.wx_get_signature(that);
            });
        });
    },
    //获取票据
    wx_get_ticket:function(call){
        $.get(this.interface_server_host + "get_hp_ticket",
            {},
            function(data) {
                call && call(data);
            },"json");
    },
    //获取appid
    wx_get_appid:function(call){
        $.get(this.interface_server_host + "get_hp_appid",
            {},
            function(data) {
                call && call(data);
            },"json");
    },
    //获取签名
    wx_get_signature:function(that){
        console.log("that.ticket " + that.ticket);
        if(that.ticket){
            var string = that.raw({
                jsapi_ticket: that.ticket,
                nonceStr: that.config.nonceStr,
                timestamp: that.config.timestamp,
                url: window.location.href
            });
            shaObj = new jsSHA(string, 'TEXT');
            that.config.signature = shaObj.getHash('SHA-1', 'HEX');

            //初始化微信接口
            that.initWx(function(){
                //初始化完成后的执行
            });
        }
    },
    raw : function(args) {
        var keys = Object.keys(args);
        keys = keys.sort()
        var newArgs = {};
        keys.forEach(function(key) {
            newArgs[key.toLowerCase()] = args[key];
        });
        var string = '';
        for (var k in newArgs) {
            string += '&' + k + '=' + newArgs[k];
        }
        string = string.substr(1);
        return string;
    },
    initWx:function(call, errorCall){
        var that = this;
        wx.config(this.config);//初始化配置
        /*config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后，
         *config是一个客户端的异步操作，所以如果需要在页面加载时就调用相关接口，
         *则须把相关接口放在ready函数中调用来确保正确执行。对于用户触发时才调用的接口，
         *则可以直接调用，不需要放在ready函数中。
         * */
        wx.ready(function(){
            that.isReady = true;
            console.log("初始化成功");
            
            wxJSSDK.location({
                getLocation:{
                    success:function (res) {
                         var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
                         var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
                         var speed = res.speed; // 速度，以米/每秒计
                         var accuracy = res.accuracy; // 位置精度
                         var options = {'user_latitute':latitude , 'user_longitude': longitude ,'openid': openid_dyh ,'actid':actid};
                         API.liebian.getWxMap(options,function(data){
                        	 alert('已经成功绑定，谢谢。');
                             console.log(data);
                             //var options = {'openid_kfq':openid , 'openid': openid_dyh ,'actid':actid};
                             //API.liebian.bindOpenid(options,function(data){
                              //   console.log(data);
                             //});
                         });
                        //getAddress(res.latitude,res.longitude);
                    },
                    cancel: function (res) {
                        alert("用户拒绝授权获取地理位置");
                    }
                }
            });
            
            if(that.readySuccessCall.length > 0) {//成功初始化后吗，执行的事务
                $.each(that.readySuccessCall, function(i, n){
                    n();
                });
            }

            call && call();
        });
        /*config信息验证失败会执行error函数，如签名过期导致验证失败，
         *具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，
         * 对于SPA可以在这里更新签名。
         * */
        wx.error(function(res){
            that.isReady = "false";
            errorCall && errorCall();
        });
    }
}
//执行初始化
wxJSSDK.init();

wxJSSDK.location = function(locationApi){
    if(wxJSSDK.isReady){//wxJSSDK.isReady 查看微信JSSDK是否初始化完毕
        if(locationApi){
            locationApi.getLocation && wx.getLocation({//获取地理位置接口
                success: function (res) {
                    locationApi.getLocation.success && locationApi.getLocation.success(res);
                },
                cancel:function (res) {
                    locationApi.getLocation.cancel && locationApi.getLocation.cancel(res);
                }
            });

            locationApi.openLocation && wx.openLocation({//使用微信内置地图查看位置接口
                latitude: locationApi.openLocation.latitude || 0, // 纬度，浮点数，范围为90 ~ -90
                longitude: locationApi.openLocation.longitude || 0, // 经度，浮点数，范围为180 ~ -180。
                name: locationApi.openLocation.name || '', // 位置名
                address: locationApi.openLocation.address || '', // 地址详情说明
                scale: locationApi.openLocation.scale || 1, // 地图缩放级别,整形值,范围从1~28。默认为最大
                infoUrl: locationApi.openLocation.infoUrl ||  '' // 在查看位置界面底部显示的超链接,可点击跳转
            });

        }else{
            console.log("缺少配置参数");
        }
    }else{
        console.log("抱歉，wx没有初始化完毕，请等待wx初始化完毕，再调用位置接口服务。");
    }
}
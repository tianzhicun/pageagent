/*
 函数名称：wxJSSDK.location
 函数功能：为wxJSSDK增加界面操作服务
 参数：
    locationApi 位置API Object 配置
 */

window.onload = function(){
    $("#getLocation").click(function(){//获取地理位置接口
        wxJSSDK.location({
            getLocation:{
                success:function (res) {
                    /*latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
                    longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
                    speed = res.speed; // 速度，以米/每秒计
                    accuracy = res.accuracy; // 位置精度*/
                    getAddress(res.latitude,res.longitude);
                },
                cancel: function (res) {
                    alert("用户拒绝授权获取地理位置");
                }
            }
        });
    });

    $("#openLocation").click(function(){//使用微信内置地图查看位置接口
        if(!latitude){
            alert('请点击获取地理位置，才能看到当前的地图位置!');
            return;
        }
        wxJSSDK.location({
            openLocation:{
                latitude: latitude, // 纬度，浮点数，范围为90 ~ -90
                longitude: longitude, // 经度，浮点数，范围为180 ~ -180。
                name: '测试', // 位置名
                address: '测试地址', // 地址详情说明
                scale: 1, // 地图缩放级别,整形值,范围从1~28。默认为最大
                infoUrl: 'http://www.html5waibao.com' // 在查看位置界面底部显示的超链接,可点击跳转
            }
        });
    });

    function getAddress(latitude,longitude){
        geocoder = new qq.maps.Geocoder({
            complete: function (result) {
                console.log(result);
                if(result.detail.addressComponents.province == '' || result.detail.addressComponents.city == ''){
                    alert("请重试!");
                }
                $("#country").html(result.detail.addressComponents.country);
                $("#province").html(result.detail.addressComponents.province);
                $("#city").html(result.detail.addressComponents.city);
                $("#district").html(result.detail.addressComponents.district);
                $("#street").html(result.detail.addressComponents.street);
                $("#town").html(result.detail.addressComponents.town);
            }
        });
        var latLng = new qq.maps.LatLng(latitude, longitude);
        geocoder.getAddress(latLng);
    }
}



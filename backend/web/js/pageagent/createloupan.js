var vue = new Vue({
    el: '#info',
    data: {
    },
    methods: {
        submit:function(){
            var options = {
                "username": this.username,
                "phone": this.phone,
                "yuyuedate":this.datetimeChange(this.yuyuedate),
                "source":source,
                "proid":proid,
            };
            console.log(API);
            API.pageagentbackend.createloupan(options,function(data){
            	if(data.data.err){
            		alert(data.data.err);
            	}else{
            		alert('操作成功');
            		window.location.replace("index?proid="+proid+"&source="+source);
            	}
           });
        },
        cancel: function() {
            console.log("cancel");
            window.location.replace("index?proid="+proid+"&source="+source);
        },
        datetimeChange:function(datetimeLocal){
            //将type="datetime-local" 转换成北京时间戳
            return new Date(datetimeLocal).getTime()/1000-8*60*60;
        }
    },
    ready:function(){
    }
})
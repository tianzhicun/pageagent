var vue = new Vue({
    el: '#info',
    data: {
    },
    methods: {
        submit:function(){
            var options = {
                "username": this.username,
                "question": this.question,
                "source":source,
                "proid":proid,
            };
            API.pageagentbackend.createques(options,function(data){
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
    },
    ready:function(){
    }
})
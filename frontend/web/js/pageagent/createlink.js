var vue = new Vue({
    el: '#info',
    data: {
    	//cpmpany: cpmpany, 
    	//name: name,
    },
    methods: {
        submit:function(){
            var options = {
                "proid":proid,
                "keyword": this.keyword,
                "link": this.link,
            };
            console.log(API);
            API.pageagent.createlink(options,function(data){
            	 window.location.replace("link?proid="+proid);
           });
        },
        cancel: function() {
            console.log("cancel");
            window.location.replace("link?proid="+proid);
        },
    },
    ready:function(){
    }
})
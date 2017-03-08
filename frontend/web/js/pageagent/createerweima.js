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
                 "erweima": this.erweima,
            };
            console.log(API);
            API.pageagent.createerweima(options,function(data){
            	 window.location.replace("erweima?proid="+proid);
           });
        },
        cancel: function() {
            console.log("cancel");
            window.location.replace("erweima?proid="+proid);
        },
    },
    ready:function(){
    }
})
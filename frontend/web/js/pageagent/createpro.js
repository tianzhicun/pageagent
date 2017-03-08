var vue = new Vue({
    el: '#info',
    data: {
    	//cpmpany: cpmpany, 
    	//name: name,
    },
    methods: {
        submit:function(){
            var options = {
                "cpmpany": this.cpmpany,
                "name": this.name,
                "createProUrl": 'http://localhost/pageagent/frontend/web/site/api/pageagent/create_pro',
            };
            console.log(API);
            API.pageagent.createpro(options,function(data){
            	 window.location.replace("admindex");
           });
        },
        cancel: function() {
            console.log("cancel");
            window.location.replace("admindex");
        },
    },
    ready:function(){
    }
})
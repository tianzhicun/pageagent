var vue = new Vue({
    el: '#info',
    data: {
    },
    methods: {
        submit:function(){
            var options = {
                "proid":proid,
                "proname": this.proname,
            };
            console.log(API);
            API.pageagent.bindact(options,function(data){
            	window.location.replace("admindex?proid="+proid);
           });
        },
        cancel: function() {
            console.log("cancel");
            //alert(proid);
            window.location.replace("admindex?proid="+proid);
        },
    },
    ready:function(){
    }
})
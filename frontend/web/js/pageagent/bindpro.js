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
            API.pageagent.bindpro(options,function(data){
                window.location.replace("admindex");
           });
        },
        cancel: function() {
            console.log("cancel");
           // window.location.replace("link");
            window.location.replace("admindex?proid="+proid);
        },
    },
    ready:function(){
    }
})
$(document).ready(function () {
	   var vue = new Vue({
		   el: '#info',
	       data: {
	           erweimainfo:[],
	           message: 'Hello Vue!',
	       },
	   });
	   
    var options = {};
    console.log(API);
    var options = {
            "proid":proid,
        };
    API.pageagent.geterweimalist(options,function(data){
    	 vue.erweimainfo = data.data.list;
        console.log(vue.erweimainfo);
    });
});

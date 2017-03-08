$(document).ready(function () {
	   var vue = new Vue({
		   el: '#info',
	       data: {
	           linkinfo:[],
	           message: 'Hello Vue!',
	       },
	   });
	   
    var options = {};
    console.log(API);
    var options = {
            "proid":proid,
        };
    API.pageagent.getlinklist(options,function(data){
    	 vue.linkinfo = data.data.list;
        console.log(vue.linkinfo);
    });
});

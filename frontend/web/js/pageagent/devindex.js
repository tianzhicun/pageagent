$(document).ready(function () {
	   var vue = new Vue({
		   el: '#info',
	       data: {
	           proinfo:[],
	           message: 'Hello Vue!',
	       },
	   });
	   
	   var options = {
               "username":username,
           };
    API.pageagent.gethomelist(options,function(data){
    	 vue.proinfo = data.data.list;
        console.log(vue.proinfo);
    });
});
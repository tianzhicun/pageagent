$(document).ready(function () {
	   var vue = new Vue({
		   el: '#info',
	       data: {
	           proinfo:[],
	           message: 'Hello Vue!',
	       },
	   });
	   
    var options = {};
    //console.log(API);
    API.pageagent.getprolist(options,function(data){
    	 vue.proinfo = data.data.list;
    	 console.log(data.data.list);
        //console.log(vue.proinfo);
    });
});

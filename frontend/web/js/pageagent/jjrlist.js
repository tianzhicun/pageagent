$(document).ready(function () {
	   var vue = new Vue({
		   el: '#info',
	       data: {
	    	   jjrinfo:[],
	           message: 'Hello Vue!',
	       },
	   });
	   
    var options = {};
    console.log(API);
    var options = {
            "hlid":hlid,
        };
    API.pageagent.getjjrlist(options,function(data){
    	 vue.jjrinfo = data.data.list;
        console.log(vue.jjrinfo[0]);
    });
});

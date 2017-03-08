$(document).ready(function () {
	
	   var vue = new Vue({
		   el: '#info',
	       data: {
	    	   proinfo: [],
	       },
	   });
	   
   var options = {
           "source":source,
           "proid":proid,
           "link":link,
       };
 API.pageagentbackend.createhome(options,function(data){
 	 vue.proinfo = data.data.err;
 });
 
 if(newvisit){
	 var options = {
	         "proid":proid,
	     };
	API.pageagentbackend.addvisit(options,function(data){
		 vue.proinfo = data.data.err;
	   console.log(vue.proinfo);
	});

 }
});

$(document).ready(function(){
		
		$(".datepicker").datepicker({dateFormat: 'yy-mm-dd'});
		$(".del_row").remove();
	
	    $('#login_btn').click(function(){
	 	   var loginid = $('#myemail').val();  
	  	   var pwd = $('#password').val();  
	              $.ajax(
	                    {
	                     url:'/login/login/',
	                     dataType:'json',
	                     type:'post',
	                     data: {"login" : loginid,"password" : pwd},
	                     success: function(data){
	                         	if(data['flag']=='yes')                		
	                             	{window.location.reload();} 
	                         	else {
	                         		$("#myemail").val("用户不存在 !");
	                         		$("#password").val("");
	                             };  
	                         }
	                     });
	            return false;
	     });

             $('#logo').click(function(){
         	    	window.location.href = "/";

		            return false;
	     });
	    
	    $('.friendlink').click(function(){
	    	var site=$(".sites option:selected").val();
	    	var url="http://"+site;
 	    	window.open(url,'_blank');
            return false;
	    });
	    
});


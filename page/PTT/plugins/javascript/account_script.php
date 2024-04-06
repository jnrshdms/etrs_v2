<script type="text/javascript">

const search_account =()=>{

	var full_name = document.getElementById('fname').value;

	$.ajax({
      url: '../../process/ptt/accounts.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_accounts',
                    full_name:full_name
                },success:function(response){
                   document.getElementById('accounts_data').innerHTML = response;
                     
                }
   }); 

}

const register_account =()=>{
	var full_name = document.getElementById('full_name_register').value;
	var username = document.getElementById('username').value;
	var password = document.getElementById('password').value;

	$.ajax({
      url: '../../process/ptt/accounts.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'register',
                    full_name:full_name,
                    username:username,
                    password:password
                },success:function(x){
                  
                   if (x == 'Training Record Already Exist!') {
             		swal('Notification',x,'info');
                
            }else if(x == 'success'){
                search_account();
                swal('Success!', 'Successfully', 'success');
                 $('#full_name_register').val('');
                  $('#username').val('');
                   $('#password').val('');
            }else{
            	 swal('Error','Error','error');
            }
                 

            }
   }); 

}

const get_account =(param)=>{
	console.log(param);
	    var string = param.split('~!~');
    var id = string[0];
    var username = string[1];
    var password = string[2];
    var fname = string[4]; 

document.getElementById('id_account_update').value = id;
document.getElementById('full_name_update').value = fname;
document.getElementById('username_update').value = username;
document.getElementById('password_update').value = password;
}

const update_account =()=>{
  	var id = document.getElementById('id_account_update').value;
  	var username = document.getElementById('username_update').value;
  	var password = document.getElementById('password_update').value;
  	var fname = document.getElementById('full_name_update').value;

     $.ajax({
        url: '../../process/ptt/accounts.php',
        type: 'POST', 
        cache: false,
        data:{
            method: 'update_account',
            id:id,
            username:username,
            password:password,
            fname:fname
        },success:function(x){
            if (x == 'success') {
               swal('Success',x,'success');
               search_account();
            }else{
               swal('Error',x,'error');
               search_account();
            }
        }
    });

}


</script>
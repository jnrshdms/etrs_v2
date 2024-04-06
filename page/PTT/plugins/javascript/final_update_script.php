<script type="text/javascript">
 
 const register_training =()=> {    
    setTimeout(generateBatchID,100); 
} 

// GENERATE BATCH ID
const generateBatchID =()=>{
    $.ajax({
        url: '../../process/ptt/final_record.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'generateBatchCode'
        },success:function(response){
            $('#final_registration_code').html(response);
        }
    });
}
 

const load_final_training_records =()=>{
	var batch_no  = document.getElementById('batch_no_final').value;
    var employee_num = document.getElementById('employee_num_final').value;
    var full_name = document.getElementById('full_name_final').value;
    var sp_id = document.getElementById('sp_id_final').value;

	$('#spinner').css('display','block');
	$.ajax({
		url: '../../process/ptt/final_record.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_for_update_final',
                    batch_no:batch_no,
                    employee_num:employee_num,
                    full_name:full_name,
                    sp_id:sp_id
                },success:function(response){
                   document.getElementById('view_data_final_training_record').innerHTML = response;
                      $('#spinner').fadeOut(function(){                       
                   });
                }
	});
}

// Revisions (Irish)
function export_final_training_records(table_id, separator = ',') {
    // Select rows from table_id
    var rows = document.querySelectorAll('table#' + table_id + ' tr');
    // Construct csv
    var csv = [];
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll('td, th');
        for (var j = 0; j < cols.length; j++) {
            var data = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, '').replace(/(\s\s)/gm, ' ')
            data = data.replace(/"/g, '""');
            // Push escaped string
            row.push('"' + data + '"');
        }
        csv.push(row.join(separator));
    }
    var csv_string = csv.join('\n');
    // Download it
    var filename = 'List of Final Training Records'+ '_' + new Date().toLocaleDateString() + '.csv';
    var link = document.createElement('a');
    link.style.display = 'none';
    link.setAttribute('target', '_blank');
    link.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv_string));
    link.setAttribute('download', filename);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}	

const get_training_final_record =(param)=>{
register_training();
    var string = param.split('~!~');
    var id = string[0];
    var batch_no = string[1];
    var employee_num = string[2];
    var gender = string[3];
    var full_name = string[4];
    var department = string[5];
    var position = string[6];
    var date_hired = string[7];
    var provider = string[8];
    var unique_id = string [9];

document.getElementById('final_id').value = id;
document.getElementById('final_batch_no_update').value = batch_no;
document.getElementById('emp_id_final_update').value = employee_num;
document.getElementById('final_gender_update').value = gender;
document.getElementById('final_full_name_update').value = full_name;
document.getElementById('final_department_update').value = department;
document.getElementById('final_position_update').value = position;
document.getElementById('final_date_hired_update').value = date_hired;
document.getElementById('sp_id_final_update').value = provider;
document.getElementById('unique_id_final_update').value = unique_id;

}


const update_final_record =()=>{
    var final_registration_code = document.querySelector('#final_registration_code').innerHTML;
    var emp_id = document.getElementById('emp_id_final_update').value;
    var final_process = document.getElementById('final_process_update').value;
    var final_status = document.getElementById('final_status_update').value;
    var final_training_date = document.getElementById('final_training_date_update').value;
    var final_training_end_date_updates = document.getElementById('final_training_ends_date_updates').value;
    var final_remarks = document.getElementById('final_remarks').value;
    var sp_id = document.getElementById('sp_id_final_update').value;
    var unique_id = document.getElementById('unique_id_final_update').value;
     $.ajax({
        url: '../../process/ptt/final_record.php',
        type: 'POST', 
        cache: false,
        data:{
            method: 'update_final_record_data',
            final_registration_code:final_registration_code,
            emp_id:emp_id,
            final_process:final_process,
            final_status:final_status,
            final_training_date:final_training_date,
            final_training_end_date_updates:final_training_end_date_updates,
            final_remarks:final_remarks,
            sp_id:sp_id,
            unique_id:unique_id
        },success:function(x){

        if (x == 'Training Record Already Exist!') {
        	    swal('Notification',x,'info');
                
            }else{
                load_final_training_records();
                swal('Success!', 'Successfully', 'success');
            }
                 
        }
    });

}

</script>
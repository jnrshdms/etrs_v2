 <script type="text/javascript">
	 
 const load_view_final_practice_training_records =()=>{
  var batch_no = document.getElementById('batch_no_final_practice_view').value;
  var emp_id = document.getElementById('employee_num_final_practice_view').value;
  var full_name = document.getElementById('full_name_final_practice_view').value;
  var eprocess = document.getElementById('eprocess_final_practice_view').value;
  var sp_id = document.getElementById('sp_id_final_practice_view').value;
   $('#spinner').css('display','block');
   $.ajax({
      url: '../../process/ptt/final_practice.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_final_practice_view',
                    batch_no:batch_no,
                    emp_id:emp_id,
                    full_name:full_name,
                    eprocess:eprocess,
                    sp_id:sp_id
                },success:function(response){
                   document.getElementById('view_data_final_practice_training_records').innerHTML = response;
                      $('#spinner').fadeOut(function(){                       
                   });
                }
   });
}

// Revisions (Irish)
function export_final_practice_view_training_records(table_id, separator = ',') {
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
    var filename = 'List of Final Practice Training Records'+ '_' + new Date().toLocaleDateString() + '.csv';
    var link = document.createElement('a');
    link.style.display = 'none';
    link.setAttribute('target', '_blank');
    link.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv_string));
    link.setAttribute('download', filename);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}	


const get_for_update_final_practice =(param)=>{

    var string = param.split('~!~');
    var id = string[0];
    var batch_no = string[1];
    var employee_num = string[2];
    var gender = string[3];
    var full_name = string[4];
    var department = string[5];
    var position = string[6];
    var date_hired = string[7];
    var final_practice_process = string[8];
    var final_practice_status = string[9];
    var final_practice_training_date = string[10];
    var final_practice_training_end_date = string[11];
    var final_practice_remarks = string[12];
    var sp_id = string[13];

document.getElementById('final_practice_id_reupdate').value = id;
document.getElementById('final_practice_batch_no_reupdate').value = batch_no;
document.getElementById('emp_id_reupdate_final_practice').value = employee_num;
document.getElementById('final_practice_gender_reupdate').value = gender;
document.getElementById('final_practice_full_name_reupdate').value = full_name;
document.getElementById('final_practice_department_reupdate').value = department;
document.getElementById('final_practice_position_reupdate').value = position;
document.getElementById('final_practice_date_hired_reupdate').value = date_hired;
document.getElementById('final_practice_process_reupdate').value = final_practice_process;
document.getElementById('final_practice_status_reupdate').value = final_practice_status;
document.getElementById('final_practice_training_date_reupdate').value = final_practice_training_date;
document.getElementById('final_practice_training_end_date_reupdate').value = final_practice_training_end_date;
document.getElementById('final_practice_remarks_reupdate').value  = final_practice_remarks;
document.getElementById('sp_id_reupdate_final_practice').value  = sp_id;
}


const reupdate_final_practice_record =()=>{
    var id = document.getElementById('final_practice_id_reupdate').value;
    var emp_id = document.getElementById('emp_id_reupdate_final_practice').value;
    var final_practice_process = document.getElementById('final_practice_process_reupdate').value;
    var final_practice_status = document.getElementById('final_practice_status_reupdate').value;
    var final_practice_training_date = document.getElementById('final_practice_training_date_reupdate').value;
    var final_practice_training_end_date = document.getElementById('final_practice_training_end_date_reupdate').value;
    var final_practice_remarks = document.getElementById('final_practice_remarks_reupdate').value
    var sp_id = document.getElementById('sp_id_reupdate_final_practice').value;

     $.ajax({
        url: '../../process/ptt/final_practice.php',
        type: 'POST', 
        cache: false,
        data:{
            method: 'update_final_practice',
            id:id,
            emp_id:emp_id,
            final_practice_process:final_practice_process,
            final_practice_status:final_practice_status,
            final_practice_training_date:final_practice_training_date,
            final_practice_training_end_date:final_practice_training_end_date,
            final_practice_remarks:final_practice_remarks,
            sp_id:sp_id
        },success:function(x){
            if (x == 'success') {
               swal('Success',x,'success');
               load_view_final_practice_training_records();
            }else{
               swal('Error',x,'error');
               load_view_final_practice_training_records();
            }
        }
    });

}

// Revisions (Vince)
const delete_final_practice_record =()=>{
    var id = document.getElementById('final_practice_id_reupdate').value;
    let confirm_delete = "Delete Final Practice Training Record\nDelete this record?";
    if (confirm(confirm_delete) == true) {
        $.ajax({
            url: '../../process/ptt/final_practice.php',
            type: 'POST', 
            cache: false,
            data:{
                method: 'delete_final_practice',
                id:id
            },success:function(x){
                if (x == 'success') {
                    swal('Success',x,'success');
                    load_view_final_practice_training_records();
                }else{
                    swal('Error',x,'error');
                }
            }
        });
    }
}
</script>
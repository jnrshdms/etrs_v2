<script type="text/javascript">	
 const load_view_final_training_records =()=>{
  var batch_no = document.getElementById('batch_no_final').value;
  var emp_id = document.getElementById('employee_num_final').value;
  var full_name = document.getElementById('full_name_final').value;
  var eprocess = document.getElementById('eprocess_final_view').value;
  var sp_id = document.getElementById('sp_id_final').value;
   $('#spinner').css('display','block');
   $.ajax({
      url: '../../process/ptt/final_record.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_final',
                    batch_no:batch_no,
                    emp_id:emp_id,
                    full_name:full_name,
                    eprocess:eprocess,
                    sp_id:sp_id
                },success:function(response){
                   document.getElementById('view_data_final_training_records').innerHTML = response;
                      $('#spinner').fadeOut(function(){                       
                   });
                }
   }); 
} 

// Revisions (Irish)
function export_final_view_training_records(table_id, separator = ',') {
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


const get_for_update_final =(param)=>{

    var string = param.split('~!~');
    var id = string[0];
    var batch_no = string[1];
    var employee_num = string[2];
    var gender = string[3];
    var full_name = string[4];
    var department = string[5];
    var position = string[6];
    var date_hired = string[7];
    var final_process = string[8];
    var final_status = string[9];
    var final_training_date = string[10];
    var final_training_ends_dates = string[11];
    var final_remarks = string[12];
    var sp_id = string[13];

document.getElementById('final_id_reupdate').value = id;
document.getElementById('final_batch_no_reupdate').value = batch_no;
document.getElementById('emp_id_reupdates').value = employee_num;
document.getElementById('final_gender_reupdate').value = gender;
document.getElementById('final_full_name_reupdate').value = full_name;
document.getElementById('final_department_reupdate').value = department;
document.getElementById('final_position_reupdate').value = position;
document.getElementById('final_date_hired_reupdate').value = date_hired;
document.getElementById('final_process_reupdate').value = final_process;
document.getElementById('final_status_reupdate').value = final_status;
document.getElementById('final_training_date_reupdate').value = final_training_date;
document.getElementById('final_training_end_dates_reupdatess').value = final_training_ends_dates;
document.getElementById('final_remarks_reupdate').value = final_remarks;
document.getElementById('sp_id_reupdates').value = sp_id;
}


const reupdate_final_record =()=>{
    var id = document.getElementById('final_id_reupdate').value;
    var emp_id = document.getElementById('emp_id_reupdates').value;
    var final_process = document.getElementById('final_process_reupdate').value;
    var final_status = document.getElementById('final_status_reupdate').value;
    var final_training_date = document.getElementById('final_training_date_reupdate').value;
    var final_training_ends_dates = document.getElementById('final_training_end_dates_reupdatess').value;
    var final_remarks = document.getElementById('final_remarks_reupdate').value;
    var sp_id = document.getElementById('sp_id_reupdates').value;
     $.ajax({
        url: '../../process/ptt/final_record.php',
        type: 'POST', 
        cache: false,
        data:{
            method: 'update_final',
            id:id,
            emp_id:emp_id,
            final_process:final_process,
            final_status:final_status,
            final_training_date:final_training_date,
            final_training_ends_dates:final_training_ends_dates,
            final_remarks:final_remarks,
            sp_id:sp_id
        },success:function(x){
            // console.log(x);

            if (x == 'success') {
               swal('Success',x,'success');
               load_view_final_training_records();
            }else{
               swal('Error',x,'error');
               load_view_final_training_records();
            }
        }
    });

}

// Revisions (Vince)
const delete_final_record =()=>{
    var id = document.getElementById('final_id_reupdate').value;
    let confirm_delete = "Delete Final Training Record\nDelete this record?";
    if (confirm(confirm_delete) == true) {
        $.ajax({
            url: '../../process/ptt/final_record.php',
            type: 'POST', 
            cache: false,
            data:{
                method: 'delete_final',
                id:id
            },success:function(x){
                if (x == 'success') {
                    swal('Success',x,'success');
                    load_view_final_training_records();
                }else{
                    swal('Error',x,'error');
                }
            }
        });
    }
}
</script>
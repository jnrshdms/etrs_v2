<script type="text/javascript">
    
 const load_view_initial_training_records =()=>{
  var batch_no = document.getElementById('batch_no_initial').value;
  var emp_id = document.getElementById('employee_num_initial').value;
  var full_name = document.getElementById('full_name_initial').value;
  var eprocess = document.getElementById('eprocess_initial_view').value;
  var sp_id = document.getElementById('sp_id_initial').value;
   $('#spinner').css('display','block');
   $.ajax({
      url: '../../process/ptt/initial_record.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_intial',
                    batch_no:batch_no,
                    emp_id:emp_id,
                    full_name:full_name,
                    eprocess:eprocess,
                    sp_id:sp_id
                },success:function(response){
                   document.getElementById('view_data_initial_training_records').innerHTML = response;
                      $('#spinner').fadeOut(function(){                       
                   });
                }
   });
}

// Revisions (Irish)
function export_initial_view_training_records(table_id, separator = ',') {
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
    var filename = 'List of Initial Training Records'+ '_' + new Date().toLocaleDateString() + '.csv';
    var link = document.createElement('a');
    link.style.display = 'none';
    link.setAttribute('target', '_blank');
    link.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv_string));
    link.setAttribute('download', filename);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
  
const get_for_update =(param)=>{

    var string = param.split('~!~');
    var id = string[0];
    var batch_no = string[1];
    var employee_num = string[2];
    var gender = string[3];
    var full_name = string[4];
    var department = string[5];
    var position = string[6];
    var date_hired = string[7];
    var initial_process = string[8];
    var initial_status = string[9];
    var initial_training_date = string[10];
    var initial_training_end_date = string[11];
    var initial_remarks = string[12];
    var sp_id = string[13];

document.getElementById('initial_id_reupdate').value = id;
document.getElementById('initial_batch_no_reupdate').value = batch_no;
document.getElementById('emp_id_reupdate').value = employee_num;
document.getElementById('initial_gender_reupdate').value = gender;
document.getElementById('initial_full_name_reupdate').value = full_name;
document.getElementById('initial_department_reupdate').value = department;
document.getElementById('initial_position_reupdate').value = position;
document.getElementById('initial_date_hired_reupdate').value = date_hired;
document.getElementById('initial_process_reupdate').value = initial_process;
document.getElementById('initial_status_reupdate').value = initial_status;
document.getElementById('initial_training_date_reupdate').value = initial_training_date;
document.getElementById('initial_training_end_date_reupdate').value = initial_training_end_date;
document.getElementById('initial_remarks_reupdate').value = initial_remarks;
document.getElementById('sp_id_reupdate').value = sp_id;
}
 
  
const reupdate_initial_record =()=>{
    var id = document.getElementById('initial_id_reupdate').value;
    var emp_id = document.getElementById('emp_id_reupdate').value;
    var initial_process = document.getElementById('initial_process_reupdate').value;
    var initial_status = document.getElementById('initial_status_reupdate').value;
    var initial_training_date = document.getElementById('initial_training_date_reupdate').value;
    var initial_training_end_date = document.getElementById('initial_training_end_date_reupdate').value;
    var initial_remarks = document.getElementById('initial_remarks_reupdate').value;
    var sp_id = document.getElementById('sp_id_reupdate').value;
     $.ajax({
        url: '../../process/ptt/initial_record.php',
        type: 'POST', 
        cache: false,
        data:{
            method: 'update_initial',
            id:id,
            emp_id:emp_id,
            initial_process:initial_process,
            initial_status:initial_status,
            initial_training_date:initial_training_date,
            initial_training_end_date:initial_training_end_date,
            initial_remarks:initial_remarks,
            sp_id:sp_id
        },success:function(x){
            if (x == 'success') {
               swal('Success',x,'success');
               load_view_initial_training_records();
            }else{
               swal('Error',x,'error');
               load_view_initial_training_records();
            }
        }
    });

}

// Revisions (Vince)
const delete_initial_record =()=>{
    var id = document.getElementById('initial_id_reupdate').value;
    let confirm_delete = "Delete Initial Training Record\nDelete this record?";
    if (confirm(confirm_delete) == true) {
        $.ajax({
            url: '../../process/ptt/initial_record.php',
            type: 'POST', 
            cache: false,
            data:{
                method: 'delete_initial',
                id:id
            },success:function(x){
                if (x == 'success') {
                    swal('Success',x,'success');
                    load_view_initial_training_records();
                }else{
                    swal('Error',x,'error');
                }
            }
        });
    }
}


</script>
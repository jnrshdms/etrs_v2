<div class="modal fade bd-example-modal-xl" id="reupdate_record" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
            <div id="initial_registration_code" hidden>

            </div>

        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"  >
            <!-- onclick="javascript:window.location.reload()" -->
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <div class="row">
                <div class="col-2">
                        <input type="hidden" name="initial_id" id="initial_id_reupdate">
                     <span>Batch No:   </span> <input type="text" id="initial_batch_no_reupdate" class="form-control" class="noSpace" disabled>
                </div>
                 <div class="col-2">
                     <span> SP ID Number:   </span> <input type="text" id="sp_id_reupdate" class="form-control" autocomplete="OFF" class="noSpace" >
                </div>
                <div class="col-2">
                     <span> FALP ID Number:   </span> <input type="text" id="emp_id_reupdate" class="form-control" autocomplete="OFF" class="noSpace" >
                </div>
                 <div class="col-3">
                     <span> Gender:   </span> <input type="text" id="initial_gender_reupdate" class="form-control"  autocomplete="OFF" class="noSpace" disabled>
                </div>     
                  <div class="col-3">
                     <span>Full Name:</span> <input type="text" name="initial_full_name_reupdate" id="initial_full_name_reupdate" class="form-control" disabled>
                 </div>           
           </div>
           <div class="row">
               
                 <div class="col-3">
                     <span>Department:</span> <input type="text" name="initial_department_reupdate" id="initial_department_reupdate" class="form-control" disabled>
                 </div>
                 <div class="col-3">
                     <span>Position:</span> <input type="text" name="initial_position_update" id="initial_position_reupdate" class="form-control" disabled>
                 </div>
                 <div class="col-3">
                     <span>Date Hired:</span> <input type="text" name="initial_date_hired_update" id="initial_date_hired_reupdate" class="form-control" disabled>
                 </div>
                 <div class="col-3">
                     <span>Remarks:</span>
                     <input type="text" name="initial_remarks_reupdate" id="initial_remarks_reupdate" class="form-control">
                 </div>
           </div>  
           <div class="row">
                <div class="col-3">
                     <span>Process:</span>
                    <select id="initial_process_reupdate" class="form-control">
                        <option value="">Select Intial Process</option>
                        <option value="All_Process">All Process</option>
                        <option value="First_Process">First Process</option>
                        <option value="Secondary_Process">Secondary Process</option>
                    </select>
                </div>
                <div class="col-3">
                       <span>Initial Training:</span>
                    <select class="form-control" id="initial_status_reupdate">
                        <option value="">Select Initial Training Status</option>
                       <option value="Passed">Passed</option>
                        <option value="Failed">Failed</option>
                        <option value="Dismissed">Dismissed</option>
                        <option value="Pulled_Out">Pulled Out</option>
                        <option value="Resigned">Resigned</option>
                        <option value="Retrained">Retrained</option>
                        <option value="No_Training">No Training</option>
                         <option value="Recall">Recall</option>
                    </select>
                </div>
                <div class="col-3">
                     <span>Training Start Date:</span>
                    <input type="date" name="date_hired" id="initial_training_date_reupdate" class="form-control">
                </div>
                 <div class="col-3">
                     <span>Training End Date:</span>
                    <input type="date" name="date_hired" id="initial_training_end_date_reupdate" class="form-control">
                </div>
                
               
           </div>       
           <br>
           <!-- <div class="row">
                        <div class="col-12">
                          <p style="text-align:right;">
                        <button type="button" class="btn btn-primary"  onclick="reupdate_initial_record()" id="planBtnCreate">Update</button>
                          </p>
                        </div>
           </div> -->

           <div class="row">
                <div class="col-9">
                    <div class="float-left">
                        <button class="btn btn-danger" id="planbtnDelete" onclick="delete_initial_record()">Delete</button>
                    </div>
                </div>
                <div class="col-3">
                    <div class="float-right">
                        <button class="btn btn-primary" id="planbtnUpdate" onclick="reupdate_initial_record()">Update</button>
                    </div>
                </div>
            </div>
      </div>
     
    </div>
  </div>
</div>


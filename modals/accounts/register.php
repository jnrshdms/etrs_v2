

<div class="modal fade" id="new_account" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Register Account</h5>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"  onclick="javascript:window.location.reload()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                <div class="row">
                <div class="col-12">
                     <span>Full Name:   </span> <input type="text" id="full_name_register" class="form-control"  autocomplete="OFF" class="noSpace">
                </div>
                <div class="col-12">
                     <span>Username:   </span> <input type="text" id="username" class="form-control" autocomplete="OFF">
                </div>
                 <div class="col-12">
                  <span> Password:   </span> <input type="password" id="password" class="form-control"  autocomplete="OFF" class="noSpace">
                </div>  
                 <!-- <div class="col-12">
                  <span> Role:   </span> 
                  <select id="role" class="form-control">
                    <option value="">Select Role</option>
                    <option value="theory">Theory</option>
                    <option value="initial">Initial</option>
                    <option value="final">Final</option>
                  </select>
                </div>   -->
                
           </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       <button type="button" class="btn btn-primary"  onclick="register_account()" id="planBtnCreate">Register</button>
      </div>
    </div>
  </div>
</div>

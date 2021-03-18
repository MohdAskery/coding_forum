<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


   <form action="<?php $_SERVER["REQUEST_URI"] ?>" method="POST">
    <div class="form-group">
          <label for="current_password">Current Password</label>
          <input type="password" name="cu_password" class="form-control" id="current_password" aria-describedby="emailHelp" placeholder="current password">
    </div>
    <div class="form-group">
        <label for="new_password">New password</label>
        <input type="password" name='new_password' class="form-control" id="new_password" placeholder="new password">
    </div>
        <div class="form-group">
        <label for="c_password">Confirm password</label>
        <input type="password" name="c_pass" class="form-control" id="c_password" placeholder="confirm password">
    </div>
  <button type="submit" name="password_btn" class="btn btn-primary">Change</button>
</form>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
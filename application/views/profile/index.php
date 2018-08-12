<div class="container">
    <!--vertical align on parent using my-auto-->
    <div class="row h-100">
        <div class="col-sm-12 my-auto">
            <div class="container">
                <form class="form-horizontal" autocomplete="off" role="form" method="POST"
                      action="profile?action=update&id=<?php echo $this->user->id ?>">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 text-center">
                            <h2>Your profile</h2>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="username" class="col-sm-4 col-form-label">Username</label>
                                <div class="col-sm-8">
                                    <input type="text" disabled class="form-control" id="username"
                                           value=<?php echo '"' . htmlspecialchars($this->user->username, ENT_QUOTES) . '"' ?>>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="role" class="col-sm-4 col-form-label">Role</label>
                                <div class="col-sm-8">
                                    <input type="text" disabled class="form-control" id="role"
                                           value=<?php echo '"' . htmlspecialchars($this->user->roles, ENT_QUOTES) . '"' ?>>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="old-password" class="col-sm-4 col-form-label">Current password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="old-password" name="oldpassword"
                                           placeholder="Current password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="new-password" class="col-sm-4 col-form-label">New password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="new-password" name="newpassword"
                                           placeholder="New password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="re-password" class="col-sm-4 col-form-label">Re-enter</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="re-password" name="repassword"
                                           placeholder="Re-enter new password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" id="email" name="email"
                                           value=<?php echo htmlspecialchars($this->user->email, ENT_QUOTES) ?>
                                           placeholder="abc@example.com">
                                </div>
                            </div>
                        </div>
                    </div>


                    <?php if (isset($this->status)) { ?>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="form-control-feedback">
                                    <span class=<?php echo $this->status === 'success' ? '"text-success' : '"text-danger' ?> align-middle">
                                        <i class="fa <?php echo $this->status === 'success' ? 'fa-check"' : 'fa-close"' ?> ></i> <?php echo $this->status ?>
                                    </span>
                                </div>
                            </div>
                            <div class=" col-md-3"></div>
                        </div>
                        <?php } ?>

                        <div class="row" style="padding-top: 1rem">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <button type="submit" name="update" class="btn btn-success"><i class="fa fa-edit"></i>
                                    Update
                                </button>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                                        data-target="#exampleModalCenter">
                                    Delete this account
                                </button>
                                <a href="javascript:history.go(-1)" class="btn btn-outline-secondary">
                                    Go back
                                </a>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete account
                                                    confirm</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Do you really want to delete this account? <br> Deletion can not be
                                                recovered!
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" name="delete" class="btn btn-danger">Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
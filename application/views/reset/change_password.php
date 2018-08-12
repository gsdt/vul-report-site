
<div class="container">
    <!--vertical align on parent using my-auto-->
    <div class="row h-100">
        <div class="col-sm-12 my-auto">
            <div class="container">
                <form class="form-horizontal" autocomplete="off" role="form" method="POST" action="reset?action=reset&token=<?php echo $this->reseter->token ?>" >
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 text-center">
                            <h2>Reset password</h2>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="username" class="col-sm-4 col-form-label">Username</label>
                                <div class="col-sm-8">
                                    <input type="text" disabled class="form-control" id="username" value=<?php echo '"'.htmlspecialchars($this->reseter->username,ENT_QUOTES).'"' ?> >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="new-password" class="col-sm-4 col-form-label">New password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="new-password" name="newpassword" placeholder="New password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="re-password" class="col-sm-4 col-form-label">Re-enter</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="re-password" name="repassword" placeholder="Re-enter new password">
                                </div>
                            </div>
                            <input type="hidden" name="validator" value= <?php echo '"'.$this->reseter->validator.'"' ?> />
                        </div>
                    </div>




                    <?php if (isset($this->status)) { ?>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="form-control-feedback">
                                    <span class=<?php echo $this->status==='success'?'"text-success':'"text-danger' ?> align-middle">
                                        <i class="fa <?php echo $this->status==='success'?'fa-check"':'fa-close"' ?> ></i> <?php echo $this->status ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                    <?php } ?>

                    <div class="row" style="padding-top: 1rem">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success"><i class="fa fa-edit"></i> Change password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
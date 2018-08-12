
<div class="container">
    <!--vertical align on parent using my-auto-->
    <div class="row h-100">
        <div class="col-sm-12 my-auto">
            <div class="container">
                <form class="form-horizontal" autocomplete="off" role="form" method="POST" action="register">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 text-center">
                            <h2>Fill your information</h2>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="username" class="col-sm-4 col-form-label">Username</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="username" name="username" value="<?php echo isset($_POST['username'])? htmlspecialchars($_POST['username'],ENT_QUOTES):'' ?>"
                                    placeholder="Username"
                                    >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="new-password" class="col-sm-4 col-form-label">New password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="new-password" name="password" placeholder="New password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="re-password" class="col-sm-4 col-form-label">Re-enter</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="re-password" name="repassword" placeholder="Re-enter new password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" id="email" name ="email" value="<?php echo isset($_POST['email'])? htmlspecialchars($_POST['email'],ENT_QUOTES):'' ?>"
                                    placeholder="abc@example.com">
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if(isset($this->error_message)) { ?>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <div class="form-control-feedback">
                                    <span class="text-danger align-middle">
                                        <i class="fa fa-close"></i> <?php echo $this->error_message ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    <?php } ?>
                    <div class="row" style="padding-top: 1rem">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success"><i class="fa fa-sign-in"></i> Submit</button>
                            <a class="btn btn-link" href="/login">Alread have a account? Login here.</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
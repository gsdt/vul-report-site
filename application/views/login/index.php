<div class="container">
    <!--vertical align on parent using my-auto-->
    <div class="row h-100">
        <div class="col-sm-12 my-auto">
            <div class="container">
                <form class="form-horizontal" autocomplete="off" role="form" method="POST" action="login">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 text-center">
                            <h2>Please Login <br><a class="small">or</a> <br><a href="register">create new account</a>
                            </h2>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="form-group has-danger">
                                <label class="sr-only" for="email">Username</label>
                                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                    <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-user"></i>
                                    </div>
                                    <input type="text" name="username" class="form-control" id="username"
                                           placeholder="Username" required autofocus>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="sr-only" for="password">Password</label>
                                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                    <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-key"></i></div>
                                    <input type="password" name="password" class="form-control" id="password"
                                           placeholder="Password" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-control-feedback">
                        <span class="text-danger align-middle">
                        <!-- Put password error message here -->
                        </span>
                            </div>
                        </div>
                    </div>
                    <?php if (isset($this->error_msg)) { ?>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <div class="form-control-feedback">
                                    <span class="text-danger align-middle">
                                        <i class="fa fa-close"></i> <?php echo $this->error_msg ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    <?php } ?>

                    <div class="row" style="padding-top: 1rem">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success"><i class="fa fa-sign-in"></i> Login</button>
                            <a class="btn btn-link" href="reset">Forgot Your Password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
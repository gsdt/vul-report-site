
<div class="container">
    <!--vertical align on parent using my-auto-->
    <div class="row h-100">
        <div class="col-sm-12 my-auto">
            <div class="container">
                <form class="form-horizontal" autocomplete="off" role="form" method="POST" action="reset">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 text-center">
                            <h2>Reset password</h2>
                            <p>We will send a link to reset your account password in your email.</p>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email: </label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email address"
                                    <?php if(isset($_POST['email'])) echo 'value="'.$_POST['email'].'"' ?>
                                    >
                                </div>
                            </div>
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
                    <?php } ?>

                    <div class="row" style="padding-top: 1rem">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success"><i class="fa fa-edit"></i>  Get reset link</button>
                            <a class="btn btn-link" href="/">Go back.</a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
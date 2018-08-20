<script>
    var vul_index = 1;
    function show_notification(status, message) {
        if(status === 'success') {
            $('#notification-message').html(`
            <div id="notification-message" class="text-success">
                    <i class="fa fa-check"></i></i> ${message}
                </div>
            `);
        }
        else if(status === 'fail') {
            $('#notification-message').html(`
            <div id="notification-message" class="text-danger">
                    <i class="fa fa-check"></i></i> ${message}
                </div>
            `);
        }
        $('#notification-modal').modal('show');
    }
    function submit_report() {
        var report_name = $.trim($('#report-name').val());
        var report_target = $.trim($('#report-target').val());
        var report_recipient = $.trim($('#report-recipient').val());

        if(report_name === '') {
            show_notification('fail', 'You must provide report name');
            return;
        }

        if(report_target === '') {
            show_notification('fail', 'Report must have target');
            return;
        }

        if(report_recipient === '') {
            show_notification('fail', 'You must provide at least one recipient.');
            return;
        }

        show_notification('fail', "OK! Google.")
    }

    function on_star_clicked(id, type) {
        var star_list = $('#star-group-'+id).children();
        console.log(star_list);

        $(star_list).each(function (index, element) {
           var star_type = element.id.split('-').pop();
           if(star_type<=type) {
               $(element).attr('class', 'fa fa-star-o fa-2x text-warning')
           }
           else {
               $(element).attr('class', 'fa fa-star-o fa-2x');
           }
        });

        $('#risk-0').val(type+1);
    }

    function add_vulnerable() {
        $('#vul-list-area').append(`
        <div id="vul-${vul_index}" class="border border-primary rounded p-4 mb-4">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="col-form-label">Vulnerable</label>
                                </div>
                                <div class="col-md-9">
                                    <input id="vul-name-${vul_index}" class="form-control" type="text"
                                           autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">

                        </div>

                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="col-form-label">Risk level</label>
                                </div>
                                <div class="col-md-5">
                                    <div id="star-group-${vul_index}" class="row">
                                        <i id="star-${vul_index}-0" onclick="on_star_clicked(${vul_index},0)" class="fa fa-star-o fa-2x"></i>
                                        <i id="star-${vul_index}-1" onclick="on_star_clicked(${vul_index},1)" class="fa fa-star-o fa-2x"></i>
                                        <i id="star-${vul_index}-2" onclick="on_star_clicked(${vul_index},2)" class="fa fa-star-o fa-2x"></i>
                                        <i id="star-${vul_index}-3" onclick="on_star_clicked(${vul_index},3)" class="fa fa-star-o fa-2x"></i>
                                        <i id="star-${vul_index}-4" onclick="on_star_clicked(${vul_index},4)" class="fa fa-star-o fa-2x"></i>
                                    </div>
                                    <input type="hidden" id="risk-${vul_index}" value="0" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <label class="col-form-label">Description</label>
                        <textarea id="vul-desc-${vul_index}" class="form-control"></textarea>
                    </div>
                </div>
                `);
        vul_index ++;
        $("html, body").animate({ scrollTop: $(document).height() }, 1000);
    }
</script>
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <h2>Create new report</h2>
            <hr>
            <div class="row mt-1 mb-1 form-group">
                <div class="col-md-2">
                    <label class="col-form-label">Name </label>
                </div>
                <div class="col-md-10">
                    <input id="report-name" class="form-control" type="text" name="name" placeholder="enter new name for your report..."
                           autocomplete="off" required/>
                </div>
            </div>
            <div class="row mt-1 mb-1 form-group">
                <div class="col-md-2">
                    <label class="col-form-label">Target </label>
                </div>
                <div class="col-md-10">
                    <input id="report-target" class="form-control" type="text" name="target" placeholder="for example: www.fpt.com.vn/login"
                           autocomplete="off" required/>
                </div>
            </div>
            <div class="row mt-1 mb-1 form-group">
                <div class="col-md-2">
                    <label class="col-form-label">Recipient </label>
                </div>
                <div class="col-md-10">
                    <input id="report-recipient" class="form-control" type="text" name="recipient" placeholder="who receive this report?"
                           autocomplete="off" required/>
                </div>
            </div>

            <hr>
            <div id="vul-list-area">
                <div id="vul-0" class="border border-primary rounded pl-4 pr-4 pb-4 mb-4">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="col-form-label">Vulnerable</label>
                                </div>
                                <div class="col-md-9">
                                    <input id="vul-name-0" class="form-control" type="text"
                                           autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">

                        </div>

                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="col-form-label">Risk level</label>
                                </div>
                                <div class="col-md-5">
                                    <div id="star-group-0" class="row">
                                        <i id="star-0-0" onclick="on_star_clicked(0,0)" class="fa fa-star-o fa-2x"></i>
                                        <i id="star-0-1" onclick="on_star_clicked(0,1)" class="fa fa-star-o fa-2x"></i>
                                        <i id="star-0-2" onclick="on_star_clicked(0,2)" class="fa fa-star-o fa-2x"></i>
                                        <i id="star-0-3" onclick="on_star_clicked(0,3)" class="fa fa-star-o fa-2x"></i>
                                        <i id="star-0-4" onclick="on_star_clicked(0,4)" class="fa fa-star-o fa-2x"></i>
                                    </div>
                                    <input type="hidden" id="risk-0" value="0" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <label class="col-form-label">Description</label>
                        <textarea id="vul-desc-0" class="form-control"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10">
            <hr>
            <div class="row mt-1 mb-1">
                <div class="col-md-2">
                    <button onclick="add_vulnerable()" class="btn btn-primary">Add vulnerable</button>
                </div>
                <div class="col-md-2">
                    <button onclick="submit_report()" class="btn btn-outline-primary">Report</button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="notification-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="notification-message" class="text-success">
                    <i class="fa fa-check"></i></i> lskdjflaksdjf
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    String.prototype.replaceAll = function(search, replacement) {
        var target = this;
        return target.replace(new RegExp(search, 'gi'), replacement);
    };
    function escapeHtml(text) {
        // console.log(text);
        var map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };

        return text.replace(/[&<>"']/g, function(m) { return map[m]; });
    }

    var vul_index = 1;
    var autocomplete_index = -1;

    function show_notification(status, message) {
        if(status === 'done') {
            $('#notification-message').attr('class', 'text-success');
            $('#notification-message').html(`
                    <i class="fa fa-check"></i></i> ${message}
            `);
        }
        else if(status === 'fail') {
            $('#notification-message').attr('class', 'text-danger');
            $('#notification-message').html(`
                    <i class="fa fa-check"></i></i> ${message}
            `);
        }
        $('#notification-modal').modal('show');
    }
    function submit_report() {
        var report_name = $.trim($('#report-name').val());
        var report_target = $.trim($('#report-target').val());
        var report_recipient = $.trim($('#report-recipient').val());

        var data = {};
        data.report_name = report_name;
        data.report_target = report_target;
        data.report_recipient = report_recipient;
        data.vulnerables = [];

        var vul_list = $('#vul-list-area').children();
        $(vul_list).each(function (index, element) {
           var vul_id = element.id.split('-').pop();
           // console.log(element.id);
           var vulnerable = {};
           vulnerable.name = $('#vul-name-'+ vul_id).val();
           vulnerable.level = $('#risk-' + vul_id).val();
           vulnerable.description = $('#vul-desc-' + vul_id).val();
           data.vulnerables.push(vulnerable);
        });

        console.log(data);
        $.ajax({
            type: "POST",
            url: "/report?action=create",
            data: data,
            success: function (response) {
                console.log(response);
                show_notification(response.status, response.message);
            }
        });
    }

    function on_star_clicked(id, type) {
        var star_list = $('#star-group-'+id).children();
        // console.log(star_list);

        $(star_list).each(function (index, element) {
           var star_type = element.id.split('-').pop();
           if(star_type<=type) {
               $(element).attr('class', 'fa fa-star-o fa-2x text-warning')
           }
           else {
               $(element).attr('class', 'fa fa-star-o fa-2x');
           }
        });

        $('#risk-'+id).val(type+1);
    }

    function add_vulnerable() {
        $('#vul-list-area').append(`
        <div id="vul-${vul_index}" class="border border-primary rounded pl-4 pr-4 pb-4 mb-4">
                    <div class="d-flex justify-content-end">
                        <button onclick="remove_vulnerable(${vul_index})" type="button" class="close" aria-label="Close">
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
                                    <input id="vul-name-${vul_index}" class="form-control" type="text"
                                           oninput="get_hint(${vul_index})"
                                           onkeydown="autocomplete_onkeydown(event, ${vul_index})"
                                           autocomplete="off" required/>
                                    <div id="autocomplete-${vul_index}" class="autocomplete-items">
                                    </div>
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

    function remove_vulnerable(id) {
        $('#vul-' + id).remove();
    }

    function close_all_hint() {
        var hints = $('.autocomplete-items');
        $(hints).each(function (index, element) {
            $(element).html('');
        });
    }
    var hint_data;

    function hint_selected(hint_id, id) {
        $('#vul-name-'+id).val(hint_data[hint_id].name);
        $('#vul-desc-'+id).val(hint_data[hint_id].description);
        close_all_hint();
    }

    function get_hint(id) {
        autocomplete_index = -1;
        close_all_hint();
        var text = $('#vul-name-'+id).val();
        if(text.length<3) return;
        $.ajax({
            type: "POST",
            url: "/report?action=hint",
            data: {'text':text},
            success: function (data) {
                close_all_hint();
                hint_data = data;
                $(data).each(function (index, element) {
                    text = escapeHtml(text);
                    var name = escapeHtml(element.name);
                    $('#autocomplete-'+id).append(`<div onclick="hint_selected(${index}, ${id})"> ${name.replaceAll(text, '<b>'+text+'</b>')} </div>`)
                });
            }
        });
    }


    function autocomplete_onkeydown(event, id) {
        if(event.keyCode == 40) {
            autocomplete_index ++;
            autocomplete_index = Math.min(hint_data.length-1, autocomplete_index);
        }
        else if(event.keyCode == 38) {
            autocomplete_index --;
            autocomplete_index = Math.max(-1, autocomplete_index);
        }

        $('#autocomplete-'+id).children().each(function (index, element) {
            if(index == autocomplete_index) {
                $(element).attr('class', 'autocomplete-active');
                if(event.keyCode === 13) {
                    $(element).click();
                }
            }
            else {
                $(element).attr('class', '')
            }
        });


    }
    
</script>


<style>
    .autocomplete {
        /*the container must be positioned relative:*/
        position: relative;
        display: inline-block;
    }
    .autocomplete-items {
        position: absolute;
        border: 1px solid #d4d4d4;
        border-bottom: none;
        border-top: none;
        z-index: 99;
        /*position the autocomplete items to be the same width as the container:*/
        top: 100%;
        left: 15px;
        right: 15px;
    }
    .autocomplete-items div {
        padding: 10px;
        cursor: pointer;
        background-color: #fff;
        border-bottom: 1px solid #d4d4d4;
    }
    .autocomplete-items div:hover {
        /*when hovering an item:*/
        background-color: #e9e9e9;
    }
    .autocomplete-active {
        /*when navigating through the items using the arrow keys:*/
        background-color: DodgerBlue !important;
        color: #ffffff;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-10 mt-4">
            <h2>Create new report</h2>
            <hr>
            <div class="row mt-1 mb-1 form-group">
                <div class="col-md-2">
                    <label class="col-form-label">Name </label>
                </div>
                <div class="col-md-10">
                    <input id="report-name" class="form-control" type="text"
                           placeholder="enter new name for your report..."
                           autocomplete="off" required/>
                </div>
            </div>
            <div class="row mt-1 mb-1 form-group">
                <div class="col-md-2">
                    <label class="col-form-label">Target </label>
                </div>
                <div class="col-md-10">
                    <input id="report-target" class="form-control" type="text" placeholder="for example: www.fpt.com.vn/login"
                           autocomplete="off" required/>
                </div>
            </div>
            <div class="row mt-1 mb-1 form-group">
                <div class="col-md-2">
                    <label class="col-form-label">Recipient </label>
                </div>
                <div class="col-md-10">
                    <input id="report-recipient" class="form-control" type="text" placeholder="who receive this report?"
                           autocomplete="off" required/>
                </div>
            </div>

            <hr>
            <div id="vul-list-area">
                <div id="vul-0" class="border border-primary rounded pl-4 pr-4 pb-4 mb-4">
                    <div class="d-flex justify-content-end">
                        <button tabindex="-1" onclick="remove_vulnerable(0)" type="button" class="close" aria-label="Close">
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
                                           oninput="get_hint(0)"
                                           onkeydown="autocomplete_onkeydown(event, 0)"
                                           autocomplete="off" required/>
                                    <div id="autocomplete-0" class="autocomplete-items">
                                    </div>
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
                <div class="col-md-2 mb-2">
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
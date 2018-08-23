
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="mt-4">Your report</h2>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link" id="v-pills-inbox-tab" data-toggle="pill" href="#v-pills-inbox" role="tab" aria-controls="v-pills-inbox" aria-selected="true">Inbox</a>
                <a class="nav-link" id="v-pills-outbox-tab" data-toggle="pill" href="#v-pills-outbox" role="tab" aria-controls="v-pills-outbox" aria-selected="false">Outbox</a>
                <a class="nav-link " id="v-pills-draft-tab" data-toggle="pill" href="#v-pills-draft" role="tab" aria-controls="v-pills-draft" aria-selected="false">Draft</a>
            </div>
        </div>
        <div class="col-10">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-inbox" role="tabpanel" aria-labelledby="v-pills-inbox-tab">
                    <table class="table table-hover" id="table">
                        <thead>
                        <tr class="table-primary">
                            <th scope="col">#</th>
                            <th scope="col">Date created</th>
                            <th scope="col">Sender</th>
                            <th scope="col">Report name</th>
                        </tr>
                        </thead>
                        <tbody id="table-inbox">
                        <tr onclick="modal_view(0)">
                            <th scope="row">1</th>
                            <td>2018-08-13 14:32:09</td>
                            <td>SQL injection</td>
                            <td>This is dangerous vulnerable f... (continue)</td>
                        </tr>
                        </tbody>
                    </table>
                    <nav>
                        <ul id="pagination-inbox" class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>

                </div>
                <div class="tab-pane fade" id="v-pills-outbox" role="tabpanel" aria-labelledby="v-pills-outbox-tab">
                    <table class="table table-hover" id="table">
                        <thead>
                        <tr class="table-primary">
                            <th scope="col">#</th>
                            <th scope="col">Date created</th>
                            <th scope="col">Recipient</th>
                            <th scope="col">Report name</th>
                        </tr>
                        </thead>
                        <tbody id="table-outbox">
                        <tr onclick="modal_view(0)">
                            <th scope="row">1</th>
                            <td>2018-08-13 14:32:09</td>
                            <td>SQL injection</td>
                            <td>This is dangerous vulnerable f... (continue)</td>
                        </tr>
                        </tbody>
                    </table>
                    <nav>
                        <ul id="pagination-outbox" class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="tab-pane fade" id="v-pills-draft" role="tabpanel" aria-labelledby="v-pills-outbox-draft">...</div>
            </div>
        </div>
    </div>


</div>

<!-- Large modal -->
<div id="report-modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="report-name">Large modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
<!--                THIS IS MODAL BODY-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="row mt-1 mb-1 form-group">
                            <div class="col-md-2">
                                <label class="col-form-label">Reported by </label>
                            </div>
                            <div class="col-md-10">
                                <input id="report-author" class="form-control" type="text"
                                       autocomplete="off" disabled/>
                            </div>
                        </div>
                        <div class="row mt-1 mb-1 form-group">
                            <div class="col-md-2">
                                <label class="col-form-label">Target </label>
                            </div>
                            <div class="col-md-10">
                                <input id="report-target" class="form-control" type="text"
                                       autocomplete="off" disabled/>
                            </div>
                        </div>
                        <div class="row mt-1 mb-1 form-group">
                            <div class="col-md-2">
                                <label class="col-form-label">Recipient </label>
                            </div>
                            <div class="col-md-10">
                                <input id="report-recipient" class="form-control" type="text"
                                       autocomplete="off" disabled/>
                            </div>
                        </div>

                        <hr>
                        <div id="vul-list-area">
                            <div class="border border-primary rounded p-4 mb-4">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="col-form-label">Vulnerable</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text"
                                                       autocomplete="off" disabled/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label class="col-form-label">Risk level</label>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="row">
                                                    <i id="star-0-0" class="fa fa-star-o fa-2x"></i>
                                                    <i id="star-0-1" class="fa fa-star-o fa-2x"></i>
                                                    <i id="star-0-2" class="fa fa-star-o fa-2x"></i>
                                                    <i id="star-0-3" class="fa fa-star-o fa-2x"></i>
                                                    <i id="star-0-4" class="fa fa-star-o fa-2x"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <label class="col-form-label">Description</label>
                                    <textarea id="vul-desc-0" class="form-control" disabled></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="action-button" type="button" class="btn btn-danger">Delete</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    function create_star(num) {
        var colored = `<i id="star-0-0" class="fa fa-star-o fa-2x text-warning"></i>`;
        var nomarl = `<i id="star-0-0" class="fa fa-star-o fa-2x"></i>`
        var result = ``;
        for(var i=1; i<=5; i++) {
            if(i<=num) result += colored;
            else result += nomarl;
        }
        return result;
    }

    function delete_relation(type, report_id) {
        // alert('ldskjf');
        $.ajax({
            type: "GET",
            url: "/home?action=delete",
            data: {'id': report_id, 'type': `${type}`},
            success: function (response) {
                alert(response);
                location.reload();
            }
        });
    }

    function modal_view(type, id) {
        $.ajax({
            type: "GET",
            url: "/home?action=read_"+type,
            data: {'id': id},
            success: function (response) {
                console.log(response);
                $('#report-name').html(response.report_name);
                $('#report-author').val(response.report_author);
                $('#report-target').val(response.report_target);
                $('#report-recipient').val(response.report_recipient);
                $('#vul-list-area').html(``);


                $(response.vulnerable).each(function (index, element) {
                    $('#vul-list-area').append(`
                    <div class="border border-primary rounded p-4 mb-4">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="col-form-label">Vulnerable</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input id="name-${index}" class="form-control" type="text"
                                                       autocomplete="off" disabled/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label class="col-form-label">Risk level</label>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="row">
                                                ${create_star(element.level)}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <label class="col-form-label">Description</label>
                                    <textarea id="description-${index}" class="form-control" disabled></textarea>
                                </div>
                            </div>
                    `);
                    $('#description-'+index).val(element.description);
                    $('#name-'+index).val(element.name);
                    $('#action-button').attr('onclick', `delete_relation('${type}', ${response.report_id})`);
                });
            }
        });
        $('#report-modal').modal('show');
    }
    
    function show_data(type, page) {
        $.ajax({
            type: "GET",
            url: "/home?action="+type,
            data: {'page':page},
            success: function (response) {
                console.log(response);
                $('#table-'+type).html('');
                $('#pagination-'+type).html('');

                $(response.reports).each(function (index, element) {
                    var color='';
                    console.log(element);
                    if(element.status === 'RECIVED'){
                        color=`class="table-secondary"`
                    }
                    $('#table-'+type).append(`<tr ${color} onclick="modal_view('${type}', ${element.id})">
                            <th scope="row">${page*10 + index+1}</th>
                            <td>${element.date_created}</td>
                            <td>${element.user}</td>
                            <td>${element.name}</td>
                        </tr>`);
                });
                if(page+1==1) {
                    $('#pagination-'+type).append(`<li class="page-item disabled">
                                <a class="page-link" tabindex="-1">Previous</a>
                            </li>`);
                }
                else {
                    $('#pagination-'+type).append(`<li class="page-item">
                                <a class="page-link" onclick="show_data('${type}',${page-1})" tabindex="-1">Previous</a>
                            </li>`);
                }
                for(var i=1; i<= response.total_pages; i++) {
                    if(page+1 === i) {
                        $('#pagination-'+type).append(` <li class="page-item active"><a class="page-link" onclick="show_data('${type}',${i-1})">${i}</a></li>`);
                    }
                    else {
                        $('#pagination-'+type).append(` <li class="page-item"><a class="page-link" onclick="show_data('${type}',${i-1})">${i}</a></li>`);
                    }
                }
                if(page+1==response.total_pages) {
                    $('#pagination-'+type).append(`<li class="page-item disabled">
                                <a class="page-link" tabindex="-1">Next</a>
                            </li>`);
                }
                else {
                    $('#pagination-'+type).append(`<li class="page-item">
                                <a class="page-link" onclick="show_data('${type}',${page+1})" tabindex="-1">Next</a>
                            </li>`);
                }
            }
        });
    }
    $('#v-pills-inbox-tab').tab('show');
    $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
        var tab_type = e.target.id.split('-')[2];
        console.log(tab_type);

        show_data(tab_type, 0);
    });
</script>
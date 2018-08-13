<script>
    var template_list = [];
    <?php
    foreach ($this->data as $element) {
    ?>
    template_list.push({
        id: "<?php echo $element->id ?>",
        name: "<?php echo $element->name ?>",
        description: "<?php echo $element->description?>"
    });
    <?php } ?>


    function set_modal_value(title, id, name, description, button) {
        $("#modal_title").text(title);
        $('input[name="id"]').val(id);
        $('input[name="action"]').val(button.toLowerCase());
        $("#vul_name").val(name);
        $("#vul_description").val(description);
        $('button[name="action"]').html(button);
    }

    function modal_create() {
        set_modal_value("Create new template", "*", "", "", "Create");
        $('#templateModal').modal('show');
    }

    function modal_update(index) {
        template = template_list[index];
        set_modal_value("Update template", template.id, template.name, template.description, "Update");
        $('#templateModal').modal('show');
    }

    // Variable to hold request
    var request;

    function send_data() {
        // setup some local variables
        var $form = $('form');

        // Let's select and cache all the fields
        var $inputs = $form.find("input, textarea");

        // Serialize the data in the form
        var serializedData = $form.serialize();
        console.log(serializedData);


        $.ajax({
            type: "POST",
            url: "/template?action=update",
            data: serializedData,
            success: function (data) {
                if (data == 'success') {
                    $('#response').html('<i class="fa fa-check"></i> Done');
                    $('#response').attr('class', 'text-success');
                    $("#templateModal").on("hidden.bs.modal", function () {
                        location.reload();
                    });
                }
                else {
                    $('#response').attr('class', 'text-danger');
                    $('#response').html('<i class="fa fa-close"></i> ' + data);
                    $("#templateModal").on("hidden.bs.modal", function () {
                        $('#response').html("");
                    });
                }
            }
        });
    }
</script>

<div class="container">
    <!--vertical align on parent using my-auto-->
    <div class="row h-100">
        <div class="col-sm-12">
            <div class="container">
                <div class="row pt-3">
                    <div class="col-md-3"></div>
                    <div class="col-md-6 text-center">
                        <h2>Your template</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" onclick="modal_create()">
                            Create new template
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="templateModal" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal_title">Create new template</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Vulnerable
                                                    name:</label>
                                                <input type="text" autocomplete="off" name="name" class="form-control"
                                                       id="vul_name" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="col-form-label">Description:</label>
                                                <textarea name="description" class="form-control" id="vul_description">2342</textarea>
                                            </div>
                                            <input type="hidden" name="id" value=""/>
                                            <input type="hidden" name="action" value=""/>
                                            <div id="response" class="text-danger">
                                                <!--                                                <i class="fa fa-close"></i>-->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" name="close" class="btn btn-secondary"
                                                        data-dismiss="modal">Close
                                                </button>
                                                <button onclick="send_data()" type="button" name="action"
                                                        class="btn btn-primary">Create
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10 text-center">
                        <table class="table table-hover" id="table">
                            <thead>
                            <tr class="table-primary">
                                <th scope="col">#</th>
                                <th scope="col">Date modified</th>
                                <th scope="col">Vulnerable name</th>
                                <th scope="col">Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $counter = $this->current_page * 10;
                            $cnt = 0;
                            foreach ($this->data as $element) {
                                $counter += 1;
                                $name = $element->name;
                                if (strlen($name) > 20) $name = substr($name, 0, 20) . "... (continue)";

                                $desc = $element->description;
                                if (strlen($desc) > 30) $desc = substr($desc, 0, 30) . "... (continue)";
                                ?>
                                <tr onclick="modal_update(<?php echo $cnt++ ?>)">
                                    <th scope="row"><?php echo $counter ?></th>
                                    <td><?php echo $element->date_modified ?></td>
                                    <td><?php echo htmlspecialchars($name, ENT_QUOTES) ?></td>
                                    <td><?php echo htmlspecialchars($desc, ENT_QUOTES) ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10 text-center">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <li class="page-item <?php if ($this->current_page - 1 < 0) echo 'disabled' ?>">
                                    <a class="page-link" href="/template?page=<?php echo $this->current_page - 1 ?>"
                                       tabindex="-1">Previous</a>
                                </li>
                                <?php for ($i = 0; $i <= $this->max_page; $i++) { ?>
                                    <li class="page-item <?php if ($this->current_page === $i) echo 'active' ?>"><a
                                                class="page-link"
                                                href="/template?page=<?php echo $i ?>"><?php echo $i + 1 ?></a></li>
                                <?php } ?>
                                <li class="page-item <?php if ($this->current_page + 1 > $this->max_page) echo 'disabled' ?>">
                                    <a class="page-link"
                                       href="/template?page=<?php echo $this->current_page + 1 ?>">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
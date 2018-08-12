<div class="container">
    <!--vertical align on parent using my-auto-->
    <div class="row h-100">
        <div class="col-sm-12">
            <div class="container">
                <div class="row pt-3">
                    <div class="col-md-3"></div>
                    <div class="col-md-6 text-center">
                        <h2>All account in this system</h2>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10 text-center">
                        <table class="table table-hover ">
                            <thead>
                            <tr class="table-primary">
                                <th scope="col">#</th>
                                <th scope="col">Date modified</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $counter = $this->current_page * 10;
                            foreach ($this->data as $element) {
                                $counter += 1;
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $counter ?></th>
                                    <td><?php echo $element->date_modified ?></td>
                                    <td>
                                        <a href="/profile?action=update&id=<?php echo $element->id ?>"><?php echo $element->username ?></a>
                                    </td>
                                    <td><?php echo $element->email ?></td>
                                    <td><?php echo $element->roles ?></td>
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
                                    <a class="page-link" href="/account?page=<?php echo $this->current_page - 1 ?>"
                                       tabindex="-1">Previous</a>
                                </li>
                                <?php for ($i = 0; $i <= $this->max_page; $i++) { ?>
                                    <li class="page-item <?php if ($this->current_page === $i) echo 'active' ?>"><a
                                                class="page-link"
                                                href="/account?page=<?php echo $i ?>"><?php echo $i + 1 ?></a></li>
                                <?php } ?>
                                <li class="page-item <?php if ($this->current_page + 1 > $this->max_page) echo 'disabled' ?>">
                                    <a class="page-link"
                                       href="/account?page=<?php echo $this->current_page + 1 ?>">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
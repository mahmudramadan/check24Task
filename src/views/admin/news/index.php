<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<main role="main">
    <div class="container">
        <div class="row">
            <h1 style="margin: auto;text-align: center">All News</h1>
            <div class="clearfix"></div>
            <div class="col-lg-12">
                <!-- Button to Open the Modal -->
                <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                    add news
                </a>
            </div>
            <hr>
            <br>
            <div class="col-lg-12" id="form-result">
            </div>
            <br>
            <div class="col-lg-12">

                <table class="table table-border table-hover">
                    <thead>
                    <tr>
                        <th>serial</th>
                        <th>title</th>
                        <th>author</th>
                        <th>status</th>
                        <th>created at</th>
                        <th>operation</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (count($data['News']) > 0) {
                        foreach ($data['News'] as $key => $newsItem) {
                            ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?= $newsItem->getTitle(); ?></td>
                                <td><?= $newsItem->getAuthor(); ?></td>
                                <td><?= $newsItem->isActive() ? "<span style='color:green'>Active</span>" : "<span style='color:red'>Un Active</span>"; ?></td>
                                <td><?= $newsItem->getCreatedAt(); ?></td>
                                <td>
                                    <button type="button" class="btn btn-danger delete-btn"
                                            new-id="<?= $newsItem->getId() ?>">delete
                                    </button>
                                </td>
                            </tr>
                        <?php }
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <hr>

    </div> <!-- /container -->


    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add News Item</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form class="was-validated" id="news-form">
                        <div class="form-group">
                            <label for="uname">News Title:</label>
                            <input type="text" class="form-control" id="title" placeholder="Enter username" name="title"
                                   required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-group">
                            <label for="uname">Active Status:</label>
                            <select class="form-control" id="active" placeholder="Enter status" name="active"
                                    required>
                                <option value="1">Active</option>
                                <option value="0">Un Active</option>
                            </select>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-group">
                            <label for="uname">Author:</label>
                            <select class="form-control" id="author" placeholder="Enter Author" name="author"
                                    required>
                                <?php
                                if (count($data['allAuthers']) > 0) {
                                    foreach ($data['allAuthers'] as $auther) {
                                        echo "<option value='" . $auther->getName() . "'>" . $auther->getName() . "</option>";
                                    }
                                }
                                ?>
                            </select>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-group">
                            <label for="uname">News Description:</label>
                            <textarea type="text" class="form-control" id="description" placeholder="Enter description"
                                      name="description"
                                      required></textarea>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>


                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
</main>
<script>
    $(document).ready(function () {
        $("#news-form").submit(function () {
            var formData = $(this).serialize();
            $.ajax({
                method: "post",
                data: formData,
                url: "/add-news-item/",
                dataType: "json",
                success: function (response) {
                    if (response.success == true) {
                        $(".close").click()
                        $("#form-result").html("<div class='alert alert-success'> " + response.message + "</div>");
                    } else {
                        $("#form-result").html("<div class='alert alert-danger'>" + response.message + "</div>")
                    }
                    window.setTimeout(function () {
                        $("#form-result").html("");
                        window.location.href = "/admin-page";
                    }, 5000);
                }
            })
            return false;
        });


        $(document).on('click', '.delete-btn', function (e) {
            e.preventDefault();
            var btn = $(this);
            btn.attr("disabled", "disabled");
            var newsId = btn.attr("new-id");
            $.ajax({
                method: "delete",
                url: "/delete-news-item/" + newsId,
                dataType: "json",
                success: function (response) {
                    if (response.success == true) {
                        $("#form-result").html("<div class='alert alert-success'> " + response.message + "</div>");
                        btn.closest("tr").remove();
                    } else {
                        $("#form-result").html("<div class='alert alert-danger'>" + response.message + "</div>")
                    }
                    window.setTimeout(function () {
                        $("#form-result").html("");
                    }, 10000);
                }
            })
            return false;
        });
    });
</script>
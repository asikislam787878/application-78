<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="ajax.css">

    <title>Document</title>
</head>

<body>
    <div class="container-fluid">
        <div class="center_div">

            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <div class="container-fluid">
                    <h1 class="navbar-brand">PHP & AJAX </h1>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse p-3" id="navbarSupportedContent">
                        <form class="d-flex myfrom text-white">
                            <input class="form-control me-2" id="i_search" type="search" placeholder="Search"
                                aria-label="Search">
                            <!-- <button class="btn btn-outline-light" type="submit" id="search_btn">Search</button> -->
                        </form>
                    </div>
                </div>
            </nav>

            <!-- from session start -->
            <div class="form_div">
                <form id="addfrom" action="">
                    <div class="d-flex">
                        <label class="mx-3" for="fristName">Frist Name : </label>
                        <input class="form-control inla" style="width:20%;" id="fname" type="text" name="fname">

                        <label class="mx-3" for="lastName">Last Name : </label>
                        <input class="form-control" style="width:20%;" id="lname" type="text" name="lname">

                        <button style="margin-left:15px;" type="submit" id="submit_btn"
                            class="btn btn-primary btn-sm px-4 py-1">Saves</button>
                    </div>

                    <div class="invalid-feedback" id="error_massages"
                        style="text-align:center; font-size:20px; padding:10px; font-weight:bolder;">
                    </div>
                    <div id="success_massages"
                        style="text-align:center; font-size:20px; padding:10px; font-weight:bolder; color:white;"></div>
                </form>
            </div>


            <!-- Edit form creting -->
            <div id="id01" class="modal">
                <span onclick="document.getElementById('id01').style.display='none'" class="close"
                    title="Close Modal">&times;</span>
                <form class="modal-content" action="/action_page.php">


                </form>
            </div>



            <!-- Table session start -->
            <div class=" table_session">
                <div class="table_center">
                    <table style="width:90%; margin: 0 auto;">
                        <tr>
                            <td>
                                <!-- <button type="submit" id="load_data"
                                    class="btn btn-outline-primary m-3 w-50 text-center">Show
                                    Data</button> -->
                            </td>
                        </tr>
                        <tr>
                            <td>

                            </td>
                        </tr>

                        <tr>
                            <td id="show_data">

                            </td>
                        </tr>
                    </table>
                </div>
            </div>


        </div>
    </div>

    <!-- javascript cone start -->
    <script src="../js/jquery-3.6.1.js"></script>

    <script>
    $(document).ready(function() {

        function student() {
            $.ajax({
                type: "POST",
                url: "show_data.php",
                // data: "data",
                // dataType: "dataType",
                success: function(data) {
                    $("#show_data").html(data);
                }
            });
        }
        student();

        // Insert Data creating....................................

        $("#submit_btn").on('click', function(e) {
            e.preventDefault();

            var firstName = $("#fname").val();
            var lastName = $("#lname").val();

            // Data validation.............
            if (firstName === '' || lastName === '') {
                $("#error_massages").html("Plaze Fill The Option!").slideDown();
                $("#success_massages").slideUp();
            } else {
                $.ajax({
                    type: "POST",
                    url: "Insert_data.php",
                    data: {
                        first_name: firstName,
                        last_name: lastName
                    },
                    // dataType: "dataType",
                    success: function(response) {
                        if (response == 1) {
                            // Data validation
                            $("#success_massages").html("Data Insert Successfully")
                                .slideDown();
                            $("#error_massages").slideUp();

                            student(); // show data

                            $("#addfrom").trigger('reset'); // Form reset
                        } else {
                            alert('Recode Not Found!');
                        }
                    }
                });
            }

        });

        // Delete Data creating.............................
        $(document).on("click", ".delete_btn", function() {

            if (confirm("Do you really wont delete thid recode!")) {
                var deleteId = $(this).data("id");
                var element = this;

                $.ajax({
                    type: "POST",
                    url: "ajax_delete.php",
                    data: {
                        id: deleteId
                    },
                    // dataType: "dataType",
                    success: function(response) {
                        if (response == 1) {
                            $(element).closest("tr").fadeOut();
                        } else {
                            $("#error_massages").html("Data Deleted Not Found!")
                                .slideDown();
                            $("#success_massages").slideUp();
                        }
                    }
                });
            }


        });

        // Edit Data ...........................................
        $(document).on("click", ".edit_btn", function(e) {
            $("#id01").show();
            var editId = $(this).data('eid');

            $.ajax({
                type: "POST",
                url: "edit_load.php",
                data: {
                    eid: editId
                },
                // dataType: "dataType",
                success: function(response) {
                    $(".modal-content").html(response);
                }
            });

            $(document).on("click", "#update_btn", function(e) {
                e.preventDefault();

                var edit_id = $("#edit_id").val();
                var edit_firstName = $("#edit_fname").val();
                var edit_lastName = $("#edit_lname").val();

                $.ajax({
                    type: "POST",
                    url: "update.php",
                    data: {
                        e_id: edit_id,
                        e_fname: edit_firstName,
                        e_lname: edit_lastName
                    },
                    // dataType: "dataType",
                    success: function(response) {
                        if (response == 1) {
                            $("#id01").hide();
                            student();
                        } else {
                            alert("Your Data Not Updated!!!");
                        }
                    }
                });

            });

        });

        // search set ......................................
        $("#i_search").on('keyup', function() {
            var searchId = $(this).val();

            $.ajax({
                type: "POST",
                url: "search.php",
                data: {
                    search: searchId
                },
                // dataType: "dataType",
                success: function(response) {
                    $("#show_data").html(response);
                }
            });
        });


    });
    </script>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"> -->
    </script>
</body>

</html>
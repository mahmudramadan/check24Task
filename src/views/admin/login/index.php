<main role="main">
    <div class="container">
        <div class="row">
            <h1 style="margin: auto;text-align: center">Login page</h1>
        </div>
        <form class="form-signin">
            <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72"
                 height="72">
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
            <button class="btn btn-lg btn-primary btn-block" id="submitButton" type="submit">Sign in</button>

            <div id="form-error"></div>
        </form>
    </div> <!-- /container -->
</main>
<script>
    $(document).ready(function () {
        $(".form-signin").submit(function () {
            $("#submitButton").attr("disabled","disabled");
            var email = $("#inputEmail").val();
            var password = $("#inputPassword").val();
            if (email.length < 8 || password < 6){
                $("#form-error").html("<div class='alert alert-danger'>Please Fill all data correct</div>")
                return false;
            }
            $.ajax({
                method: "POST",
                url:"/login-user",
                data:{
                    email:email,
                    password:password,
                },
                dataType: "json",
                success: function (response) {
                     if (response.success == true) {
                        $("#form-error").html("<div class='alert alert-success'>Login user successfully</div>");
                         window.setTimeout(function(){
                             window.location.href = "/admin-page";
                         }, 3000);
                      }else{
                         $("#submitButton").removeAttribute("disabled");
                         $("#form-error").html("<div class='alert alert-danger'>"+response.message+"</div>")
                    }
                }
            })
            return false;
        });
    });
</script>
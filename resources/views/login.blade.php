<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<h2>Login</h2>

<!-- Success Message -->
@if(session('success'))
    <p style="color: green;">
        {{ session('success') }}
    </p>
@endif

<!-- Error Message (general) -->
<div id="errorMsg" style="color:red;"></div>

<form id="loginForm">
    @csrf

    <input type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
    <p style="color:red;" id="emailError"></p>
    <br>

    <input type="password" name="password" id="password" placeholder="Password">
    <p style="color:red;" id="passwordError"></p>
    <br>

    <button type="submit">Login</button>
</form>

<!-- AJAX SCRIPT -->
<script>
$(document).ready(function () {

    $('#loginForm').submit(function (e) {
        e.preventDefault();

        // Clear previous errors
        $('#errorMsg').text('');
        $('#emailError').text('');
        $('#passwordError').text('');

        $.ajax({
            url: "/login",
            type: "POST",
            data: $(this).serialize(),

            success: function (response) {
                // Redirect after login
                window.location.href = response.redirect;
            },

            error: function (xhr) {

                // Validation errors (422)
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;

                    if (errors.email) {
                        $('#emailError').text(errors.email[0]);
                    }

                    if (errors.password) {
                        $('#passwordError').text(errors.password[0]);
                    }
                }

                // Invalid credentials (401)
                if (xhr.status === 401) {
                    $('#errorMsg').text(xhr.responseJSON.error);
                }
            }
        });

    });

});
</script>

</body>
</html>
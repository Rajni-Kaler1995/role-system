<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<h2>Register</h2>

<!-- Success Message -->
<div id="successMsg" style="color: green;"></div>

<!-- Global Error -->
<div id="errorMsg" style="color:red;"></div>

<form id="registerForm">
    @csrf

    <input type="text" name="first_name" id="first_name" placeholder="First Name">
    <p style="color:red;" id="first_name_error"></p>
    <br>

    <input type="text" name="last_name" id="last_name" placeholder="Last Name">
    <p style="color:red;" id="last_name_error"></p>
    <br>

    <input type="email" name="email" id="email" placeholder="Email">
    <p style="color:red;" id="email_error"></p>
    <br>

    <input type="password" name="password" id="password" placeholder="Password">
    <p style="color:red;" id="password_error"></p>
    <br>

    <select name="role_id" id="role_id">
        <option value="">Select Role</option>
        <option value="1">Employee</option>
        <option value="2">Dealer</option>
    </select>
    <p style="color:red;" id="role_id_error"></p>
    <br>

    <!-- Dealer Fields (Hidden Initially) -->
    <div id="dealerFields" style="display:none;">
        <input type="text" name="city" id="city" placeholder="City">
        <p style="color:red;" id="city_error"></p>
        <br>

        <input type="text" name="state" id="state" placeholder="State">
        <p style="color:red;" id="state_error"></p>
        <br>

        <input type="text" name="zip" id="zip" placeholder="Zip">
        <p style="color:red;" id="zip_error"></p>
        <br>
    </div>

    <button type="submit">Register</button>
</form>

<script>
$(document).ready(function () {

    // Show/Hide dealer fields
    $('#role_id').change(function () {
        if ($(this).val() == '2') {
            $('#dealerFields').show();
        } else {
            $('#dealerFields').hide();
        }
    });

    // Submit form via AJAX
    $('#registerForm').submit(function (e) {
        e.preventDefault();

        // Clear previous errors
        $('#errorMsg').text('');
        $('#successMsg').text('');
        $('p[id$="_error"]').text('');

        $.ajax({
            url: "/register",
            type: "POST",
            data: $(this).serialize(),

            success: function (response) {
                $('#successMsg').text(response.message);

                // Redirect to login after success
                setTimeout(function () {
                    window.location.href = "/login";
                }, 1500);
            },

            error: function (xhr) {

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;

                    // Clear previous errors
                    $('p[id$="_error"]').text('');

                    // Loop and show errors
                    $.each(errors, function(key, value) {
                        $('#' + key + '_error').text(value[0]);
                    });
                }
            }
        });

    });

});
</script>

</body>
</html>
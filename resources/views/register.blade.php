<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Register</h2>

<form method="POST" action="/register">
    @csrf

    <input type="text" name="first_name" placeholder="First Name"><br><br>
    @error('first_name')
        <p style="color:red;">{{ $message }}</p>
    @enderror
    <input type="text" name="last_name" placeholder="Last Name"><br><br>
    @error('first_name')
        <p style="color:red;">{{ $message }}</p>
    @enderror
    <input type="email" name="email" placeholder="Email"><br><br>
    @error('last_name')
        <p style="color:red;">{{ $message }}</p>
    @enderror
    <input type="password" name="password" placeholder="Password"><br><br>
    @error('password')
        <p style="color:red;">{{ $message }}</p>
    @enderror
    <select name="role_id">
        <option value="1">Employee</option>
        <option value="2">Dealer</option>
    </select><br><br>
    

    <!-- Dealer fields -->
    <input type="text" name="city" placeholder="City"><br><br>
    @error('city')
        <p style="color:red;">{{ $message }}</p>
    @enderror

    <input type="text" name="state" placeholder="State"><br><br>
    @error('state')
        <p style="color:red;">{{ $message }}</p>
    @enderror
    <input type="text" name="zip" placeholder="Zip"><br><br>
    @error('zip')
        <p style="color:red;">{{ $message }}</p>
    @enderror

    <button type="submit">Register</button>
</form>

</body>
</html>
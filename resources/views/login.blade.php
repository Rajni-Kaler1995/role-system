<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>
@if(session('success'))
    <p style="color: green;">
        {{ session('success') }}
    </p>
@endif
<form method="POST" action="/login">
    @csrf

    <input type="email" name="email" placeholder="Email"><br><br>
    @error('email')
        <p style="color:red;">{{ $message }}</p>
    @enderror
    <input type="password" name="password" placeholder="Password"><br><br>
    @error('password')
        <p style="color:red;">{{ $message }}</p>
    @enderror
    <button type="submit">Login</button>
</form>

</body>
</html>
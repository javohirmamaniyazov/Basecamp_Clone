<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  <title>Login</title>
</head>
<body>
  <div class="container">
    <div class="logo">
      <img src="images/basecamp.png" width="35px" height="135px" alt="Basecamp Logo">
    </div>
    <h2 style="margin-left: 42%">Login</h2>
    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div>
        <label for="email" class="label">Email</label>
        <input id="email" class="form-input" type="email" name="email" required autofocus>
        @error('email')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>
      <div>
        <label for="password" class="label">Password</label>
        <input id="password" class="form-input" type="password" name="password" required>
        @error('password')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>
      <div class="checkbox-label">
        <input id="remember_me" type="checkbox" name="remember">
        <label for="remember_me">Remember me</label>
      </div>
      <div>
        <button type="submit" class="submit-button">Log in</button>
      </div>
    </form>
    <div class="register-link">
      Don't have an account? <a href="{{ route('register') }}">Register</a>
    </div>
  </div>
</body>
</html>

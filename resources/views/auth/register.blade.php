<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Basecamp</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>

<body>
    <div class="container">

        <div class="register-form">
            <div class="logo">
                <img src="images/basecamp.png" height="120px" width="120px"
                    alt="Basecamp Logo">
            </div>
            <h2 class="register" style="margin-left: 38%;">Register</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input id="name" class="form-input" type="text" name="name" value="{{ old('name') }}"
                        required autofocus autocomplete="name" />
                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}"
                        required autocomplete="username" />
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" class="form-input" type="password" name="password" required
                        autocomplete="new-password" />
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input id="password_confirmation" class="form-input" type="password" name="password_confirmation"
                        required autocomplete="new-password" />
                    @error('password_confirmation')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="submit-button">Register</button>
                </div>
            </form>

            <div class="login-link">
                <span>Already registered?</span>
                <a href="{{ route('login') }}" class="underline">Login</a>
            </div>
        </div>
    </div>
</body>

</html>

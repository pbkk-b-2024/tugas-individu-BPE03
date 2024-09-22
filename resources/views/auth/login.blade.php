<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Eshopper</title>
    <!-- Add Bootstrap and any necessary CSS -->
    <link href="/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Add your template's navigation bar here -->
    <script>
        function validatePassword() {
            var password = document.getElementById('password').value;
            if (password.length < 8) {
                alert("Password must be at least 8 characters long.");
                return false; // Prevents form submission
                }
            
            return true; // Form can be submitted if password is valid
        }
    </script>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Login to Your Account</h4>
                    </div>
                    <div class="card-body">
                        <form onsubmit="return validatePassword()" action="{{ route('login.create') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <p>Don't have an account? <a href="{{ route('register.show') }}">Register</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add your template's footer here -->
</body>
</html>

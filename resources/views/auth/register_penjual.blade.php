<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Eshopper</title>
    <!-- Add Bootstrap and any necessary CSS -->
    <link href="/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Add your template's navigation bar here -->
    <script>
        function validatePassword() {
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirm_password').value;
            if (password.length < 8) {
                alert("Password must be at least 8 characters long.");
                return false; // Prevents form submission
                }
            if (password !== confirmPassword) {
                alert("Passwords do not match.");
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
                        <h4>Create a new seller account</h4>
                    </div>
                    <div class="card-body">
                        <form onsubmit="return validatePassword()" action="{{ route('register.create_penjual') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="password_confirmation" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
                        <p>Want to register as buyer? <a href="{{ route('register.show') }}">Register as buyer</a></p>
                        <button type="button" class="btn btn-secondary btn-block" onclick="window.location.href='{{ url('/') }}'">Return to Dashboard</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

@extends ('layouts.master')

@section('content')
    <div class="content-wrapper">

        <div class="register-container">
            <form method="POST" action="{{ route('register') }}" class="register-form">
                @csrf
                <div class="register-title">Join SquareBinge</div>
                <div>
                    <label for="username"><b>Username</b></label>
                    <input id="name" type="text" name="name" required>
                </div>
                <div>
                    <label for="email"><b>Email</b></label>
                    <input id="email" type="email" name="email" required>
                </div>
                <div>
                    <label for="psw"><b>Password</b></label>
                    <input id="password" type="password" name="password" required>
                </div>
                <div>
                    <label for="psw-repeat"><b>Repeat Password</b></label>
                    <input id="password-confirm" type="password" name="password_confirmation" required>
                </div>
                <button type="submit" class="register-button">Register</button>

                <div class="register-login">
                    Already have an account? <a href="#log-in" onclick="openLogin()">Sign in</a>.
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".header-links").find(".active").removeClass("active");
            $(".header-links a:contains('Register')").addClass('active');
        });
    </script>
@endsection

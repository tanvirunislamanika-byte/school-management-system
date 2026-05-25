<!DOCTYPE html>
<html lang="en">

@php
    $lang = Session::get('language');
@endphp

@if($lang && $lang->is_rtl)
<html lang="en" dir="rtl">
@else
<html lang="en" dir="ltr">
@endif

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/home_page/css/style.css') }}" rel="stylesheet">

    <title>{{ __('login') }} || {{ config('app.name') }}</title>

    @include('layouts.include')

    <style>
        :root {
            --primary-color: {{ $systemSettings['theme_primary_color'] ?? '#56cc99' }};
            --secondary-color: {{ $systemSettings['theme_secondary_color'] ?? '#215679' }};
            --primary-background-color: {{ $systemSettings['theme_primary_background_color'] ?? '#f2f5f7' }};
        }

        body {
            background: var(--primary-background-color);
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 80rem;
            margin: auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 380px;
        }

        /* LEFT SIDE - FORM */
        .left-form {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 25px;
            background: #fff;
        }

        .login-form-wrapper {
            width: 100%;
            max-width: 320px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-header img {
            width: 100px;
            margin-bottom: 12px;
        }

        .login-header h2 {
            font-size: 20px;
            font-weight: 700;
            color: #333;
            margin-bottom: 6px;
        }

        .login-header p {
            color: #999;
            font-size: 12px;
        }

        /* RIGHT SIDE - LOGO */
        .right-banner {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 30px 25px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .right-banner::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -100px;
            right: -100px;
        }

        .right-banner::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            bottom: -50px;
            left: -50px;
        }

        .right-banner-content {
            position: relative;
            z-index: 2;
        }

        .right-banner img {
            width: 160px;
            margin-bottom: 15px;
            filter: brightness(0) invert(1);
        }

        .right-banner h3 {
            color: #fff;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .right-banner p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 13px;
            line-height: 1.5;
        }

        /* DEMO CREDENTIALS */
        .demo-credentials {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            padding: 20px;
            margin-top: 30px;
            border: 1px solid rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
        }

        .demo-credentials-title {
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 15px;
            text-align: left;
        }

        .demo-credential-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(0, 0, 0, 0.1);
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .demo-credential-item:hover {
            background: rgba(0, 0, 0, 0.2);
            transform: translateX(-5px);
        }

        .demo-credential-item:last-child {
            margin-bottom: 0;
        }

        .demo-credential-label {
            color: rgba(255, 255, 255, 0.8);
            font-size: 12px;
            flex: 1;
        }

        .demo-credential-value {
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            margin: 0 10px;
        }

        .copy-btn {
            background: rgba(255, 255, 255, 0.25);
            border: none;
            color: #fff;
            width: 32px;
            height: 32px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .copy-btn:hover {
            background: rgba(255, 255, 255, 0.4);
            transform: scale(1.1);
        }

        .copy-btn.copied {
            background: #4caf50;
        }

        /* DEMO CREDENTIALS ON LEFT SIDE */
        .demo-credentials-form {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 14px;
            margin-top: 18px;
            border: 1.5px solid #e9ecef;
        }

        .demo-credentials-form .demo-credentials-title {
            color: #333;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 10px;
            text-align: left;
        }

        .demo-credential-item-light {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #fff;
            padding: 8px 12px;
            border-radius: 6px;
            margin-bottom: 7px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid #e0e0e0;
        }

        .demo-credential-item-light:hover {
            background: #f5f5f5;
            border-color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .demo-credential-item-light:last-child {
            margin-bottom: 0;
        }

        .demo-credential-label-light {
            color: #666;
            font-size: 12px;
            font-weight: 600;
            flex: 1;
        }

        .demo-credential-value-light {
            color: var(--primary-color);
            font-size: 12px;
            font-weight: 600;
            margin: 0 10px;
        }

        .copy-btn-light {
            background: var(--primary-color);
            border: none;
            color: #fff;
            width: 32px;
            height: 32px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .copy-btn-light:hover {
            background: var(--secondary-color);
            transform: scale(1.1);
        }

        .copy-btn-light.copied {
            background: #4caf50;
        }

        /* AVATAR CONTAINER */
        .avatar-container {
            margin-top: 15px;
            max-width: 200px;
            margin-left: auto;
            margin-right: auto;
            animation: float 3s ease-in-out infinite;
        }

        .avatar-illustration {
            width: 100%;
            height: auto;
            filter: drop-shadow(0 10px 30px rgba(0, 0, 0, 0.2));
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        /* FORM ELEMENTS */
        .form-group {
            margin-bottom: 14px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #333;
            margin-bottom: 6px;
        }

        .form-control {
            height: 40px;
            border: 1.5px solid #e0e0e0;
            border-radius: 6px;
            padding: 8px 12px;
            font-size: 13px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(86, 204, 153, 0.1);
            outline: none;
        }

        .input-group {
            display: flex;
            position: relative;
        }

        .input-group .form-control {
            flex: 1;
            border-right: none;
            border-radius: 6px 0 0 6px;
        }

        .input-group-text {
            background: #f5f5f5;
            border: 1.5px solid #e0e0e0;
            border-left: none;
            border-radius: 0 6px 6px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            cursor: pointer;
            color: #666;
            transition: all 0.3s ease;
        }

        .input-group:focus-within .input-group-text {
            border-color: var(--primary-color);
            background: rgba(86, 204, 153, 0.05);
            color: var(--primary-color);
        }

        /* CHECKBOX & LINKS */
        .form-check {
            display: flex;
            align-items: center;
            font-size: 13px;
            color: #666;
            margin-top: 10px;
        }

        .form-check-input {
            width: 16px;
            height: 16px;
            margin-right: 6px;
            margin-top: 0;
            cursor: pointer;
            border-radius: 4px;
            border: 1.5px solid #ddd;
            accent-color: var(--primary-color);
        }

        .forgot-password-link {
            text-align: right;
            margin-top: 10px;
        }

        .forgot-password-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .forgot-password-link a:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }

        /* SUBMIT BUTTON */
        .btn-login {
            width: 100%;
            height: 40px;
            background: var(--primary-color);
            border: none;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 14px;
        }

        .btn-login:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(86, 204, 153, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* ERROR MESSAGE */
        .alert {
            border-radius: 6px;
            border: none;
            padding: 12px 15px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        /* MOBILE RESPONSIVE */
        @media (max-width: 768px) {
            .login-container {
                grid-template-columns: 1fr;
                min-height: auto;
            }

            .right-banner {
                display: none;
            }

            .left-form {
                padding: 40px 25px;
                min-height: 100vh;
            }

            .login-form-wrapper {
                max-width: 100%;
            }

            .login-header img {
                width: 100px;
            }
        }
    </style>

    <script async src="https://www.google.com/recaptcha/api.js"></script>
</head>

<body>

<div class="login-wrapper">
    <div class="login-container">

        <!-- LEFT SIDE - LOGIN FORM -->
        <div class="left-form">
            <div class="login-form-wrapper">

                <!-- HEADER -->
                <div class="login-header">
                    @if ($schoolSettings['horizontal_logo'] ?? '')
                        <img src="{{ $schoolSettings['horizontal_logo'] }}" alt="Logo">
                    @elseif($systemSettings['login_page_logo'] ?? $systemSettings['horizontal_logo'] ?? '')
                        <img src="{{ $systemSettings['login_page_logo'] ?? $systemSettings['horizontal_logo'] }}" alt="Logo">
                    @else
                        <img src="{{ url('assets/horizontal-logo.svg') }}" alt="Logo">
                    @endif
                    <h2>{{ __('login') }}</h2>
                    <p>{{ config('app.name') }} - Manage your school efficiently</p>
                </div>

                <!-- ERROR MESSAGE -->
                @if (\Session::has('error'))
                    <div class="alert alert-danger">
                        {{ \Session::get('error') }}
                    </div>
                @endif

                <!-- LOGIN FORM -->
                <form action="{{ route('login') }}" method="POST" id="frmLogin">
                    @csrf

                    <!-- EMAIL / MOBILE -->
                    <div class="form-group">
                        <label>{{ __('email') }} or {{ __('mobile') }}</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Enter email or mobile">
                    </div>

                    <!-- PASSWORD -->
                    <div class="form-group">
                        <label>{{ __('password') }}</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter password">
                            <span class="input-group-text" id="togglePasswordShowHide">
                                <i class="fa fa-eye-slash" id="togglePassword"></i>
                            </span>
                        </div>
                    </div>

                    <!-- SCHOOL CODE -->
                    <div class="form-group">
                        <label>{{ __('school_code') }}</label>
                        <input type="text" name="code" class="form-control" placeholder="Enter school code">
                    </div>

                    <!-- REMEMBER ME -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">
                            {{ __('remember_me') ?? 'Remember me' }}
                        </label>
                    </div>

                    <!-- FORGOT PASSWORD -->
                    <div class="forgot-password-link">
                        <a href="{{ route('password.request') }}">{{ __('forgot_password') ?? 'Forgot Password?' }}</a>
                    </div>

                    <!-- SUBMIT BUTTON -->
                    <button type="submit" class="btn-login">
                        {{ __('login') }}
                    </button>

                </form>

                <!-- DEMO CREDENTIALS -->
                <div class="demo-credentials-form">
                    <div class="demo-credentials-title">📋 Demo Credentials</div>
                    
                    <!-- Email Demo -->
                    <div class="demo-credential-item-light" onclick="copyCredential('demo@example.com', 'email')">
                        <span class="demo-credential-label-light">Email:</span>
                        <span class="demo-credential-value-light">demo@example.com</span>
                        <button type="button" class="copy-btn-light" data-type="email" title="Copy">
                            <i class="fa fa-copy"></i>
                        </button>
                    </div>

                    <!-- Password Demo -->
                    <div class="demo-credential-item-light" onclick="copyCredential('demo@123', 'password')">
                        <span class="demo-credential-label-light">Password:</span>
                        <span class="demo-credential-value-light">••••••••</span>
                        <button type="button" class="copy-btn-light" data-type="password" title="Copy">
                            <i class="fa fa-copy"></i>
                        </button>
                    </div>

                    <!-- School Code Demo -->
                    <div class="demo-credential-item-light" onclick="copyCredential('DEMO2024', 'code')">
                        <span class="demo-credential-label-light">Code:</span>
                        <span class="demo-credential-value-light">DEMO2024</span>
                        <button type="button" class="copy-btn-light" data-type="code" title="Copy">
                            <i class="fa fa-copy"></i>
                        </button>
                    </div>
                </div>

            </div>
        </div>

        <!-- RIGHT SIDE - LOGO & AVATAR -->
        <div class="right-banner">
            <div class="right-banner-content">

                <!-- LOGO -->
                @if ($schoolSettings['horizontal_logo'] ?? '')
                    <img src="{{ $schoolSettings['horizontal_logo'] }}" alt="Logo">
                @elseif($systemSettings['login_page_logo'] ?? $systemSettings['horizontal_logo'] ?? '')
                    <img src="{{ $systemSettings['login_page_logo'] ?? $systemSettings['horizontal_logo'] }}" alt="Logo">
                @else
                    <img src="{{ url('assets/horizontal-logo.svg') }}" alt="Logo">
                @endif

                <h3>Welcome Back!</h3>
                <p>Manage your school system easily and efficiently</p>

                <!-- AVATAR -->
                <div class="avatar-container">
                     <img src="{{ url('images/logo/picture.jpg') }}" alt="Avatar">
                </div>

            </div>
        </div>

    </div>
</div>

<script src="{{ asset('/assets/js/vendor.bundle.base.js') }}"></script>

<script>
    // PASSWORD SHOW/HIDE TOGGLE
    const togglePassword = document.querySelector("#togglePasswordShowHide");
    const password = document.querySelector("#password");

    if (togglePassword && password) {
        togglePassword.addEventListener("click", function () {
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);

            if (type === "password") {
                $('#togglePassword').addClass('fa-eye-slash');
                $('#togglePassword').removeClass('fa-eye');
            } else {
                $('#togglePassword').removeClass('fa-eye-slash');
                $('#togglePassword').addClass('fa-eye');
            }
        });
    }

    // DEMO CREDENTIALS COPY FUNCTION
    function copyCredential(value, fieldType) {
        // Copy to clipboard
        navigator.clipboard.writeText(value).then(() => {
            // Get the input field
            const inputField = document.getElementById(fieldType);
            
            // Handle password field special case
            if (fieldType === 'password') {
                inputField.value = value;
                inputField.setAttribute('type', 'text');
                
                // Show password temporarily
                setTimeout(() => {
                    inputField.setAttribute('type', 'password');
                    $('#togglePassword').addClass('fa-eye-slash');
                    $('#togglePassword').removeClass('fa-eye');
                }, 2000);
            } else {
                // For email and code fields
                inputField.value = value;
            }

            // Visual feedback
            const copyBtn = event.target.closest('.copy-btn');
            if (copyBtn) {
                const originalContent = copyBtn.innerHTML;
                copyBtn.classList.add('copied');
                copyBtn.innerHTML = '<i class="fa fa-check"></i>';
                
                setTimeout(() => {
                    copyBtn.classList.remove('copied');
                    copyBtn.innerHTML = originalContent;
                }, 2000);
            }

            // Show toast notification
            showCopyNotification(fieldType);
        }).catch(() => {
            alert('Failed to copy. Please try again.');
        });
    }

    // TOAST NOTIFICATION FUNCTION
    function showCopyNotification(fieldType) {
        const message = fieldType === 'email' ? 'Email copied!' : 
                        fieldType === 'password' ? 'Password copied!' : 
                        'School code copied!';
        
        // Create notification element
        const notification = document.createElement('div');
        notification.className = 'copy-notification';
        notification.textContent = message;
        notification.style.cssText = `
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #4caf50;
            color: white;
            padding: 15px 20px;
            border-radius: 6px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            font-size: 14px;
            z-index: 9999;
            animation: slideIn 0.3s ease;
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => notification.remove(), 300);
        }, 2500);
    }

    // ADD CSS ANIMATIONS
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
</script>

</body>
</html>
<x-filament-panels::page.simple>
    <style>
        /* Ubah warna pesan error */
        .fi-fo-field-wrp-error-message {
            color: #dc2626 !important;
            /* Tailwind red-600 */
            font-weight: 600;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url('{{ asset('images/bg-login_test.png') }}') center/cover;
            font-family: 'Inter', sans-serif;
            position: relative;
        }

        /* Overlay untuk memberikan efek blur pada background */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(2px);
            z-index: -1;
        }

        .login-card {
            background: rgba(0, 0, 0, 0);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(255, 255, 255, 0.1);
            padding: 2.5rem;
            width: 100%;
            max-width: 400px;
            text-align: center;
            animation: fadeIn 0.8s ease-in-out;
            position: relative;
        }

        /* Hilangkan decorative circle */

        .login-card h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-top: 1rem;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #becf21, #becf21);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .login-card p {
            font-size: 0.95rem;
            color: #555;
            margin-bottom: 2rem;
            line-height: 1.5;
        }

        /* Label input form */
        .fi-fo-field-wrp label {
            color: #374151 !important;
            font-weight: 500 !important;
        }

        /* Label checkbox "Ingatkan saya" */
        .fi-checkbox-list-option-label {
            color: #374151 !important;
        }

        /* Styling untuk input fields */
        .fi-input {
            background: rgba(255, 255, 255, 0.8) !important;
            border: 1px solid rgba(22, 163, 74, 0.2) !important;
            border-radius: 8px !important;
            transition: all 0.3s ease !important;
            color: #000000 !important;
            /* Warna teks hitam saat diisi */
        }

        .fi-input:focus {
            border-color: #16a34a !important;
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.1) !important;
            background: rgba(255, 255, 255, 0.95) !important;
            color: #000000 !important;
            /* Warna teks hitam saat focus */
        }

        /* Placeholder text */
        .fi-input::placeholder {
            color: #9ca3af !important;
        }

        /* Tombol login dengan gradient */
        button[type="submit"] {
            background: linear-gradient(135deg, #becf21, #22c55e) !important;
            color: #fff !important;
            font-weight: 600;
            border: none !important;
            padding: 0.75rem 2rem !important;
            border-radius: 8px !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 4px 15px rgba(22, 163, 74, 0.3) !important;
        }

        button[type="submit"]:hover {
            background: linear-gradient(135deg, #becf21, #16a34a) !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 20px rgba(22, 163, 74, 0.4) !important;
        }

        /* Link lupa password */
        a[href*="password"] {
            color: #ea6e21 !important;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        a[href*="password"]:hover {
            color: #15803d !important;
            text-decoration: underline;
        }

        /* Floating particles effect */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -2;
        }

        .particle {
            position: absolute;
            background: rgba(22, 163, 74, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .particle:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .particle:nth-child(2) {
            width: 60px;
            height: 60px;
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }

        .particle:nth-child(3) {
            width: 40px;
            height: 40px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        /* Responsive design */
        @media (max-width: 480px) {
            .login-card {
                margin: 1rem;
                padding: 2rem;
            }

            .login-card h1 {
                font-size: 1.5rem;
            }
        }

        /* Link register */
        .register-link {
            color: #16a34a !important;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .register-link:hover {
            color: #15803d !important;
            text-decoration: underline;
        }

        /* Styling untuk teks register */
        .text-gray-600 {
            color: #6b7280 !important;
        }
    </style>

    <!-- Floating particles -->
    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <!-- Di file login.blade.php -->
    <div class="login-card">
        <h1>🌿 JejakKita</h1>
        <p>Selamat datang di platform donasi dan pembangunan berkelanjutan</p>

        <x-filament-panels::form id="form" wire:submit="authenticate">
            {{ $this->form }}

            <x-filament-panels::form.actions :actions="$this->getCachedFormActions()" :full-width="$this->hasFullWidthFormActions()" />
        </x-filament-panels::form>

        <!-- Tambahkan link register di sini -->
        @if (filament()->hasRegistration())
            <div class="mt-4 text-center">
                <p class="text-sm text-gray-600">
                    Belum punya akun?
                    <a href="{{ filament()->getRegistrationUrl() }}"
                        class="register-link"
                        style="color: #becf21 !important;">
                        Daftar sekarang
                    </a>
                </p>
            </div>
        @endif
    </div>
</x-filament-panels::page.simple>

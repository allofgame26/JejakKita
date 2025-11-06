<div>
    @php
        $heading = __('filament-panels::pages/auth/login.title');
    @endphp
    
    <x-filament-panels::page.simple>
        <style>
            html, body {
                height: 100%;
                margin: 0;
            }
            
            /* Style untuk background paling belakang */
            body.fi-body {
                background: #000;
            }
            
            /* Style untuk container Filament */
            .fi-simple-layout {
                background-image: url("{{ asset('images/kemenkeumengajar.jpeg') }}");
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                min-height: 100vh;
                position: relative;
            }
            
            /* Overlay dengan blur untuk background */
            .fi-simple-layout::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.3);
                backdrop-filter: blur(2px);
                -webkit-backdrop-filter: blur(8px);
                pointer-events: none;
            }
            .login-bg {
                position: relative;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 2rem;
                /* background-image: url("{{ asset('images/kunjungansekolah.jpeg') }}");
                background-position: center;
                background-size: cover;
                background-repeat: no-repeat; */
                overflow: hidden;
            }

            .login-bg::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.4);  /* Overlay gelap untuk membantu keterbacaan */
                z-index: 0;
            }

            /* Override style Filament card */
            .fi-simple-main {
                background: rgba(255, 255, 255, 0.15) !important;
                backdrop-filter: blur(4px);
                -webkit-backdrop-filter: blur(4px);
            }

            .login-card {
                position: relative;
                z-index: 1;
                background: transparent !important;
                box-shadow: none !important;
                max-width: 420px;
                width: 100%;
                padding: 28px;
                display: flex;
                gap: 12px;
                align-items: center;
                flex-direction: column;
            }

            /* Memastikan form fields tetap terbaca */
            .fi-input-wrp {
                background: rgba(255, 255, 255, 0.1) !important;
            }

            .brand {
                display: flex;
                gap: 12px;
                align-items: center;
                margin-bottom: 6px;
            }
            .brand img { height: 48px; width: auto; object-fit: contain }
            .brand h1 { font-size: 1.15rem; margin: 0; color: #f8fafc }

            .login-footer { font-size: 0.9rem; color: #f1f5f9; margin-top: 8px }
            
            /* Mengubah warna teks form untuk kontras yang lebih baik */
            .login-card :where(label, input, .fi-input-wrp) {
                --tw-text-opacity: 1;
                color: #f8fafc !important;
            }
            
            .login-card input {
                background: rgba(255, 255, 255, 0.15) !important;
                border-color: rgba(255, 255, 255, 0.3) !important;
            }
            
            .login-card input:focus {
                border-color: rgba(255, 255, 255, 0.5) !important;
                box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.5) !important;
            }
            
            /* Memperbaiki warna teks deskripsi */
            .brand div div { color: #e2e8f0 !important; }

            /* Small responsive tweak */
            @media (max-width: 480px) {
                .login-card { padding: 18px; max-width: 340px }
                .brand img { height: 40px }
            }
        </style>

        <div class="login-bg">
            <div class="login-card">
                <div class="brand">
                    <img src="{{ asset('images/logo_polinema.png') }}" alt="Logo">
                    <div>
                        <h1>JejakKita - Forum Donasi</h1>
                        <div style="font-size:0.85rem;color:#e2e8f0">Masuk untuk mengelola donasi dan transaksi</div>
                    </div>
                </div>

                {{ \Filament\Support\Facades\FilamentView::renderHook('panels::auth.login.form.before') }}

                <x-filament-panels::form wire:submit="authenticate">
                    @foreach($this->getForms() as $formKey => $form)
                        {{ $form }}
                    @endforeach

                    <x-filament-panels::form.actions 
                        :actions="$this->getCachedFormActions()"
                        :full-width="true"
                    />
                </x-filament-panels::form>

                {{ \Filament\Support\Facades\FilamentView::renderHook('panels::auth.login.form.after') }}

                <div class="login-footer">
                    Belum punya akun? 
                    <a href="{{ route('filament.admin.auth.register') }}" class="font-semibold text-primary-500 hover:text-primary-400">
                        Daftar di sini
                    </a>
                </div>
            </div>
        </div>
    </x-filament-panels::page.simple>

    @livewire('notifications')

    <x-filament-actions::modals />
</div>

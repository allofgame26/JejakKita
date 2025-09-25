<x-filament-panels::page.simple>
    <style>
    /* Ubah warna pesan error */
       .fi-fo-field-wrp-error-message {
        color: #dc2626 !important; /* Tailwind red-600 */
        font-weight: 600;
    }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #fef9c3, #fde68a); /* kuning soft */
            font-family: 'Inter', sans-serif;
        }

        .login-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            padding: 2rem;
            width: 100%;
            max-width: 380px;
            text-align: center;
            animation: fadeIn 0.5s ease-in-out;
        }

        .login-card h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .login-card p {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 1.5rem;
        }

        /* Tombol login */
        button[type="submit"] {
            background-color: #16a34a !important;
            color: #fff !important;
            font-weight: 600;
        }
        button[type="submit"]:hover {
            background-color: #15803d !important;
        }

        /* Link lupa password */
        a[href*="password"] {
            color: #2563eb !important; /* biru Tailwind blue-600 */
            font-size: 0.85rem;
            font-weight: 500;
        }
        a[href*="password"]:hover {
            color: #1d4ed8 !important; /* biru lebih gelap */
            text-decoration: underline;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <div class="login-card">
        <h1>Selamat Datang 👋</h1>
        <p>Silakan login untuk mengakses dashboard JejakKita</p>

        <x-filament-panels::form id="form" wire:submit="authenticate">
            {{ $this->form }}

            <x-filament-panels::form.actions
                :actions="$this->getCachedFormActions()"
                :full-width="$this->hasFullWidthFormActions()"
            />
        </x-filament-panels::form>
    </div>
</x-filament-panels::page.simple>

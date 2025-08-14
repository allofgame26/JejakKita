<div class="p-6 bg-white rounded-xl border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <h3 class="text-lg font-medium text-gray-900 dark:text-white">
        Otentikasi Dua Faktor (2FA)
    </h3>

    <div class="mt-3 max-w-xl text-sm text-gray-600 dark:text-gray-400">
        <p>
            Tambahkan keamanan ekstra pada akun Anda dengan menggunakan otentikasi dua faktor.
        </p>
    </div>

    @if(!auth()->user()->two_factor_secret)
        {{-- 2FA Belum Aktif --}}
        <div class="mt-5">
            <button wire:click="enableTwoFactorAuthentication" class="fi-btn fi-btn-color-primary">
                Aktifkan 2FA
            </button>
        </div>
    @else
        {{-- 2FA Sudah Aktif --}}
        @if($showingQrCode)
            <div class="mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-400">
                <p class="font-semibold">
                    Otentikasi dua faktor sekarang aktif. Pindai QR code berikut menggunakan aplikasi otentikator di ponsel Anda.
                </p>
            </div>

            <div class="mt-4">
                {!! auth()->user()->twoFactorQrCodeSvg() !!}
            </div>
        @endif

        @if($showingRecoveryCodes)
            <div class="mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-400">
                <p class="font-semibold">
                    Simpan recovery codes ini di tempat yang aman. Kode ini dapat digunakan untuk mengakses akun Anda jika perangkat otentikasi dua faktor Anda hilang.
                </p>
            </div>

            <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg dark:bg-gray-900">
                @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes), true) as $code)
                    <div>{{ $code }}</div>
                @endforeach
            </div>
        @endif

        <div class="mt-5">
            @if(!$showingRecoveryCodes)
                <button wire:click="showRecoveryCodes" class="fi-btn fi-btn-color-gray mr-3">
                    Tampilkan Recovery Codes
                </button>
            @else
                 <button wire:click="regenerateRecoveryCodes" class="fi-btn fi-btn-color-gray mr-3">
                    Buat Ulang Recovery Codes
                </button>
            @endif

            <button wire:click="disableTwoFactorAuthentication" class="fi-btn fi-btn-color-danger">
                Nonaktifkan 2FA
            </button>
        </div>
    @endif
</div>
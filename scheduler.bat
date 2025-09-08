@echo OFF

:: Pindah ke direktori di mana file batch ini berada
cd %~dp0

:: Jalankan perintah Laravel schedule:run menggunakan path lengkap ke PHP Laragon
:: PENTING: Sesuaikan path PHP di bawah ini dengan versi yang Anda gunakan!
C:\laragon\bin\php\php-8.3.23-nts-Win32-vs16-x64\php.exe artisan schedule:run

:: Tahan jendela command prompt selama 5 detik agar bisa dilihat (opsional, hapus jika tidak perlu)
timeout /t 5
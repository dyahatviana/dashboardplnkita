<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Portal Monitoring - Dashboard PLN</title>

    <!-- Mencegah browser menyimpan/mengisi otomatis form -->
    <meta name="autocomplete" content="off">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        @keyframes floatSlow {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-6px) rotate(1deg);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.96) translateY(20px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .animate-card {
            animation: fadeIn 0.9s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .animate-float {
            animation: floatSlow 5s ease-in-out infinite;
        }

        .split-transition {
            transition: width 0.7s cubic-bezier(0.25, 1, 0.5, 1);
        }
    </style>
</head>

<body class="bg-slate-950 font-sans antialiased relative overflow-hidden h-screen w-full">

    <!-- Background -->
    <div
        class="absolute inset-0 z-0 bg-cover bg-center"
        style="background-image: url('{{ asset('images/bg-pln.png') }}');">
    </div>

    <div
        class="absolute inset-0 z-0 bg-gradient-to-tr from-slate-950/90 via-slate-900/80 to-blue-950/60 backdrop-blur-[4px]">
    </div>

    <!-- Container utama -->
    <div class="relative z-10 flex h-screen w-full">

        <!-- KONTEN KIRI -->
        <div
            id="leftContent"
            class="flex-1 flex flex-col items-center justify-center text-center px-6 transition-all duration-700 animate-card">

            <!-- Logo -->
            <div
                class="mb-6 bg-white/10 backdrop-blur-xl p-4 rounded-3xl shadow-2xl border border-white/20 animate-float">

                <img
                    src="{{ asset('images/logo-pln.jpeg') }}"
                    onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/9/96/PLN_logo.svg'"
                    alt="Logo PLN"
                    class="h-20 w-auto object-contain rounded-xl">

            </div>

            <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight mb-4 drop-shadow-lg">
                Portal Monitoring
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-400 via-blue-400 to-indigo-400">
                    Pengaduan
                </span>
            </h1>

            <p class="text-sm md:text-base text-slate-300 max-w-xl mx-auto mb-10 font-medium drop-shadow-md leading-relaxed">
                Sistem rekapitulasi dan pemantauan keluhan pelanggan secara real-time dan efisien
                di lingkungan PT PLN (Persero) ULP Dukuh Kupang.
            </p>

            <!-- Tombol masuk -->
            <div id="loginBtnWrapper" class="transition-all duration-500 ease-in-out">

                <button
                    onclick="toggleLogin()"
                    type="button"
                    class="group relative px-8 py-3.5 bg-gradient-to-r from-blue-600 via-indigo-600 to-sky-500 hover:from-blue-500 hover:to-sky-400 text-white font-semibold rounded-2xl shadow-[0_10px_25px_rgba(37,99,235,0.4)] hover:shadow-blue-500/30 transition-all duration-300 hover:scale-105 active:scale-95 border border-sky-400/30 overflow-hidden flex items-center space-x-3">

                    <span class="tracking-wider text-sm">
                        MASUK KE SISTEM
                    </span>

                    <i class="fa-solid fa-arrow-right group-hover:translate-x-1.5 transition-transform duration-300"></i>

                </button>

            </div>
        </div>


        <!-- PANEL LOGIN -->
        <div
            id="loginPanel"
            class="w-0 flex-shrink-0 split-transition overflow-hidden bg-gradient-to-br from-slate-900 via-slate-900/95 to-blue-950 border-l border-sky-500/20 shadow-[-20px_0_60px_-15px_rgba(0,0,0,0.8)] relative flex flex-col justify-center items-center">

            <!-- Ornamen -->
            <div
                class="absolute -top-24 -right-24 w-72 h-72 bg-blue-600/20 rounded-full blur-3xl pointer-events-none">
            </div>

            <div
                class="absolute -bottom-24 -left-24 w-72 h-72 bg-indigo-600/20 rounded-full blur-3xl pointer-events-none">
            </div>


            <!-- Tombol close -->
            <button
                onclick="toggleLogin()"
                type="button"
                class="absolute top-8 right-8 z-50 text-slate-400 hover:text-white bg-white/5 hover:bg-white/10 w-10 h-10 rounded-full transition-all duration-300 backdrop-blur-md border border-white/10 flex items-center justify-center">

                <i class="fa-solid fa-xmark text-sm"></i>

            </button>


            <!-- FORM LOGIN -->
            <div
                id="formContent"
                class="w-full h-full flex flex-col justify-center items-center px-8 opacity-0 transition-opacity duration-700 delay-100 relative z-10">

                <div class="w-full max-w-sm mx-auto">

                    <!-- Header -->
                    <div class="mb-6 text-left">

                        <h3 class="text-3xl font-black text-white tracking-wide drop-shadow-sm mb-1.5">
                            LOGIN
                        </h3>

                        <p class="text-slate-400 text-xs md:text-sm">
                            Silakan masukkan kredensial Anda untuk mengakses dashboard.
                        </p>

                    </div>


                    <!-- Pesan error validasi -->
                    @if ($errors->any())

                        <div
                            class="mb-5 p-3.5 bg-red-500/10 border-l-4 border-red-500 text-white rounded-xl flex items-start space-x-3 backdrop-blur-md">

                            <i class="fa-solid fa-triangle-exclamation text-red-400 mt-0.5"></i>

                            <div>

                                <p class="text-[11px] font-bold text-red-300 uppercase tracking-wider">
                                    Gagal Masuk
                                </p>

                                <p class="text-xs text-red-100 mt-0.5">
                                    {{ $errors->first() }}
                                </p>

                            </div>

                        </div>

                    @endif

                    <!-- Pesan Sesi Kedaluwarsa (419 Prevention) -->
                    @if (session('session_expired'))

                        <div
                            class="mb-5 p-3.5 bg-amber-500/15 border-l-4 border-amber-400 text-white rounded-xl flex items-start space-x-3 backdrop-blur-md">

                            <i class="fa-solid fa-clock-rotate-left text-amber-400 mt-0.5"></i>

                            <div>

                                <p class="text-[11px] font-bold text-amber-300 uppercase tracking-wider">
                                    Sesi Diperbarui
                                </p>

                                <p class="text-xs text-amber-100 mt-0.5 leading-relaxed">
                                    {{ session('session_expired') }}
                                </p>

                            </div>

                        </div>

                    @endif


                    <!-- FORM -->
                    <form
                        method="POST"
                        action="{{ route('login') }}"
                        class="space-y-4"
                        autocomplete="off">

                        @csrf


                        <!-- USERNAME -->
                        <div class="space-y-1.5">

                            <label
                                for="username"
                                class="block text-xs font-semibold uppercase tracking-wider text-slate-300">
                                Username
                            </label>

                            <div class="relative group">

                                <div
                                    class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-sky-400 transition-colors">

                                    <i class="fa-regular fa-user text-xs"></i>

                                </div>

                                <input
                                    type="text"
                                    id="username"
                                    name="username"
                                    value="{{ old('username') }}"
                                    required
                                    autofocus
                                    autocomplete="off"
                                    autocorrect="off"
                                    autocapitalize="none"
                                    spellcheck="false"
                                    placeholder="Masukkan username"
                                    class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-700/80 bg-slate-950/60 text-white placeholder-slate-500 focus:bg-slate-900 focus:ring-2 focus:ring-sky-500/40 focus:border-sky-400 text-xs md:text-sm font-medium transition-all duration-300 shadow-inner">

                            </div>

                        </div>


                        <!-- PASSWORD -->
                        <div class="space-y-1.5">

                            <label
                                for="password"
                                class="block text-xs font-semibold uppercase tracking-wider text-slate-300">
                                Kata Sandi
                            </label>

                            <div class="relative group">

                                <div
                                    class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-sky-400 transition-colors">

                                    <i class="fa-solid fa-lock text-xs"></i>

                                </div>

                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    required
                                    autocomplete="new-password"
                                    placeholder="••••••••"
                                    class="w-full pl-11 pr-11 py-3 rounded-xl border border-slate-700/80 bg-slate-950/60 text-white placeholder-slate-500 focus:bg-slate-900 focus:ring-2 focus:ring-sky-500/40 focus:border-sky-400 text-xs md:text-sm font-medium transition-all duration-300 shadow-inner">

                                <button
                                    type="button"
                                    onclick="togglePassword()"
                                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-white focus:outline-none transition-colors">

                                    <i id="eyeIcon" class="fa-regular fa-eye text-xs"></i>

                                </button>

                            </div>

                        </div>


                        <!-- REMEMBER -->
                        <div class="flex items-center justify-between text-xs py-0.5">

                            <label class="flex items-center text-slate-300 cursor-pointer select-none group">

                                <input
                                    type="checkbox"
                                    name="remember"
                                    value="1"
                                    autocomplete="off"
                                    class="rounded border-slate-700 bg-slate-900 text-sky-500 focus:ring-sky-500 h-4 w-4 cursor-pointer">

                                <span class="ml-2 text-xs font-medium text-slate-300 group-hover:text-white transition-colors">
                                    Ingat perangkat ini
                                </span>

                            </label>

                        </div>


                        <!-- TOMBOL LOGIN -->
                        <button
                            type="submit"
                            class="w-full py-3.5 px-4 mt-2 bg-gradient-to-r from-blue-600 via-indigo-600 to-sky-500 hover:from-blue-500 hover:to-sky-400 text-white font-semibold rounded-xl shadow-lg shadow-blue-900/40 hover:shadow-sky-500/25 active:scale-[0.98] focus:outline-none focus:ring-4 focus:ring-sky-500/30 transition-all duration-300 text-xs md:text-sm flex items-center justify-center space-x-2 group">

                            <span class="tracking-widest">
                                LOGIN
                            </span>

                            <i class="fa-solid fa-arrow-right group-hover:translate-x-2 transition-transform duration-300"></i>

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>


    <!-- SCRIPT -->
    <script>

        function toggleLogin() {

            const panel = document.getElementById('loginPanel');
            const formContent = document.getElementById('formContent');
            const btnWrapper = document.getElementById('loginBtnWrapper');

            if (panel.classList.contains('w-0')) {

                // Buka panel
                panel.classList.remove('w-0');

                panel.classList.add('w-full', 'lg:w-[40%]');

                formContent.classList.remove('opacity-0');

                formContent.classList.add('opacity-100');

                btnWrapper.style.opacity = '0';

                btnWrapper.style.visibility = 'hidden';

                btnWrapper.style.transform = 'translateY(20px)';

            } else {

                // Tutup panel
                panel.classList.remove('w-full', 'lg:w-[40%]');

                panel.classList.add('w-0');

                formContent.classList.remove('opacity-100');

                formContent.classList.add('opacity-0');

                btnWrapper.style.visibility = 'visible';

                btnWrapper.style.opacity = '1';

                btnWrapper.style.transform = 'translateY(0)';

            }

        }


        function togglePassword() {

            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {

                passwordInput.type = 'text';

                eyeIcon.classList.remove('fa-eye');

                eyeIcon.classList.add('fa-eye-slash');

            } else {

                passwordInput.type = 'password';

                eyeIcon.classList.remove('fa-eye-slash');

                eyeIcon.classList.add('fa-eye');

            }

        }

    </script>

</body>

</html>

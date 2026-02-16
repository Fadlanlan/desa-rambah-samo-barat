<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Dikunci - Desa Rambah Samo Barat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen p-6">
    <div class="max-w-md w-full text-center">
        <div class="w-20 h-20 bg-rose-50 text-rose-500 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-xl shadow-rose-500/10">
            <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
        </div>
        <h1 class="text-3xl font-black text-slate-800 mb-4 uppercase tracking-tighter">Akses Dinonaktifkan</h1>
        <p class="text-slate-600 mb-8 font-medium leading-relaxed">
            Maaf, akses ke halaman {{ $target === 'admin' ? 'Administrator' : 'Layanan Warga' }} sedang dikunci oleh Super Admin untuk pemeliharaan sistem.
        </p>
        <a href="/" class="inline-flex items-center justify-center px-8 py-4 bg-brand-blue-600 text-white font-black uppercase tracking-widest text-xs rounded-2xl hover:bg-brand-blue-700 transition-all shadow-xl shadow-brand-blue-500/20 active:scale-95">
            Kembali ke Beranda
        </a>
    </div>
</body>
</html>

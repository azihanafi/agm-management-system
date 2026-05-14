<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGM 2026 - Voting System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #0a0a0f;
            color: #e2e8f0;
        }

        .glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .accent-gradient {
            background: linear-gradient(135deg, #ef4444 0%, #991b1b 100%);
        }

        .glow {
            box-shadow: 0 0 20px rgba(239, 68, 68, 0.2);
        }
    </style>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>

<body class="min-h-screen flex flex-col">
    <nav class="glass sticky top-0 z-50 px-6 py-4 flex justify-between items-center border-b border-white/5">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 accent-gradient rounded-lg glow flex items-center justify-center font-bold text-white">A
            </div>
            <span class="text-xl font-bold tracking-tight">AGM <span class="text-red-500">2026</span></span>
        </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
            <div class="flex items-center space-x-4">
                <span class="text-sm text-slate-400"><?php echo e(Auth::user()->name); ?></span>
                <div class="w-2 h-2 rounded-full <?php echo e(Auth::user()->isPresent() ? 'bg-green-500' : 'bg-red-500'); ?>"></div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </nav>

    <main class="flex-grow container mx-auto px-4 py-8">
        <?php echo e($slot); ?>

    </main>

    <footer class="p-6 text-center text-sm text-slate-600">
        &copy; 2026 Sports Club Annual Grand Meeting. All Rights Reserved.
    </footer>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>

</html><?php /**PATH C:\Users\aziha\.gemini\antigravity\scratch\agm-voting-system\resources\views/components/layouts/app.blade.php ENDPATH**/ ?>
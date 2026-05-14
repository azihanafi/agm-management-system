<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @page { margin: 150px 1in 1in 1in; }
        header { 
            position: fixed; 
            top: -120px; 
            left: 0px; 
            right: 0px; 
            height: 100px; 
            text-align: center;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        body { font-family: 'Helvetica', sans-serif; font-size: 11pt; line-height: 1.5; color: #333; }
        .header-info { margin-bottom: 30px; }
        .header-table { width: 100%; border-collapse: collapse; }
        .header-table td { vertical-align: top; padding: 2px 0; }
        .label { font-weight: bold; width: 100px; }
        .separator { width: 20px; text-align: center; }
        
        .title { font-weight: bold; margin: 10px 0; font-size: 11pt; text-transform: uppercase; }
        .title-table { width: 100%; border-collapse: collapse; border-bottom: 2px solid #000; margin-bottom: 20px; }
        .title-table td { vertical-align: top; padding: 5px 0; }
        
        .section-title { font-weight: bold; margin-top: 15px; margin-bottom: 10px; text-transform: uppercase; }
        .section-title span { text-decoration: underline; }
        .content { margin-left: 20px; margin-bottom: 20px; text-align: justify; }
        
        table.data-table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        table.data-table th, table.data-table td { border: 1px solid #000; padding: 8px; font-size: 10pt; }
        table.data-table th { background-color: #f2f2f2; font-weight: bold; text-align: center; }
        
        .total-row { font-weight: bold; background-color: #eee; }
        
        .footer { margin-top: 50px; }
        .sign-table { width: 100%; margin-top: 30px; }
        .sign-box { border-top: 1px solid #000; width: 200px; margin-top: 50px; text-align: center; font-weight: bold; }
        
        .page-break { page-break-after: always; }
    </style>
</head>
<body>
    <header>
        <div style="font-weight: bold; text-decoration: underline; font-size: 13pt; margin-bottom: 5px;">
            KELAB SUKAN DAN KEBAJIKAN FELDA-JOHORE BULKERS SDN BHD
        </div>
        <div style="font-size: 10pt; color: #666;">
            Lorong Sawit 1, Kawasan Pelabuhan Johor, 81700 Pasir Gudang, Johor
        </div>
        <div style="font-size: 10pt; color: #666;">
            (No. Pendaftaran: PPM-001-01-22071978)
        </div>
    </header>

    <div class="header-info">
        <table class="header-table">
            <tr>
                <td class="label">KEPADA</td>
                <td class="separator">:</td>
                <td><?php echo e($paperwork->kepada); ?></td>
            </tr>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paperwork->sk): ?>
            <tr>
                <td class="label">s.k.</td>
                <td class="separator">:</td>
                <td><?php echo e($paperwork->sk); ?></td>
            </tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <tr>
                <td class="label">DARIPADA</td>
                <td class="separator">:</td>
                <td><?php echo e($paperwork->daripada); ?></td>
            </tr>
            <tr>
                <td class="label">TARIKH</td>
                <td class="separator">:</td>
                <td><?php echo e(\Carbon\Carbon::parse($paperwork->tarikh)->format('d F Y')); ?></td>
            </tr>
        </table>
        
        <table class="title-table">
            <tr>
                <td class="label">PERKARA</td>
                <td class="separator">:</td>
                <td style="font-weight: bold; text-transform: uppercase;"><?php echo e($paperwork->perkara); ?></td>
            </tr>
        </table>
    </div>

    <div class="section-title">1) <span>OBJEKTIF</span></div>
    <div class="content">
        Adalah dimaklumkan bahawa FJB Group Sport Club akan menganjurkan program <strong><?php echo e($paperwork->program_title); ?></strong> yang akan diadakan pada ketetapan berikut:
        <br><br>
        <table style="margin-left: 40px;">
            <tr><td width="100">Tarikh</td><td>: <?php echo e(\Carbon\Carbon::parse($paperwork->program_date)->format('d F Y')); ?></td></tr>
            <tr><td>Hari</td><td>: <?php echo e($paperwork->program_day); ?></td></tr>
            <tr><td>Masa</td><td>: <?php echo e($paperwork->program_time); ?></td></tr>
            <tr><td>Tempat</td><td>: <?php echo e($paperwork->program_location); ?></td></tr>
        </table>
        <br>
        Objektif utama program ini adalah untuk memupuk semangat kesukanan dan mengeratkan silaturahim di kalangan ahli kelab.
    </div>

    <div class="section-title">2) <span>SYARAT PENYERTAAN</span></div>
    <div class="content">
        <?php echo nl2br(e($paperwork->syarat_penyertaan)); ?>

    </div>

    <div class="section-title">3) <span>CADANGAN SYARAT PERTANDINGAN</span></div>
    <div class="content">
        <?php echo nl2br(e($paperwork->cadangan_syarat)); ?>

    </div>

    <div class="page-break"></div>

    <div class="section-title">4) <span>ATURCARA KEJOHANAN</span></div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="120">MASA</th>
                <th>PERKARA / AKTIVITI</th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $paperwork->itineraryItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td align="center"><?php echo e($item->time); ?></td>
                <td><?php echo e($item->activity); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
    </table>

    <div class="section-title">5) <span>BAJET KEJOHANAN</span></div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="30">NO</th>
                <th>MAKLUMAT</th>
                <th width="80">HARGA (RM)</th>
                <th width="60">KUANTITI</th>
                <th width="60">UNIT</th>
                <th width="100">JUMLAH (RM)</th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $paperwork->budgetItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td align="center"><?php echo e($index + 1); ?></td>
                <td><?php echo e($item->description); ?></td>
                <td align="right"><?php echo e(number_format($item->price, 2)); ?></td>
                <td align="center"><?php echo e($item->quantity); ?></td>
                <td align="center"><?php echo e($item->unit); ?></td>
                <td align="right"><?php echo e(number_format($item->total_price, 2)); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="5" align="right">JUMLAH KESELURUHAN</td>
                <td align="right">RM <?php echo e(number_format($paperwork->budgetItems->sum('total_price'), 2)); ?></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Sekian, Terima Kasih.</p>
        
        <table class="sign-table">
            <tr>
                <td>
                    <div class="sign-box">Disediakan Oleh:</div>
                    <div>(Wakil AJK Sukan)</div>
                </td>
                <td>
                    <div class="sign-box">Disokong Oleh:</div>
                    <div>(Bendahari Kelab)</div>
                </td>
            </tr>
            <tr>
                <td style="padding-top: 40px;">
                    <div class="sign-box">Bersetuju Oleh:</div>
                    <div>(Penyelaras Sukan)</div>
                </td>
                <td style="padding-top: 40px;">
                    <div class="sign-box">Diluluskan Oleh:</div>
                    <div>(Yang Di-Pertua Kelab)</div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
<?php /**PATH C:\Users\aziha\.gemini\antigravity\scratch\agm-voting-system\resources\views/pdf/paperwork.blade.php ENDPATH**/ ?>
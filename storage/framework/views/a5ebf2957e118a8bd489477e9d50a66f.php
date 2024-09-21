

<?php $__env->startSection('title', 'Fibonacci'); ?>

<?php $__env->startSection('content'); ?>
<h1>Masukkan Angka</h1>
<form action='#' method="GET">
    <label for="n">Enter a number (n):</label>
    <input type="text" name="n" id="n" min="1" required>
    <button type="submit">Submit</button>
</form>

<?php if(count($num) > 0): ?>
    <h2>Hasil</h2>  
    <table border="1">
        <thead>
            <tr>
                <th>Angka Fibonacci</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $num; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($n); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Tugass no bkp\Sem5\PBKK\tugas1\resources\views/tugas1/fibonacci.blade.php ENDPATH**/ ?>
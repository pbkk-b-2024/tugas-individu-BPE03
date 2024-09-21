<?php $__env->startSection('title', 'Routing Parameter'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Hasil</h5>
    </div>
    <div class="card-body">
        <div>URL : <?php echo e(url()->current()); ?></div>
        <div> Parameter 1 : <?php echo e($data['param1']); ?></div>
    </div>
    <div class="card-footer">
        <a href="<?php echo e(url('/param')); ?>">
            <button class="btn btn-primary">Kembali</button>
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('dashboard.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Tugass no bkp\Sem5\PBKK\tugas1\resources\views/tugas1/param1.blade.php ENDPATH**/ ?>
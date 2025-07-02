
<?php $__env->startSection('content'); ?>
<form action="<?php echo e(route('mahasiswa.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo $__env->make('mahasiswa.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-mahasiswa\resources\views/mahasiswa/create.blade.php ENDPATH**/ ?>
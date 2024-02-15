<?php $__env->startSection('titulo'); ?>
    <?php echo e($titulo); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('h1'); ?>
    <?php echo e($h1); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>
<?php $__currentLoopData = $jugadores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jugador): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <p>(<?php echo e($jugador->dorsal); ?>) <?php echo e($jugador->nombre); ?> - <?php echo e($jugador->posicion); ?></p>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.plantilla1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('titulo'); ?>
    <?php echo e($titulo); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('h1'); ?>
    <?php echo e($h1); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>
<section class="container text-center">
    <a href="crearDatos.php"  class="btn btn-success">
        <i class="fa-solid fa-database me-2"></i> Instalar Datos de Ejemplo
    </a>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.plantilla1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
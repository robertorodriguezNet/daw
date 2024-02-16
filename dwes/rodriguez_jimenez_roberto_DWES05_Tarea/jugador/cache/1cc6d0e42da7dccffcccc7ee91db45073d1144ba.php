<?php $__env->startSection('titulo'); ?>
    <?php echo e($titulo); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('h1'); ?>
    <?php echo e($h1); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>

    <table class="container table table-striped">
        <thead>
            <tr class="text-center">
                <th scope="col">Nombre Completo</th>
                <th scope="col">Posición</th>
                <th scope="col">Dorsal</th>
                <th scope="col">Código de barras</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $jugadores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jugador): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="text-center">
                <td><?php echo e($jugador->apellidos); ?>, <?php echo e($jugador->nombre); ?></td>
                <td><?php echo e($jugador->posicion); ?></td>
                <td><?php echo e($jugador->dorsal); ?></td>
                <td><?php echo e($jugador->barcode); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantillas.plantilla1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
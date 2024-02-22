<?php $__env->startSection('titulo'); ?>
    <?php echo e($titulo); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('h1'); ?>
    <?php echo e($h1); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>

<section class="container">
    <form action="<?php echo e($action); ?>" method="POST" class="row">

        <div class="col-6 mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombre" required>
        </div>
        <div class="col-6 mb-3">
            <label for="nombre" class="form-label">Apellidos</label>
            <input class="form-control" type="text" name="apellidos" id="apellidos"placeholder="Apellidos" required>
        </div>
        <div class="col-4 mb-3">
            <label for="dorsal" class="form-label">Dorsal</label>
            <input class="form-control" type="number" name="dorsal" id="dorsal" min="1" max="99" step="1" placeholder="Dorsal">
        </div>
        <div class="col-4 mb-3">
            <label for="posicion" class="form-label">Posición</label>
            <select name="posicion" id="posicion" class="form-control" required>
                <?php $__currentLoopData = $posiciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($item); ?>"><?php echo e($item); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-4 mb-3">
            <label for="barcode" class="form-label">Código de barras</label>
            <input class="form-control bg-light text-end" type="text" name="barcode" id="barcode" placeholder="Código de barras" value="<?php echo e($barcode); ?>" readonly>
        </div>
        <div class="col-12">
            <input type="submit" value="Crear" id="crear" class="btn btn-primary me-3">
            <input type="reset" value="Limpiar" class="btn btn-success me-3" id="limpiar">
            <a href="jugadores.php" class="btn btn-info me-3">Volver</a>
            <a href="generarCode.php" class="btn btn-secondary">
                <i class="fa-solid fa-barcode me-3"></i> Generar Barcode
            </a>
        </div>

    </form>
</section>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.plantilla1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
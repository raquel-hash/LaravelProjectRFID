<?php $__env->startSection('content'); ?>
    <div class="container">
        <div>
            <a href="<?php echo e(route('myregister')); ?>" class="btn btn-primary btn-circle btn-xl">
                <i class="fa fa-plus"></i>
            </a>
            <a href="<?php echo e(route('assistance')); ?>" class="btn btn-success btn-circle btn-xl">
                <i class="fa fa-address-book"></i>
            </a>
            <br>
            <br>

            <input class="form-control" type="text" list="Options" id="tableInput" placeholder="Buscador">
            <datalist id="Options" >
                <option value="Activado">
                <option value="Inactivo">
                <option value="Femenino">
                <option value="Masculino">
            </datalist>
        </div>
        <br>
        <table id="tablita" class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>CI</th>
                <th>Nombre Completo</th>
                <th hidden>Nombre Completo</th>
                <th hidden>Genero</th>
                <th>Edad</th>
                <th>Cargo</th>
                <th>Estado</th>
                <th hidden>Estado</th>
                <th>Mostrar</th>
                <th>Editar</th>
                <th>Inactivar</th>
                <th>Eliminar</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empleado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($empleado->idEmpleado); ?></td>
                    <td><?php echo e($empleado->ci); ?></td>
                    <td hidden><?php echo e($empleado->fullName()); ?></td>
                    <td hidden>
                        <?php if($empleado->genero == 'M'): ?>
                            Masculino
                        <?php else: ?>
                            Femenino
                        <?php endif; ?>
                    </td>
                    <td>
                        <form method="post" action="<?php echo e(route('empleados.update', $empleado->idEmpleado)); ?>">
                            <?php echo method_field('PATCH'); ?>
                            <?php echo csrf_field(); ?>
                            <input class="btn btn-primary" type="submit" value="<?php echo e($empleado->fullName()); ?>">
                        </form>
                    </td>
                    <td><?php echo e($empleado->age()); ?></td>
                    <td><?php echo e($empleado->cargo->nombre); ?></td>
                    <td hidden>
                        <?php if($empleado->activo == 1 ): ?>
                            Activado
                        <?php else: ?>
                            Inactivo
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($empleado->activo == 1 ): ?>
                            <div>
                                <i class='fa fa-check-circle'></i>
                            </div>
                        <?php else: ?>
                            <div >
                                <i class='fa fa-times-circle'></i>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo e(route('user.show',$empleado->idEmpleado)); ?>" class="btn btn-warning">
                            <i class='fas fa-eye'></i>
                        </a>
                    </td>
                    <td>
                        <a href="<?php echo e(route('user.edit',$empleado->idEmpleado)); ?>" class="btn btn-primary">
                            <i class='fas fa-pencil-alt'></i>
                        </a>
                    </td>
                    <td>
                        <form action="<?php echo e(route('user.inactive')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <input hidden id="idEmpleado" name="idEmpleado" value="<?php echo e($empleado->idEmpleado); ?>">
                            <button type="submit" class="btn btn-success">
                                <i class='fas fa-discord'></i>
                            </button>
                        </form>
                    </td>

                    <td>
                        <button type="button" data-cat-id="<?php echo e($empleado->idEmpleado); ?>" class="btn btn-danger"
                                data-toggle="modal" data-target="#deleteModal" >
                            <i class='fas fa-trash-alt'></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Confirmacion</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo e(route('user.destroy', 'test')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <p>
                                    Se eliminaran todos los registros de actividad de este usuario.
                                </p>
                                <input name="empleado-id" id="empleado-id" type="text" value="" hidden>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button class="btn btn-danger" type="submit">
                                        <i class='fas fa-trash-alt'></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('js/jquery.js')); ?>"></script>
    <script src="<?php echo e(asset('js/all.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/datatable.min.js')); ?>"></script>

    <script>
        $(document).ready( function () {
            let table = $('#tablita').DataTable({
                'dom':'lrtip',
                "language": {
                    "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                }
            });

            $('#tableInput').on('keyup click',function () {
               table.search($(this).val()).draw();
               console.log($('#tableInput').val());
            });
        } );
    </script>
    <script>

        $('#deleteModal').on('show.bs.modal',function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('cat-id');
            var modal = $(this);
            console.log(id);

            modal.find('.modal-body #empleado-id').val(id);
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rachel/Documents/LaravelProjectRFID/resources/views/welcome.blade.php ENDPATH**/ ?>
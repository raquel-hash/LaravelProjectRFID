<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?php echo e(asset('css/all.min.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('css/fullcalendar.min.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('css/datatable.min.css')); ?>"/>


    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Kantuta</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="<?php echo e(route('empleados.index')); ?>">Empleados</a>
            <a class="nav-item nav-link" href="<?php echo e(route('reports.jobs')); ?>">Cargos</a>
            <a class="nav-item nav-link" href="<?php echo e(route('reports.civilStatus')); ?>">Estado civil</a>
            <a class="nav-item nav-link" href="<?php echo e(route('reports.child')); ?>">Familiar</a>
            <a class="nav-item nav-link" href="<?php echo e(route('reports.age')); ?>">Edad</a>
            <a class="nav-item nav-link" href="<?php echo e(route('reports.gender')); ?>">Genero</a>
            <a class="nav-item nav-link" href="<?php echo e(route('reports.hours')); ?>">Hora</a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <?php echo e(__('Logout')); ?>

                        </a>

                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </li>
            </ul>

        </div>
    </div>
</nav>

<div class="container">
    <button class="btn btn-warning btn-lg btn-block" id="basic">Imprimir</button>
    <br>
    <?php echo $__env->yieldContent('search'); ?>
    <div id="report">
        <div class="col-sm">
            <img class="img-left" src="<?php echo e(asset('images/kantuta.png')); ?>" style="width: 30px">
            <div>
                <h1>Kantuta</h1>
            </div>
        </div>
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</div>
</body>
</html>

<?php echo $__env->yieldContent('script'); ?>
<?php /**PATH /home/rachel/Documents/LaravelProjectRFID/resources/views/layout.blade.php ENDPATH**/ ?>
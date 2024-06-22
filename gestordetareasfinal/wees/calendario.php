<?php
include('conexxion.php');
?>

<html>

<head>
    <title>Calendario</title>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style3.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
</head>

<body>

    <div class="wrapper">

        <h1 class="text-center">Calendario de Tareas</h1>

        <!-- Menu -->
        <div class="navcal">
            <nav>
                <ul>
                    <?php if (isset($_SESSION['correo'])) { ?>
                        <a href="index.php">Inicio</a>
                        <a href="calendario.php">Calendario</a>
                        <a href="actualizardatos.php">Perfil</a>
                        <a href="cerrar_sesion.php">Cerrar Sesion </a>
                    <?php } else { ?>
                        <a href="index.php">Inicio</a>
                        <a href="registrarse.php">Registrarse</a>
                        <a href="login.php">Iniciar Sesion</a>
                    <?php } ?>
                </ul>
            </nav>
        </div>

        <!-- Contenido del calendario -->
        <div class="calendario-content">
            <div id="calendario"></div>

            <script>
                $(document).ready(function () {
                    $('#calendario').fullCalendar({
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'month,agendaWeek,agendaDay'
                        },
                        events: [
                            <?php
                            $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                            $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

                            $id_usuario_actual = $_SESSION['usuario_id'];
                            $sql = "SELECT nombre_tarea, limite FROM tareas WHERE id_usuario = $id_usuario_actual";
                            $res = mysqli_query($conn, $sql);

                            if ($res == true) {
                                $count_rows = mysqli_num_rows($res);
                                if ($count_rows > 0) {
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $nombre_tarea = $row['nombre_tarea'];
                                        $limite = $row['limite'];
                                        ?>
                                        {
                                            title: '<?php echo $nombre_tarea; ?>',
                                            start: '<?php echo $limite; ?>',
                                            allDay: true
                                        },
                                <?php
                                    }
                                }
                            }
                            ?>
                        ]
                    });
                });
            </script>
        </div>
        <!-- Fin del contenido del calendario -->

    </div>
</body>

</html>


<?php include("../bd/conexion.php");
include("../validaciones/validasesion.php"); ?>

<?php

//if(isset($_GET['idCorres'])){}

$sql = "SELECT * from chats_correspon Where De ='$_SESSION[idUsuario]'";
$result = mysqli_query($conexion, $sql);



?>
<?php
$_SESSION['idCorres']="54";
if ($_SESSION['idCorres']="54") {
    $acciDesabi = "";
    $idCorres = $_SESSION['idCorres'];
    $sqlChat = "SELECT * from chat Where idCorres = '$idCorres'";
    $resultChat = mysqli_query($conexion, $sqlChat);
    if (mysqli_num_rows($resultChat) == 0) {
        $NoHay = "No hay registros";
    } else {
        $NoHay = "";
        $idEm = $columnaPubliC['Usuario_idUsuario'];
        while ($filasChat = mysqli_fetch_array($resultChat)) { ?>
            <ul class="m-b-0">
                <?php if ($filasChat['Envia_Usuarioid'] == $_SESSION['idUsuario']) { ?>
                    <li class="clearfix">
                        <div class="message-data text-right">
                            <!--<p style="text-align: right;"><span class="message-data-time" style="font-size: 10px;"><?php echo $filasChat['Tiempo_mensaje'] ?></span>-->
                            <p style="text-align: right;"> <img src="../img/Users.png" color="#01997A;" alt="avatar"></p>
                        </div>
                        <div class="message other-message float-right" style="min-width: 300px;"><?php echo $filasChat['Mensaje'] ?></div>
                    </li>
                <?php } elseif ($filasChat['Envia_Usuarioid'] == $idEm) { ?>
                    <li class="clearfix">
                        <div class="message-data">
                            <!--<p class="message-data-time-left" ><?php echo $filasChat['Tiempo_mensaje'] ?></p>-->
                        </div>
                        <div class="message my-message" style="float:left; min-width: 300px;"><?php echo $filasChat['Mensaje'] ?></div>
                    </li>

                <?php } ?>

            </ul>

<?php }
    }
} else {
    $NoHay = "No has seleccionado un chat";
    $acciDesabi = "disabled";
}
echo $NoHay;  ?>

<?php 

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "barbaridade";

  $conn = mysqli_connect($servername, $username, $password);

  mysqli_set_charset($conn,"utf8");

  if(!$conn) {
    die("Falha na conexão: " . msqli_connect_error());
  }

  if (!mysqli_select_db($conn, $dbname)){
    echo "Não foi possível selecionar a base de dados \"$dbname\":" . mysqli_error($conn);
    exit;
  }

  $name = $_POST["name"];
  $phone = $_POST["phone"];
  $day = $_POST["day"];

  $sql_disp = "SELECT idMesa FROM mesas";

  $getDisp = mysqli_query($conn, $sql_disp);

  $sql_mesaReserv = "SELECT DISTINCT mesa as idMesa FROM reservas WHERE dia = '$day'";

  $getMesasReserv = mysqli_query($conn, $sql_mesaReserv);

  if (!$getMesasReserv) {
      die("Falha na Execução da Consulta: " . $sql ."<BR>" .
          mysqli_error($conn));
  }

  
  $sql_horario = "SELECT horario FROM horarios";

  $getHorarios = mysqli_query($conn, $sql_horario);

  if (!$getHorarios) {
      die("Falha na Execução da Consulta: " . $sql ."<BR>" .
          mysqli_error($conn));
  }


?>

<!DOCTYPE html>
<html>
  <head>
    <title>BARBARIDADE</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <link rel="sortcut icon" href="images/logo.png" type="image/png" />

    <style type="text/css">
      .container-fluid{
        padding: 0px !important;        
       }
        

    </style>    

  </head>

  <body>

    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light "> 
            <a class="navbar-brand" href="#">BARBARIDADE</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="goToReservas.php">Reservas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="confirmacao.php">Confirmação</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contato</a>
                </li>
                </ul>
            </div>        
        </nav>

        <div class="row justify-content-center no-gutters">   
            <div class="col-6"><br>
                <form method="POST" action="salvarReserva.php">
                    
                    <div class="form-group">

                        
                        <?php
                            $mesas =[];
                            while($row = mysqli_fetch_assoc($getDisp)){
                                array_push($mesas, $row["idMesa"]);
                            }  
                            //var_dump($mesas);

                            $mesasR =[];
                            while($row = mysqli_fetch_assoc($getMesasReserv)){
                                array_push($mesasR, $row["idMesa"]);
                            }  
                            //var_dump($mesasR);  
                            
                            if($mesasR == NULL || $mesasR == []){
                                //echo "ENTROU";
                                foreach($mesas as $m){
                                    $mesasR = array('idMesa' => $m);
                                }
                            }
                            //var_dump($mesas);
                            if ($mesas == $mesasR) {
                                //echo "ENTROU";
                                var_dump($mesas);
                                foreach($mesas as $m){
                                    $mesasD = array('idMesa' => $m);
                                }
                            }
                            else {
                                $mesasD = array_diff($mesas, $GLOBALS['mesasR']);
                            }
                        ?>
                        <label for="chooseTable">Escolha sua mesa:</label>
                        <select class="form-control" name="table" id="chooseTable">
                        <?php     
                            foreach ($mesasD as $m){                                
                                echo '<option>'.$m.'</option>';                               
                            }                               
                        ?>                    
                        
                        </select>
                    </div>
            
                    <div class="form-group">
                    <label for="chooseTime">Escolha seu horário:</label>
                        <select class="form-control" name= "time" id="chooseTime">
                        <?php 
                            while ($horarios = mysqli_fetch_assoc($getHorarios)) {
                                echo '<option>'.$horarios['horario'].'</option>';
                            }                                                             
                           
                        ?> 
                        </select>
                    </div>

                    <input id="name" name="name" type="hidden" value=<?php echo $name;?>>
                    <input id="phone" name="phone" type="hidden" value=<?php echo $phone;?>>
                    <input id="day" name="day" type="hidden" value=<?php echo $day;?>>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="checkConfirm">
                        <label class="form-check-label" for="checkConfirm">Estou ciente que para a garantia desta reserva devo realizar a confirmação, neste site, até um dia antes da data escolhida.</label>
                    </div> <br>
                    <button type="submit" class="btn btn-primary">Reservar</button>
                </form>
            </div>            
        </div>    
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
  </body>

</html>
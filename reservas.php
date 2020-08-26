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


  $name = $_POST["client_name"];
  $phone = $_POST["client_phone"];
  $dataAtual = date('Y/m/d', strtotime('now'));
  $sql = "SELECT * FROM reservas WHERE nome_cliente = '$name' AND tel_cliente = '$phone' AND confirmed = '1' AND dia >= '$dataAtual'";

  $resultado = mysqli_query($conn,$sql) or die("Erro ao retornar dados");

  $sql = "SELECT idReserva, mesa, dia, horario, nome_cliente, tel_cliente, data_confirm FROM resultado";


  if (!$resultado) {
    die("Falha na Execução da Consulta: " . $sql ."<BR>" .
        mysqli_error($conn));
  }
  
  function createCards() {    
      while ($row = mysqli_fetch_assoc($GLOBALS['resultado'])) {
      echo '<div class=" col-lg-4 col-md-4 col-sm-6 col-10 "> <br>';
      echo  '<div class="card shadow-sm p-3 mb-5 bg-white rounded" style="width: 20rem;">' ; 
      echo    '<div class="card-body">' ;
      echo      '<h5 class="card-title"> Reserva para o dia ' .date('d/m/Y', strtotime($row["dia"])) .'</h5>';            
      echo      '<p class="card-text">Nome: '.$row["nome_cliente"] .'</p>';
      echo      '<p class="card-text">Mesa: '.$row["mesa"] .'</p>';
      echo      '<p class="card-text">Hora: '.$row["horario"] .'</p>';
      echo    '</div>';
      echo  '</div>';
      echo '</div>';
      echo '<br>';
    }       
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
      .container-fluid {
        padding: 0 !important;
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
                
                </ul>
            </div>        
        </nav>

        <?php
           if (mysqli_num_rows($resultado) == 0) {
            echo "<div class='alert alert-info' role='alert'>
                    Você não possui reservas cadastradas. Realize sua reserva na aba Home.
                  </div>";    
              exit;
          }
        ?>
        <br> <h3 class="ml-5">SUAS RESERVAS:</h3>
        <div class="row justify-content-start mt-5 ml-5 no-gutters">
            <?php createCards(); ?>       
        </div> 

           
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </body>

</html>

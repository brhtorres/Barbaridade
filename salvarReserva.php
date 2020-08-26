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
  $table = $_POST["table"];
  $day = $_POST["day"];
  $time = $_POST["time"];
  $data_confirm = date('Y/m/d', strtotime('-1 day', strtotime($day))); 
  $confirmed = false; 

  $sql = "INSERT INTO reservas (nome_cliente, tel_cliente, mesa, dia, horario, data_confirm, confirmed) VALUES ('$name', '$phone', '$table', '$day', '$time', '$data_confirm', '$confirmed')";
  
  $result = mysqli_query($conn, $sql);


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

        <div class="row justify-content-center no-gutters">
            <div class="col-6"> <br>
              <?php 
                if ($result) {
                  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                          Reserva efetuada com sucesso.<strong> Lembre-se de confirmá-la.</strong> 
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                          </button>
                        </div>";
                } else {
                  echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                          Ouve um problema no recebimento de sua reserva. Tente novamente.
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                          </button>
                        </div>";
                    exit;
                }           
              
              ?>
                <form>
                  <fieldset disabled>
                    <div class="form-group">
                          <label for="clientName">Nome:</label>
                          <input type="text" name = "name" class="form-control" id="inputName" placeholder= "<?php echo $name;?>" >
                      </div>
                      <div class="form-group">
                          <label for="phone">Telefone:</label>
                          <input type="tel" name = "phone" class="form-control" id="phone" placeholder= "<?php echo $phone;?>">
                      </div>  

                      <div class="form-group">
                          <label for="chooseTable">Mesa:</label>
                          <input type="text" name = "table" class="form-control" id="chooseTable" placeholder= "<?php echo $table;?>">
                      </div>
                      <div class="form-group">
                          <label for="date">Data:</label>
                          <input type="text" name = "date" class="form-control" id="data" placeholder= "<?php echo date('d/m/Y', strtotime($day));?>">
                      </div>  
                      <div class="form-group">
                        <label for="chooseTime">Horário:</label>
                        <input type="text" name = "time" class="form-control" id="chooseTime" placeholder= "<?php echo $time;?>">
                      </div>
                  </fieldset disabled>
                </form>
                <div class="row justify-content-center">
                    <a href= "index.php"><button type="button" class="btn btn-primary">Voltar à Página Inicial</button></a> &nbsp
                    <a href= "confirmacao.php"><button type="button" class="btn btn-info">Ir para Confirmações</button></a>                  
                </div>               

            </div>
        </div>    
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </body>

</html>


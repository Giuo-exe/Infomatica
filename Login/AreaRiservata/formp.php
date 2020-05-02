<?php
  session_start();

  include "connection.php";

  $username = $_SESSION['username'];
  echo $username;
  $day=$_GET['day'];
  $month=$_GET['month'];
  $year=$_GET['year'];
  $time=$_GET['time'];

  $date="$year-$month-$day $time:00";

  if(isset($_POST['conferma'])){
    if(isset($_POST['note'])&&isset($_POST['copie'])&&isset($_POST['pagine'])&&isset($_POST['tipo'])){

      $note = $_POST['note'];
      $copie = $_POST['copie'];
      $pagine = $_POST['pagine'];
      $tipo = $_POST['tipo'];
      $costo=00.00;

      if($tipo="A3")
        $costo = $copie * $pagine * 0.10;
      else if($tipo="A4")
        $costo = $copie * $pagine * 0.05;

        echo $costo;


      if(isset($_FILES['fileToUpload'])){
          $target_dir = "caricamenti/";
          $filename = basename($_FILES["fileToUpload"]["name"]);
          $target_file = $target_dir .   $filename ;
          $uploadOk = 1;
          $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
          echo "<label>dasdasyudasd</label>";

          if (file_exists($target_file)) {
              echo "Sorry, file already exists.";
              $uploadOk = 0;
          }
          // Check file size
          if ($_FILES["fileToUpload"]["size"] > 5000000) {
              echo "Sorry, your file is too large.";
              $uploadOk = 0;

          }
          // Allow certain file formats
          if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
          && $imageFileType != "pdf" ) {
              echo "Mi dispiace, solo JPG, JPEG, PNG & PDF sono accettati.";
              $uploadOk = 0;
          }
          // Check if $uploadOk is set to 0 by an error
          if ($uploadOk == 0) {
              echo "Sorry, your file was not uploaded.";
          // if everything is ok, try to upload file
          } else {
              if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                  echo "Il file ". basename( $_FILES["fileToUpload"]["name"]). " è stato caricato.";

                  $conn=connect();

                  // Insert some values
                  $sql = "INSERT INTO file (nome,path) VALUES ('$filename','$target_file')";


                  // Commit transaction
                  $conn=connect();
                      if ($conn->query($sql) === TRUE) {
                        echo "Dati Inseriti";

                          $sql = "INSERT INTO prenotazione(n_copie,costo,note,richiedente,date,tipo,pagine,nome_file)
                            values('$copie','$costo','$note','$username','$date','$tipo','$pagine','$filename')";

                          if ($conn->query($sql) === TRUE) {
                              echo "Dati Inseriti";

                          }else{
                          echo "Errore nella query: " . $conn->error;
                          }
                      }else{
                        echo "Errore nella query: " . $conn->error;
                      }

                  $conn->close();
                  header("refresh:2; url=index.php");
              } else {
                  echo "Sorry, there was an error uploading your file.";
              }
          }
        }else{
          $sql="Insert into prenotazione(n_copie,costo,note,richiedente,date,tipo,pagine)
            values('$copie','$costo','$note','$username','$date','$tipo','$pagine')";
            $conn=connect();
                if ($conn->query($sql) === TRUE) {
                  echo "Dati Inseriti";

                    header("refresh:2; url=index.php");

                } else {
                  echo "Errore nella query: " . $conn->error;
                }

            $conn->close();
        }
  }else{
    echo "<h1>Devi inserire tutti i dati!<h1>";
  }
}
?>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Prenota</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/styleform.css">
</head>
<body>
  <div id='stars'></div>
  <div id='stars2'></div>
  <div id='stars3'></div>
  <form method='POST' action='' enctype="multipart/form-data">
    <label>Pagine</label>
    <input type='number' name='pagine' min='1'><br>

    <label>Note Aggiuntive</label>
    <input type='text' name='note'><br>

    <label>Classe</label>
      <input type='text' value=<?php echo $_SESSION['classe'];?> name='classe'><br>

    <label>Copie</label>
    <input type='number' name='copie' min='1'><br>

    <div class='radio-group'>
      <label>
        <input type='radio' value='A3' name='tipo'>
        <label>A3<label>
        <span></span>
      </label>
      <label>
        <input type='radio' value='A4' name='tipo'>
        <label>A4<label>
        <span></span>
      </label>
    </div>
    <label>Upload file<label>
    <input type="file" name="fileToUpload" value="fileToUpload" id="fileToUpload">
    <input type='submit' name='conferma'>
  </form>
</body>

</html>

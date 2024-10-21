<?php
$con = new mysqli("localhost","root","","notes",4306);
if($con->connect_error){
  echo $con->connect_error;
}
else{
  echo "connection sucessfull";
}

?>

<!doctype html>
<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">

    <title>PHP CURD</title>
  </head>
  <body>
          <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <div class="container-fluid">
                      <a class="navbar-brand" href="#">PHP CURD</a>
                      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                      </button>
                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                          <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                          </li>
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Dropdown
                            </a>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="#">Action</a></li>
                              <li><a class="dropdown-item" href="#">Another action</a></li>
                              <li><hr class="dropdown-divider"></li>
                              <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                          </li>
                        </ul>
                        <form class="d-flex" role="search">
                          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                          <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                      </div>
                    </div>
                  </nav>
                  <div class="container my-3">
                    <h2>ADD NOTE</h2>
                    <form>
                              <div class="mb-3">
                                <label for="title" class="form-label">NOTE TITLE</label>
                                <input type="text" class="form-control" id="title" name="title">
                              </div>
                                <div class="mb-3">
                                        <label for="description" class="form-label">NOTE DESCRIPTION</label>
                                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                      </div>
                              <button type="submit" class="btn btn-primary">Add NOTE</button>
                            </form>
                            
                  </div>
                  <div class="container">
                <?php
                $sql = "Select * from `notes_info`";
                $result = mysqli_query($con,$sql);
                while($row=mysqli_fetch_assoc($result)){
                  echo $row['sno'] ."TITLE". $row['title']."disc is ".$row['description']."<br>";
                }
                ?>
                <table class="table">
                <thead>
                <?php
                $sql = "Select * from `notes_info`";
                $result = mysqli_query($con,$sql);
                while($row=mysqli_fetch_assoc($result)){
                  echo 
                  "<tr>
                  <th scope='row'>".$row['sno']."</th>
                  <td>".$row['title']."</td>
                  <td>".$row['description']."</td>
                  <td>".$row['tstamp']."</td>
                </tr>";
                }
                ?>
                </thead>
                <tbody>
                </tbody>
              </table>
                                </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    -->
  </body>
</html>
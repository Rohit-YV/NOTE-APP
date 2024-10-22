<?php
$insert = false;
$con = new mysqli("localhost","root","","notes",4306);
if($con->connect_error){
  echo $con->connect_error;
}
else{
  echo "connection sucessfull";
}
echo $_SERVER["REQUEST_METHOD"];
if ($_SERVER['REQUEST_METHOD']=='POST'){
    $title=$_POST["title"];
    $description=$_POST["description"];
    $stm = $con->prepare("INSERT INTO `notes_info`(`title`, `description`) VALUES (?, ?)");

   if($stm){
    $stm->bind_param("ss",$title,$description);
   }
   if($stm->execute()){
    // echo "data inserted sucessfully";
    $insert = true;
   }
   else {
    echo "error" . $stm->error;
   }
   $stm->close();
}
else{
  echo "error on preparing the data".$con->error;
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
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    
    <title>PHP CURD</title>
    <script>
      edits = document.getElementsByClassName('edit');
      Array.form(edits).forEach(element => {
        element.addEventListener("click",(e))=>{
          console.log('edit',e)
        }
        
      });
    </script>
  </head>
  <body>
    
<!-- Button EDIT modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editmodal">
  Edit Modal
</button> -->
<!-- Modal -->
<div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="editmodalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editmodal">Edit</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
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
                  <?php
                  if($insert){
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>SUCESS!</strong> You NOTE HAS BEEN INSERTED SUCESSFULLY.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
                  }
                  ?>
                  <div class="container my-4">
                    <h2> NOTE APP </h2>
                    <form method="post" action="/curd/index.php">
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
                <table class="table" id="myTable">
                  <thead>
                    <tr>
                      <td>
                        sno
                      </td>
                      <td>
                        TITLE
                      </td>
                      <td>
                        DESCRIPTION
                      </td>
                      <td>
                        TIMESTAMP
                      </td>
                      <td>
                        Action
                      </td>
                    </tr>
                  </thead>
                <?php
                $sql = "Select * from `notes_info`";
                $result = mysqli_query($con,$sql);
                $sno = 0;
                while($row=mysqli_fetch_assoc($result)){
                  $sno = $sno + 1;
                  echo 
                  "<tr>
                  <th scope='row'>".$sno."</th>
                  <td>".$row['title']."</td>
                  <td>".$row['description']."</td>
                  <td>".$row['tstamp']."</td>
                  <td><a class='edit' href=/EDI>EDIT</a> <a href=/del>DELETE</a></td>
                </tr>";
                }
                ?>
                <tbody>
                </tbody>
              </table>
                                </div>
                                <hr>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    
          <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script>
      let table = new DataTable('#myTable');
    </script>
  </body>
</html>

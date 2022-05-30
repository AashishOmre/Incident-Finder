<?php
  
  //connecting variables
  $server = "localhost:3307";
  $username ="root";
  $password = "";
  $dbname="incident_finder";
  
  $con=mysqli_connect($server,$username,$password,$dbname);
  
  if(!$con){
     die("Failed to connect :".mysqli_connect_error());
  }
  else{
      // echo "Connection successfully established";
  }
  
  $sql=" SELECT* FROM `images`";
  $result=mysqli_query($con,$sql); 
  
  $sql1=" SELECT* FROM `list`";
  $result1=mysqli_query($con,$sql1);


  

  //delete
  if(isset($_GET['delete'])){
    $id=$_GET['delete'];
 
    $sql2="DELETE FROM `list` WHERE `list`.`keywords` = '$id\r';";
    $sql3="DELETE FROM `list` WHERE `list`.`keywords` = '$id';";
    $result2=mysqli_query($con,$sql2);
    $result3=mysqli_query($con,$sql3);
      if($result2 || $result3){
    
      // echo "Deleted";
      }
      else{
        echo "Not deleted"; 
      }   

  }
  
  //find the number of records return
  // echo mysqli_num_rows($result);
  
  ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>INCIDENT FINDER</title>
</head>

<body>


  <div class="main-cont">
    <h1>INCIDENT FINDER</h1>

    <div class="btn">
      <button id="btn1">LIST</button>
      <button id="btn2">ADD KEYWORDS</button>
      <button id="btn3">SHOW KEYWORDS</button>
    </div>

    <div class="main-content">
      <div class="content1 content">
        <table>
          <tr class="navbar">
            <th>ID</th>
            <th>IMAGE NAME</th>
            <th>KEYWORD FOUND</th>
            <th>LOG DATE</th>
          </tr>

          <?php
                while($rows=mysqli_fetch_assoc($result)){
               ?>
          <tr>
            <td>
              <?php echo $rows['id']; ?>
            </td>
            <td>
               <?php echo $rows['image_name'];?>
            </td>
            <td>
              <?php echo $rows['keyword_found'];?>
            </td>
            <td>
              <?php echo $rows['log_date']; ?>
            </td>
          </tr>
          <?php
                }
             ?>
        </table>
      </div>
      
       <!-- <div class="content2 content"> -->
         <form method="post"  class="content2 content" >
           <h3>Keywords</h3>
           <textarea name="searchstr" id="searchstr" cols="30" rows="10"></textarea>
           <input type="submit" value="submit" class="subbtn">
          <?php     
             
            

              if(isset($_POST['searchstr'])){

                     $str=$_POST['searchstr'];

                    //  echo $_POST['searchstr'];

                       $arr = explode("\n", $str);   
                      // print_r($arr);

                    
                        if($_SERVER['REQUEST_METHOD']=='POST'){ 
                          
                          foreach ($arr as $key => $value) {   
                           
                           $sql="INSERT INTO `list` (`keywords`) VALUES ('$value');";
                           $result=mysqli_query($con,$sql) ;  
                
                        }
                      
                      }
                      
                } 
                 
            
          ?>
          
         </form>
        
           <!-- Modal -->
  <div class="content content3">
    <table>
      <thead id="navbar">
        <tr>
          
          <th scope="col">KEYWORD</th>
          <th scope="col">ACTION</th>
        </tr>
      </thead>
      <tbody class="tablebody">
        <?php
    
       while($rows=mysqli_fetch_assoc($result1)){
        
      ?>
        <tr>
          <td>
            <?php echo $rows['keywords']; ?>
          </td>
          <td>
            <?php
          echo "<button class='delete cont3btn' id=".$rows['keywords'].">Delete</button>";
           ?>
          </td>
        </tr>
        <?php
       }
    ?>
      </tbody>
    </table>
    <div>

    </div>
  </div>




  <script src="index.js"></script>

</body>

</html>
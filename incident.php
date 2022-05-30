<?php
 header('Content-Type:Application/json');

 
$image = isset($_FILES['image_name'])?$_FILES['image_name']:'';

$log_date = isset($_POST['log_date'])?$_POST['log_date']:'';

if($image['error'] > 0 || empty($log_date)):
    $res = array(
        'status' => 'error',
        'msg' => 'Input Parameters is missing!'
    );
    echo json_encode($res);
    exit;
endif;


// save image to disk from $_FILE['tmp'];




// // OCR (shell_exec)

define ('SITE_ROOT','D:\\XM\\htdocs\\images\\');


if(isset($_FILES['image_name'])){
  $file_name = $_FILES['image_name']['name'];
  $file_tmp =$_FILES['image_name']['tmp_name'];
  move_uploaded_file($file_tmp,SITE_ROOT.$file_name);
  //echo "<h3>Image Upload Success</h3>";
  
  shell_exec('"D:\\Tesseract-OCR\\tesseract" "D:\\XM\\htdocs\\images\\'.$file_name.'" out');
  
  // echo "OCR after reading";

  $myfile = fopen("out.txt", "r") or die("Unable to open file!");
  // echo fread($myfile,filesize("out.txt"));
  fclose($myfile);
  
 }

// GET keywords from db

 //connecting variables
 $server = "localhost:3307";
 $username ="root";
 $password = "";
 $dbname="incident_finder";
 
 $con=mysqli_connect($server,$username,$password,$dbname);
 
 if(!$con){
   // die("Failed to connect :".mysqli_connect_error());
 }
 else{
     // echo "Connection successfully established";
 }


$sql="SELECT keywords from `list`";
$query = mysqli_query($con,$sql);
$array = array();

while($row = mysqli_fetch_assoc($query)){
  $array[] = $row;
}


// Search keyword in ocr text (strpos, strstr, preg_match)
$filename='out.txt';
$flag=false;
$file=file_get_contents($filename);


for($i=0;$i<sizeof($array);$i++){
 $keyword=$array[$i]['keywords']; 
 
 if(strpos($file,$keyword)){
    //echo "$keyword :  found ";
     $flag=true;
  $res = array(
      'status' => 'success',
      'msg' => 'OCR success'
  );
  echo json_encode($res);
  

  $imagename = $_FILES['image_name']['name'];
  $sql="INSERT INTO `images` (`image_name`, `keyword_found`, `log_date`) VALUES ( '$imagename', '$keyword', NOW());";

  $result=mysqli_query($con,$sql);
  
    
 }
 
 
}

// If found make entry in list table.

if(!$flag){
$res = array(
      'status' => 'failure',
      'msg' => 'OCR success'
  );
  echo json_encode($res);
}
  

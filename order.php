<?php
session_start();
$fname= $_POST["fname"];
$lname= $_POST["lname"];
$address= $_POST["address"];
$mobile= $_POST["mobile"];
$servername="localhost";
$username="id19671307_root";
$password="Pop@27032545";
$dbname="id19671307_show_product";
$con=mysqli_connect($servername,$username,$password,$dbname);
if(!$con) die("Connnect mysql database fail!!".mysqli_connect_error());
//echo "Connect mysql successfully!";
$sql="INSERT INTO order_product (fname, lname,address,mobile)";
$sql.="VALUES ('$fname', '$lname', '$address','$mobile');";
//echo $sql;
if (mysqli_query($con, $sql)) {
    $last_id = mysqli_insert_id($con);
    //echo "New record created successfully. Last inserted ID is: " . $last_id;
    // loop in session cart and insert each item to database
    $sql1="INSERT INTO order_details (order_id,product_id) VALUES ";
    for($i=0;$i<count($_SESSION["cart"]);$i++){
        $item_id=$_SESSION["cart"][$i]['id'];
        $sql1.="('$last_id','$item_id')";
        if($i<count($_SESSION["cart"])-1)
         $sql1.=",";
        else
         $sql.=";";
    }
    //echo $sql1;
    if(mysqli_query($con,$sql1)){
      echo "<h2>บันทึกข้อมูลการสั่งซื้อเรียบร้อยแล้ว</h2>";
    }
    else "เกิดข้อผิดพลาดในการสั่งซื้อ";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
$sql= "SELECT * FROM `order_product`,`order_details`,`product` WHERE `order_product`.id=`order_details`.order_id AND `order_details`.product_id =  `product`.id AND `order_details`.order_id=$last_id";
$result1=mysqli_query($con,$sql);
$result2=mysqli_query($con,$sql);
if(mysqli_num_rows($result1)>0){
  $row=mysqli_fetch_assoc($result1);
  echo "<table>
    <tr>
      <th id=\"order_table\">Date and Time</th>
      <th>".$row["order_date"]."</th>
    </tr>
    <tr>
      <th id=\"order_table\">Firstname</th>
      <th>".$row["fname"]."</th>
    </tr>
    <tr>
      <th id=\"order_table\">Lastname</th>
      <th>".$row["lname"]."</th>
    </tr>
    <tr>
      <th id=\"order_table\">Mobile number</th>
      <th>".$row["mobile"]."</th>
    </tr>
    <tr>
      <th id=\"order_table\">Address</th>
      <th>".$row["address"]."</th>
    </tr>
    
  </table>";
}else{
  echo "0 results";
}
if(mysqli_num_rows($result1)>0){
  $total = 0;
  echo "<table id=\"product_table\" border=1>
    <tr id=\"product_top\">
      <th>Name</th>
      <th>Description</th>
      <th>Price</th>
    </tr>";
  while($data=mysqli_fetch_assoc($result2)){
    echo "<tr>
      <td>".$data["name"]."</td>
      <td>".$data["description"]."</td>
      <td>".$data["price"]."</td>
    </tr>";
    $total+=$data['price'];
  }
  echo "</table>";
  echo "<h1>ราคาสินค้า $total บาท</h1>";
}else{
  echo "0 results";
}
  mysqli_close($conn);
//$result=mysqli_query($con,$sql);
//$numrow=mysqli_num_rows($result);
?>

<style>
  #order_table{
    text-align: left;
    width: 200px;
  }

  #product_table{
    margin-top: 20px;
  }

  #product_table tr{
    height: 40px;
    text-align: center;
  }

  #product_top{
    background-color: #FAEDCD;
  }
</style>
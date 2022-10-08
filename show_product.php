<?php
session_start();
$servername="localhost";
$username="id19671307_root";
$password="Pop@27032545";
$dbname="id19671307_show_product";
$per_page=2;
if(isset($_GET["page"])) $start_page=$_GET["page"]*$per_page;
else $start_page=0;
$con=mysqli_connect($servername,$username,$password,$dbname);
if(!$con) die("Connnect mysql database fail!!".mysqli_connect_error());
$sql="SELECT * FROM product";
$result=mysqli_query($con,$sql);
$numrow=mysqli_num_rows($result);
echo "<link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css\">";
echo "<br>".$numrow." Records<br>";
for($i=0;$i<ceil($numrow/$per_page);$i++)
    echo "<a href='show_product.php?page=$i'>[".($i+1)."]</a>";
$sql="SELECT * FROM product LIMIT $start_page,$per_page";
$result=mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0){
    echo "<table border=1><tr><th>ID</th><th>Name</th><th>Description</th><th>Price</th><th>Image</th><th></th></tr>";
    while($row=mysqli_fetch_assoc($result)){
    echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>";
    echo $row["description"]."</td><td>".$row["price"]."</td>";
    echo "<td><img src=\"PerfectPics/".$row['image']."\" alt=\"".$row['image']."\"></td>";
    echo "<td><a href='add_product.php?id=".$row["id"]."'>ใส่ตระกร้า</a></td></tr>";
    }
    echo "</table>";
}else{
    echo "0 results";
}
if(isset($_POST["cart"])){
    array_splice($_SESSION["cart"],0,count($_SESSION["cart"]));
}
if(isset($_SESSION["cart"])){
    $total=0;
    if(count($_SESSION["cart"])>0){
        echo "<h1>ตระกร้าสินค้า</h1>";
        echo "<table border=1><tr><th>ลำดับ</th><th>ID</th><th>Name</th><th>Description</th><th>Price</th></tr>";
        for($i=0;$i<count($_SESSION["cart"]);$i++)
        {
            $item=$_SESSION["cart"][$i];
            echo "<tr id=\"cart_table\"><td>".($i+1)."</td>";
            echo "<td>".$item['id']."</td>";
            echo "<td>".$item['name']."</td>";
            echo "<td>".$item['description']."</td>";
            echo "<td>".$item['price']."</td>";
            echo "<td id=\"del\"><a href='del_cart.php?i=".$i."'>";
            echo "<i id=\"del_icon\" class=\"fa-solid fa-xmark\"></i></a></td></tr>";
            $total+=$item['price'];
        }
        echo "</table>";
        echo "<form method=\"post\">";
        echo "<input type=\"submit\" name=\"cart\" value=\"ลบรายการทั้งหมด\">";
        echo "</form>";   
        echo "<h1>ราคาสินค้า $total บาท</h1>";
        echo "<h2><a href='checkout.php'>สั่งซื้อ</a></h2>";
    }
    
}
mysqli_close($con);
?>

<style>
    table td {
        text-align: center;
    }
    
    table {
        margin-top: 15px;
    }

    th {
        background-color: #FAEDCD;
    }

    input {
        font-size: 20px;
        background-color: #CCD5AE;
        border-radius: 5px;
        border: 1px;
        height: 50px;
        width: 300px;
    }

    form {
        margin-top: 15px;
    }

    #cart_table {
        height: 50px;
    }

    #del{
        font-size: 30px;
        border: 0px;
    }

    #del_icon {
        color: red;
    }

    #del_icon:hover {
        color: #FF8585;
    }

    input[type="submit"]:hover {
        border: 2px solid black;
        background-color: #E9EDC9;
    }


</style>

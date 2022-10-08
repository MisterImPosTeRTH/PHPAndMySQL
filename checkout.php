<?php
session_start();

if(isset($_SESSION["cart"])){
    echo "<link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css\">";
    echo "<h1>สรุปรายการสินค้า</h1>";
    $total=0;
    echo "<h1>ตระกร้าสินค้า</h1>";
    echo "<table border=1><tr><th>ลำดับ</th><th>id</th><th>name</th><th>description</th><th>price</th></tr>";
        for($i=0;$i<count($_SESSION["cart"]);$i++)
        {
            $item=$_SESSION["cart"][$i];
            echo "<tr id=\"checkout_tb\"><td>".($i+1)."</td>";
            echo "<td>".$item['id']."</td>";
            echo "<td>".$item['name']."</td>";
            echo "<td>".$item['description']."</td>";
            echo "<td>".$item['price']."</td>";
            echo "<td id=\"del\"><a href='del_cart.php?i=".$i."'>";
            echo "<i id=\"del_icon\" class=\"fa-solid fa-xmark\"></i></a></td></tr>";
            $total+=$item['price'];
        }
    echo "</table>";
    echo "<h1>ราคาสินค้า $total บาท</h1>";
?>
        <form action="order.php" method="post">
        <label for="fname">First name:</label><br>
        <input type="text" id="fname" name="fname" value=""><br>
        <label for="lname">Last name:</label><br>
        <input type="text" id="lname" name="lname" value=""><br>
        <lable for="address">Address:</label><br>
        <textarea id="address" name="address"  rows="4" cols="50"></textarea><br>
        <lable for="mobile">Mobile number:</label><br>
        <input type="text" id="mobile" name="mobile" value=""><br>
        <input type="submit" value="Submit">
        </form> 
<?php
}
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

    #checkout_tb {
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

    input[type="submit"]{
        margin-top: 15px ;
        font-size: 20px;
        background-color: #CCD5AE;
        border-radius: 5px;
        border: 1px;
        height: 50px;
        width: 300px;
    }

    input[type="submit"]:hover {
        border: 2px solid black;
        background-color: #E9EDC9;
    }
</style>
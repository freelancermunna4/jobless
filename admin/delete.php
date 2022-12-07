<?php 
        require_once"../system/functions.php";

if(isset($_GET['src'])){
    $src = $_GET['src'];
    $id = $_GET['id'];
}

if($src == 'running-product'){
   $delete = $db->Query("DELETE FROM product_system WHERE id=$id");
   if($delete){
       header("location:running-product.php");
   }
}elseif($src == 'pending-product'){
    $delete = $db->Query("DELETE FROM product_system WHERE id=$id");
    if($delete){
        header("location:pending-product.php");
    }
 }elseif($src == 'completed-product'){
    $delete = $db->Query("DELETE FROM product_system WHERE id=$id");
    if($delete){
        header("location:completed-product.php");
    }
 }elseif($src == 'product-category'){
    $delete = $db->Query("DELETE FROM product_category WHERE id=$id");
    if($delete){
        header("location:product-category.php");
    }
 }




?>
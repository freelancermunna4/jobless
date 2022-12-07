<?php
  require_once"common/header.php";
  if(isset($_GET['strt'])&& is_numeric($_GET['strt'])){
  $start=$_GET['strt'];
  }else{
    $start=0;
  }

  if(isset($_POST['submit'])){
        $category = $_POST['category'];
        $isnert = $db->Query("INSERT INTO `product_category` (`category`) VALUES ('$category');");
        if($isnert){
            header("Location:product-category?successfull");
        }
  }



?>
<div class="x_container space-y-10 py-10">


    <div class="flex flex-col rounded-lg shadow-md border border-[
        ] shadow-gray-200 bg-white">
        <div class="overflow-x-auto rounded-lg">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-auto bg-white">
                    <form action="" method="POST">
                        <div style="text-align: right;margin: 5px;padding-top: 10px;">
                            <input name="category" type="text" id="srcvalue" placeholder="Category Name" style="padding: 8px;border: 1px solid;border-radius:3px;">
                            <button type="submit" name="submit" style="padding: 10px 15px 10px 15px;margin-right: 12px;background: #0e33f78a;color:#fff;box-sizing: border-box;border-radius: 3px;">Create</button>
                        </div>
                    </form>


                    <!-- Table -->
                    <table class="min-w-full divide-y divide-gray-200 table-fixed">
                        <thead class="bg-white">
                            <tr>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-center text-gray-500 uppercase lg:p-5">Sl.</th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-center text-gray-500 uppercase lg:p-5">Category Name</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">

                            <?php $categories =$db->Query("SELECT * FROM product_category ORDER BY id DESC ");                                
                            $i=0; while($category = mysqli_fetch_assoc($categories)){ $i++ ?>
                            <tr class="hover:bg-gray-100">
                                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap text-center lg:p-5"><?php echo $i;?></td>
                                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap text-center lg:p-5"><?php echo $category['category'];?></td>

                                <td class="p-4 text-sm font-normal text-gray-500 text-center whitespace-nowrap lg:p-5">
                                    <a class="list_btn" style="background:#EF4444;" href="delete.php?src=product-category&&id=<?php echo $category['id'];?>">Delete</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                

                </div>
            </div>
        </div>
    </div>
</div>
</div>
</main>
<script src="js/app.js"></script>

</body>

</html>
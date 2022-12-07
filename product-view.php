<?php
	require_once"common/sidebar.php";
    if($ses_id){$uid=$data['id'];}
    if(isset($_GET['page'])&&is_numeric($_GET['page'])){
        $start=$_GET['page'];
    }else{
        $start=0;
    }

?>

<!--===== main page content =====-->
<div class="content">
    <div class="container">
        <div class="page_content">
            <div style="text-align: center;">
                <?php if(!empty($top_ad['code'])){  echo base64_decode($top_ad['code']);} ?>
            </div>


            <!-- filter -->
            <div class="filter_area">
                <div class="filter">
                    <div>
                    <select name="sort" id="sort">
                    <?php if($_GET['sort']){ ?>
                        <option selected style="display:none"><?php echo $_GET['sort']?></option>
                        <?php }else{?>
                        <option selected style="display:none">SORT</option>
                        <?php }?>
                        <option value="Low To High">Low To High</option>
                        <option value="High To Low">High To Low</option>
                        <option value="Old">Old</option>
                        <option value="New">New</option>
                    </select>

                    <select name="category" id="category">
                            <?php if($_GET['category']){ ?>
                            <option selected style="display:none"><?php echo $_GET['category']?></option>                                
                            <?php }else{?>
                            <option selected style="display:none">CATEGORY</option>
                            <?php }?>
                            <?php $categories =$db->Query("SELECT * FROM product_category ORDER BY id DESC");                                
                            while($category = mysqli_fetch_assoc($categories)){?>
                            <option value="<?php echo $category['category']?>"><?php echo $category['category']?></option>
                            <?php }?>
                    </select>
                </div>
                <div>
                    <form action="" method="GET">
                        <input name="src" type="search" placeholder=" Your Budget">
                        <button name="submit" type="submit">Search</button>
                    </form>
                </div>
                </div>
            </div>
            <!-- filter -->

            
            

            <div class="social_views">
                <?php

                    if (isset($_GET['page_no']) && $_GET['page_no']!="") {
                    $page_no = $_GET['page_no'];} else {$page_no = 1;}
                    $total_records_per_page = 8;
                    $offset = ($page_no-1) * $total_records_per_page;
                    $previous_page = $page_no - 1;
                    $next_page = $page_no + 1;
                    $adjacents = "2";                     
                
                if(isset($_GET['sort'])){
                    if($_GET['sort']=='Low To High'){
                        $product=$db->Query("SELECT * FROM `product_system` WHERE activity=1 AND conditions ='Running' ORDER by amount ASC");
                    }elseif($_GET['sort']=='High To Low'){
                        $product=$db->Query("SELECT * FROM `product_system` WHERE activity=1 AND conditions ='Running' ORDER by amount DESC");
                    }elseif($_GET['sort']=='Old'){
                        $product=$db->Query("SELECT * FROM `product_system` WHERE activity=1 AND conditions ='Running' ORDER by id ASC");
                    }elseif($_GET['sort']=='New'){
                        $product=$db->Query("SELECT * FROM `product_system` WHERE activity=1 AND conditions ='Running' ORDER by id DESC");
                    }else{
                        $product=$db->Query("SELECT * FROM `product_system` WHERE activity=1 AND conditions ='Running' ORDER by id DESC");
                    }

                    }elseif(isset($_GET['category'])){
                        $category = $_GET['category'];                        
                        $product=$db->Query("SELECT * FROM `product_system` WHERE activity=1 AND conditions ='Running' AND category ='$category' ORDER by id DESC"); 
                    }elseif(isset($_GET['src'])){
                        $src = $_GET['src'];
                        $product=$db->Query("SELECT * FROM `product_system` WHERE activity=1 AND conditions ='Running' AND amount  LIKE '%$src%' ORDER by id DESC"); 
                    }else{
                        $pageination = 'on';
                        $result_count = $db->Query("SELECT * FROM `product_system` WHERE activity=1 AND conditions ='Running'");                       
                        $product=$db->Query("SELECT * FROM `product_system` WHERE activity=1 AND conditions ='Running' ORDER by id DESC LIMIT $offset, $total_records_per_page");
                    }           
                
                    $total_records = mysqli_num_rows($result_count);
                    $total_no_of_pages = ceil($total_records / $total_records_per_page);
                    $second_last = $total_no_of_pages - 1;
                while($row = mysqli_fetch_assoc($product)){
                ?>
                <div class="view">
                    <div class="view_container" style="border:1px solid #c3c5cb;">
                        <div class="thumbnail">
                            <img src="upload/<?php echo $row['file']?>" style="height:145px;object-fit:cover">
                        </div>
                        <h6 style="text-align:center" class="title"><?php echo $row['product_title']?></h6>
                        <div class="time">Price: <b><?php
                        if($row['amount'] == 0){echo "Contact Fast";}else{echo $row['amount'];}?></b></div>
                        <div class="time">Category: <b><?php echo $row['category']?></b></div>
                        <div class="time">Date: <b><?php echo $row['job_time']?></b></div>
                        <div class="buttons">   
                            <a href="product-page?id=<?php echo $row['id']?>">View</a>
                        </div>
                    </div>
                </div>
                <?php }?>

            </div>
            <br />
            <br />
            
            <!-- /* ----------paginations----------- */ -->
            <?php if(isset($pageination)){?>
            <style>
                .paginations>ul{box-shadow: 0 0 1px gray;margin: 0;padding: 10px;}
                .paginations>ul>li{list-style: none;display: inline-block;line-height: 2.5;}
                .paginations>ul>li>a{padding: 5px 10px;margin:5px;background: #fff;font-weight: bolder;box-shadow: 0px 0px 2px gray;}
                .paginations>ul>li>a:hover{background: #209300;color: #fff;}
                .active>a{background: #209300 !important;color: #fff !important;}
                .page_of{padding-top: 10px;}
                @media only screen and (max-width: 850px){.page_of{display: none;}}
              </style>

              <div style="display:flex;justify-content:space-between;padding:10px 20px;">
                  <div class="paginations">
                    <ul>
                      <?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>
                        
                      <li <?php if($page_no <= 1){ echo "class=''"; } ?>>
                      <a <?php if($page_no > 1){ echo "href='?page_no=$previous_page'"; } ?>>Previous</a>
                      </li>
                          
                        <?php 
                      if ($total_no_of_pages <= 10){  	 
                        for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
                          if ($counter == $page_no) {
                          echo "<li class=''><a>$counter</a></li>";	
                            }else{
                              echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                            }
                            }
                      }
                      elseif($total_no_of_pages > 10){
                        
                      if($page_no <= 4) {			
                      for ($counter = 1; $counter < 8; $counter++){		 
                          if ($counter == $page_no) {
                          echo "<li class='active'><a>$counter</a></li>";	
                            }else{
                              echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                            }
                            }
                        echo "<li><a>...</a></li>";
                        echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                        echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                        }

                      elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
                        echo "<li><a href='?page_no=1'>1</a></li>";
                        echo "<li><a href='?page_no=2'>2</a></li>";
                            echo "<li><a>...</a></li>";
                            for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
                              if ($counter == $page_no) {
                          echo "<li class='active'><a>$counter</a></li>";	
                            }else{
                              echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                            }                  
                          }
                          echo "<li><a>...</a></li>";
                        echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                        echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
                                }
                        
                        else {
                            echo "<li><a href='?page_no=1'>1</a></li>";
                        echo "<li><a href='?page_no=2'>2</a></li>";
                            echo "<li><a>...</a></li>";

                            for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
                              if ($counter == $page_no) {
                          echo "<li class='active'><a>$counter</a></li>";	
                            }else{
                              echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                            }                   
                                    }
                                }
                      }
                    ?>
                        
                      <li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
                      <a <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>>Next</a>
                      </li>
                        <?php if($page_no < $total_no_of_pages){
                        echo "<li><a href='?page_no=$total_no_of_pages'>Last</a></li>";
                        } ?>
                    </ul>
                  </div>
                  <div class="page_of">
                    <div><strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong></div>
                  </div>
                </div>
                <?php }?>
                <!-- /* ----------paginations----------- */ -->
            

        </div>


<script type="text/javascript">
    $(function () {
        $('#sort').on('change', function () {
            var val = $(this).find("option:selected").val();
            var url = self.location.href.split('?')[0] + '?sort=' +val;
            if (url != "") {
                window.location.href = url;
            }
        });
    });

    $(function () {
        $('#category').on('change', function () {
            var val = $(this).find("option:selected").val();
            var url = self.location.href.split('?')[0] + '?category=' +val;
            if (url != "") {
                window.location.href = url;
            }
        });
    });
</script>

        <?php include"common/footer.php"; ?>

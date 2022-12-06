<?php
  require_once"common/header.php";
  if(isset($_GET['is'])&& is_numeric($_GET['is'])){
  $id=$_GET['is'];
  }else{
    header('location:users.php');
    exit;
  }

  if(isset($_POST['submit'])){
    $Phone=$db->EscapeString($_POST['Phone']);
    $email=$db->EscapeString($_POST['email']);
    $Username=$db->EscapeString($_POST['Username']);
    $Password=$db->EscapeString($_POST['Password']);
    $Coins=$db->EscapeString($_POST['Coins']);
    $select=$db->EscapeString($_POST['select']);

     $insert=_insertData($db,"UPDATE users SET mobile='$Phone',fullname='$Username',email='$email',coins='$Coins',admin='$select' WHERE id=$id");

     if(!empty($Password)){
      $ps=md5($Password);
      $insert=_insertData($db,"UPDATE users SET password='$ps' WHERE id=$id");
     }


  }

  $user=_getData($db,"SELECT * FROM users WHERE id=$id  LIMIT 1");
  if($user==0){ header('location:users.php'); exit;}

?>

      <div class="x_container space-y-10 py-10">
        <form class="grid grid-cols-2 gap-y-8 gap-x-12" action="" method="POST">
          <div class="col-span-2">
            <h2 class="text-xl font-semibold text-cyan-800">Edit User Info</h2>


          </div>

          <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
            <label for="Phone">Phone</label>
            <input name="Phone" class="input" type="text" id="Phone" placeholder="Phone" value="<?= $user['mobile'] ?>" required>
          </div>

          <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
            <label for="Email">Email</label>
            <input name="email" class="input" type="email" id="Email" placeholder="Email" value="<?= $user['email'] ?>" required>
          </div>

          <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
          <label for="Username">Full Name</label>
            <input  name="Username" class="input" type="text" id="Username" placeholder="Username" value="<?= $user['fullname'] ?>" required>
          </div>

          <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
          <label for="Password">Password</label>
            <input name="Password" class="input" type="text" id="Password" placeholder="Password">
          </div>

          <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
            <label for="Coins">Coins</label>
            <input name="Coins" class="input" type="text" id="Coins" placeholder="Coins" value="<?= $user['coins'] ?>" required>
          </div>


          <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
            <label for="UserUser">User Type</label>
            <select class="select" name="select" id="UserUser" required>
              <?php
              $vl=$user['admin'];
              if($vl==0){ ?>
              <option value="0">User</option>
              <option value="1">Admin</option>
              <?php } elseif($vl==1){?>
                <option value="1">Admin</option>
                <option value="0">User</option>
                <?php }else{?>
                  <option value="0">User</option>
                  <option value="1">Admin</option>
                  <?php } ?>

                }

            </select>
          </div>

          <div class="col-span-2 flex justify-end">
            <div class="w-fit">
              <button  name="submit" type="submit" class="button">Submit</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </main>

  <!-- All Popup -->
  <!-- Delete User Popup -->
  <div data-target="delete_user"
    class="popup_wrapper overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center md:inset-0 sm:h-full flex"
    id="delete-product-modal" style="z-index: 111; display: none;">
    <div data-target="delete_user"
      class="popup_remove w-full h-screen bg-black bg-opacity-50 z-40 fixed inset-0 m-auto"></div>
    <div class="relative px-4 w-full max-w-md h-full md:h-auto z-50">
      <div class="relative bg-white rounded-2xl shadow-lg">
        <div class="flex justify-end p-2"><button type="button" data-target="delete_user"
            class="popup_remove text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-2xl text-sm w-8 h-8 flex items-center justify-center ml-auto"
            data-modal-toggle="delete-product-modal"> <i class="fa-solid fa-xmark"></i> </button></div>
        <div class="p-6 pt-0 text-center text-5xl text-red-500"> <i class="fa-solid fa-circle-exclamation"></i>
          <h3 class="my-9 text-base font-normal text-gray-500">Are You Sure, Want to delete this user?
          </h3>
          <div class="w-full flex justify-between items-center gap-x-2"><a href="#" data-target="delete_user"
              class="popup_remove text-white bg-red-400 border border-gray-200 font-medium inline-flex items-center rounded-lg text-sm px-3 py-2.5 text-center hover:scale-[1.02] transition-transform"
              data-modal-toggle="delete-product-modal">No, cancel</a>

            <button
              class="disabled:opacity-70 disabled:cursor-not-allowed text-white bg-gradient-to-br from-red-600 to-red-500 font-medium rounded-lg text-sm inline-flex items-center px-3 py-2.5 text-center mr-2 shadow-md shadow-gray-300 hover:scale-[1.02] transition-transform"><span>Yes,
                Confirm</span></button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="js/app.js"></script>
</body>

</html>
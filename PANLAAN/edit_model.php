<div class="modal fade" id="editModel<?php echo $row->ProductID?>"tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5"id="editModel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      
      <div class="container">
  <form action="" method="POST" class="row g-12">
<div class="row">
<input type="hidden" name="ProductID"value="<?php echo $row->ProductID?>">
    <!-- <form class="row g-3"> -->

    <div class="col-md-12">
    <label for="inputGender" class="form-label">Category</label>
    <select id="gender" class="form-select" id="Category" name="Category"value="<?php echo $row->Category?>"required>
      <option>Guitar Apliancess</option>
      <option>Electric Guitar</option>
      <option>Acoustic Guitar</option>
      <option>Bass Guitar</option>
      <option>Amplifier</option>
    </select>
  </div>
  <div class="col-md-6">
  <label for="inputEmail4" class="form-label"> Product Name</label>
    <input type="text" class="form-control" id="ProductName" name="ProductName"value="<?php echo $row->ProductName?>"required>
  </div>
  <div class="col-md-6">
  <label for="inputEmail4" class="form-label"> Quantity</label>
    <input type="text" class="form-control" id="Quantity" name="Quantity"value="<?php echo $row->Quantity?>"required>
  </div> 
  <div class="col-md-6">
  <label for="inputEmail4" class="form-label"> RetailPrice</label>
    <input type="text" class="form-control" id="RetailPrice" name="RetailPrice"value="<?php echo $row->RetailPrice?>"required>
  </div> 
  <div class="col-md-6">
  <label for="inputBirth" class="form-label"> Date Of Purchase</label>
    <input type="date" class="form-control" id="DateofPurchase" name="DateofPurchase"value="<?php echo $row->DateofPurchase?>"required>
  </div>
</div>

      <div class= "save">
        <br>
        <hr>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="editstudent">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
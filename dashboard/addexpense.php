<div class="chart">
  <form method="post" id="addForm" autocomplete="off" style="padding:0%!important;border:none!important;margin-bottom:50px!important">
      
        <h1 style="margin-top:-40px!important">Add expense+</h1>
        <?php if(isset($_SESSION['errors_addexpense'])){ echo $_SESSION['errors_addexpense']; $_SESSION['errors_addexpense'] = ""; }?>
        <div class="row">
            <div class="col col-lg-8">
              <label for="expense">Expense</label>    
              <input type="text" name="expense" class="form-control" placeholder="e.g. pizza" id="expense">
            </div>
            <div class="col-lg-4">  
              <label for=form-control>Price</label>    
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                  </div>    
                  <input type="text" name="price" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="100" id="price">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-lg-6">
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Category</label>
                  </div>
                  <select type="text" name="category" class="custom-select" id="category">
                    <option selected>Tap here</option>
                    <option value="Food & Drinks">Food & Drinks</option>
                    <option value="Travel">Travel</option>
                    <option value="Bills">Bills</option>
                    <option value="Shopping">Shopping</option>
                    <option value="Health">Health</option>    
                    <option value="Others">Others</option>  
                  </select>
                </div>
            </div>
            <div class="col-lg-6">        
              <input class="form-control" name="date" type="date" id="datepicker" placeholder="Select Date">  

            </div>
        </div>  
        <input type="text" name="note" placeholder="Add note">
        <button type="submit" id="addButton" name="addButton" class="btn btn-primary">Add</button> 
    </form>
</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
    $('#addForm').on('submit', function(e){
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: 'insert.php',
                        data: $('#addForm').serialize(),

                        success: function(){

                            console.log("added");
                            $('form').trigger("reset");  
                            window.location.reload();

                        }
                    });
                });


    </script>

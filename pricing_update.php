<?php
include('admin_session.php');
if(!isset($_SESSION['admin_login_session'])){
header("location: admin.php"); // Redirecting To Home Page
}
?>
<?php
try{
  $con=new PDO("mysql:host=localhost;dbname=mrp",'root','');
  $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  }
       catch (PDOException $e)
     {
      echo"ERROR".$e->getMessage();
     }


 if(isset($_POST['delete'])){

 $id=$_POST['id'];
 
 $conn = mysqli_connect("localhost", "root", "");
 
 $db = mysqli_select_db($conn, "mrp");

 $query = mysqli_query($conn, "SELECT * FROM pricing_details WHERE id='$id'");
 
 $rows = mysqli_num_rows($query);
 if($rows == 1){


if(isset($_POST['delete']))
{
        
    try {
        $pdoConnect = new PDO("mysql:host=localhost;dbname=mrp","root","");
    } catch (PDOException $exc) {
        echo $exc->getMessage();
        exit();
    }

    
    $id = $_POST['id'];

    $pdoQuery = "DELETE FROM pricing_details WHERE id = :id";
    
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    
    
    $pdoExec = $pdoResult->execute(array(":id"=>$id));
    
     if($pdoExec)
     {
       ?>
  <script >
    alert("Deleted");
  location= "pricing_update.php";
  </script>
  <?php
     }else{

      ?>
  <script >
    alert("not deleted");
  location= "pricing_update.php";
  </script>
  <?php
     }



 }}
 else
 {
 ?>
  <script >
    alert("id did not match");
  location= "pricing_update.php";
  </script>
  <?php
 }
 mysqli_close($conn);
}
?>

<html>  
    <head>  
        <title>pricing update</title>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
       
          
    </head>  
    <style>
        body{
            background-color: #696969;
            margin: 0;
        }
   .overflow{
     overflow:auto;
      width: 100%;
      height: 392px;
    }
    .logo{
        margin-top: 5px;
        margin-left: 5px;
    }
  
     .title{
        width: 100%;
        background-color: #484848;
        padding-top: 5px;
        padding-bottom: 5px;
        margin-bottom: 10px;
    }
    tr{
        text-align: center;
    }
    tr th{
        position: sticky;
        top: 0;
        background-color: #484848;
        height: 30px;
    }
    .button{
        border:1px solid black;
        border-radius: 3px;
        width: 20%;
        padding-top: 5px;
        padding-bottom: 5px;
        background-color: #696969;
        color: white;
    }

    .button:hover{
        background-color: #484848;
     }

    input[type=text],input[type=number]{
        border-radius: 3px;
        border:1px solid black;
        padding-top: 2px;
        padding-bottom: 2px;
        text-align: center;
        outline: none;
    }
     input[type=text]:focus,input[type=number]:focus{
   background-color: #cccccc;
  }
    .delete{
        
        float: right;
        margin-right: 40px;
    }

</style>
    <body> 
        <div class="logo"><img src="logo.png"></div>
    <div class="title" align="center"><b>UPDATE PRICING DETAILS</b></div> 
    <div class="delete">
        <form method="post" action="pricing_update.php">
        <input type="number" name="id" placeholder="Id" required="
        " style="width: 80px; height: 26px">&nbsp&nbsp
        <input type="submit" name="delete" value="Delete" class="button" style="width: 100px"></form>
    </div>
        <div class="overflow">
        <div class="container">  
    <form method="post" id="update_form">
                   
                        <table border="1" width="100%">
                            <thead>
                                <th></th>
                                <th>Id</th>
                                <th>Product Name</th>
                                <th>Cost Price</th>
                                <th>Selling Price</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                    
    </body>  
</html> 
<script>  
$(document).ready(function(){  
    
    function fetch_data()
    {
        $.ajax({
            url:"pricing_update1.php",
            method:"POST",
            dataType:"json",
            success:function(data)
            {
                var html = '';
                for(var count = 0; count < data.length; count++)
                {
                    html += '<tr>';
                    html += '<td><input type="checkbox" id="'+data[count].id+'" data-id="'+data[count].id+'"data-product_name="'+data[count].product_name+'"data-cost_price="'+data[count].cost_price+'" data-selling_price="'+data[count].selling_price+'" class="check_box"  /></td>';
                    html += '<td>'+data[count].id+'</td>';
                    html += '<td>'+data[count].product_name+'</td>';
                    html += '<td>'+data[count].cost_price+'</td>';
                    html += '<td>'+data[count].selling_price+'</td></tr>';
                }
                $('tbody').html(html);
            }
        });
    }

    fetch_data();

    $(document).on('click', '.check_box', function(){
        var html = '';
        if(this.checked)
        {
            html = '<td><input type="checkbox" id="'+$(this).attr('id')+'" data-id="'+$(this).data('id')+'" data-product_name="'+$(this).data('product_name')+'" data-cost_price="'+$(this).data('cost_price')+'" data-selling_price="'+$(this).data('selling_price')+'" class="check_box" checked /></td>';
            html += '<td>'+$(this).data("id")+'</td>';
           html += '<td><input type="hidden" name="product_name[]" class="form-control" value="'+$(this).data("product_name")+'">'+$(this).data("product_name")+'</td>';
            html += '<td><input type="text" name="cost_price[]" class="form-control" value="'+$(this).data("cost_price")+'" /></td>';
            html += '<td><input type="text" name="selling_price[]" class="form-control" value="'+$(this).data("selling_price")+'" /><input type="hidden" name="hidden_id[]" value="'+$(this).attr('id')+'" /></td>';
        }
        else
        {
            html = '<td><input type="checkbox" id="'+$(this).attr('id')+'" data-id="'+$(this).data('id')+'"data-product_name="'+$(this).data('product_name')+'"data-cost_price="'+$(this).data('cost_price')+'" data-selling_price="'+$(this).data('selling_price')+'" class="check_box" /></td>';
            html += '<td>'+$(this).data('id')+'</td>';
            html += '<td>'+$(this).data('product_name')+'</td>';
            html += '<td>'+$(this).data('cost_price')+'</td>';
            html += '<td>'+$(this).data('selling_price')+'</td>';            
        }
        $(this).closest('tr').html(html);
        $('#gender_'+$(this).attr('id')+'').val($(this).data('gender'));
         $('#product_name_'+$(this).attr('id')+'').val($(this).data('product_name'));
    });

    $('#update_form').on('submit', function(event){
        event.preventDefault();
        if($('.check_box:checked').length > 0)
        {
            $.ajax({
                url:"pricing_update2.php",
                method:"POST",
                data:$(this).serialize(),
                success:function()
                {
                    alert('Data Updated');
                    fetch_data();
                }
            })
        }
    });

});  


</script></div><br>

 <div align="center" class="detete"> 


  <input type="submit" name="multiple_update" id="multiple_update" class="button" value="Update" />
                      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

    <button onclick="goBack()" class="button" >Back</button>
      <script>
function goBack() {
  location= "admin_home.php";
}
</script>
</div>
                </form><br>


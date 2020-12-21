<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>jQuery Add / Remove Table Rows Dynamically</title>
<style>
    form{
        margin: 20px 0;
    }
    form input, button{
        padding: 5px;
    }
    table{
        width: 100%;
        margin-bottom: 20px;
		border-collapse: collapse;
    }
    table, th, td{
        border: 1px solid #cdcdcd;
    }
    table th, table td{
        padding: 10px;
        text-align: left;
    }
</style>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>
    $(document).ready(function(){
        $(".add-row").click(function(){
            var product_name = $("#product_name").val();
            var company_name = $("#company_name").val();
            var quantity = $("#quantity").val();
            var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + product_name + "</td><td>" + company_name + "</td><td>" + quantity + "</td></tr>";
            $("table tbody").append(markup);
        });
        
        // Find and remove selected table rows
        $(".delete-row").click(function(){
            $("table tbody").find('input[name="record"]').each(function(){
            	if($(this).is(":checked")){
                    $(this).parents("tr").remove();
                }
            });
        });
    });    
</script>
</head>
<body>
    <form>
        <input type="text" id="product_name" name="product_name" placeholder="product_name">
        <input type="text" id="company_name" name="company_name" placeholder="company_name">
        <input type="text" id="quantity" name="quantity" placeholder="quantity">
    	<input type="button" class="add-row" value="Add">
    	 </form>
    
    <table>
        <thead>
            <tr>
                <th>Select</th>
                <th>product name</th>
                <th>company name</th>
                <th>quantity</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                
            </tr>
        </tbody>
    </table>
    <button type="button" class="delete-row">Delete Row</button>
    <input type="submit" name="entry" value="entry">
</body> 
</html>

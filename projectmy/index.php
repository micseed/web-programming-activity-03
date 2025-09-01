<?php 
    $product_name = $category = $price = $stock_quantity = $expiration_date = $status ="";
    $product_name_error = $category_error = $price_error = $stock_quantity_error = $expiration_date_error = $status_error = "";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //validation for product name
        $product_name = trim(htmlspecialchars($_POST["product_name"]));
        //validation for category
        $category = trim(htmlspecialchars($_POST["category"]));
        //validation for price
        $price = trim(htmlspecialchars($_POST["price"]));
        //validation for stock quantity
        $stock_quantity = trim(htmlspecialchars($_POST["stock_quantity"]));
        //validation for expiration date
        $expiration_date = trim(htmlspecialchars($_POST["expiration_date"]));
        //validation for status
        // validation for status
        $status = isset($_POST["status"]) ? trim(htmlspecialchars($_POST["status"])) : "";

        
        if (empty($product_name)) {
            $product_name_error = "Product name is required.";
        }
        if (empty($category)) {
            $category_error = "Category is required.";
        }
        if (empty($price)){
            $price_error = "Price is required.";
        } elseif(!is_numeric($price) || $price < 0){
            $price_error = "Price must be must be a number, and can't be zero.";
        } 
        if(empty($stock_quantity)){
            $stock_quantity_error = "Stock quantity is required.";
        } elseif(!is_numeric($stock_quantity) || $stock_quantity < 0 || strpos($stock_quantity, '.') !== false){
            $stock_quantity_error = "Stock quantity must be a number, and can't be negative.";
        }
        if(empty($expiration_date)){
            $expiration_date_error = "Expiration date is required.";
        } elseif (strtotime($expiration_date) < strtotime(date("Y-m-d"))) {
            $expiration_date_error = "Expiration date can't be in the past.";
        }
        if (empty($status)) {
            $status_error = "Status is required.";
        }

        if(empty($product_name_error)&& empty($category_error) && empty($price_error) && empty($stock_quantity_error) && empty($expiration_date_error) && empty($status_error)) {
            header("Location: redirect.php");
            exit();
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
        
</head>
<body>
    <h2>Product Entry Form</h2>

    <div class="container">
    <!-- the GET method displays the data directly in the address bar, while the POST method does not -->
        <form action=" " method="post">
        <div class="row">
            <div class="form-group">
                <label>Product Name: </label><br>
                <input type="text" name="product_name" value="<?php echo $product_name; ?>"><br>
                <p style="color: red; margin: 0;"><?php echo $product_name_error; ?></p>
            </div>

            <div class="form-group">
                <label>Category: </label><br>
                <select name="category" >
                    <option value="">-- Select Category --</option>
                    <option value="Category A" <?php if ($category=="Category A") echo "selected"; ?>>Category A</option>
                    <option value="Category B" <?php if ($category=="Category B") echo "selected"; ?>>Category B</option>
                    <option value="Category C" <?php if ($category=="Category C") echo "selected"; ?>>Category C</option>
                    <option value="Category D" <?php if ($category=="Category D") echo "selected"; ?>>Category D</option>
                </select><br>
                <p style="color: red; margin: 0;"><?php echo $category_error; ?></p>
            </div>
        </div>
            
        <div class="row">
            <div class="form-group">
                <label>Price (&#8369;): </label><br>
                <input type="number" name="price" step="0.01" value="<?php echo $price; ?>"><br>
                <p style="color: red; margin: 0;"><?php echo $price_error; ?></p>
            </div>
            
            <div class="form-group">
                <label>Stock Quantity: </label><br>
                <input type="number" name="stock_quantity" value="<?php echo $stock_quantity; ?>" min = 0><br>
                <p style="color: red; margin: 0;"><?php echo $stock_quantity_error; ?></p>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label>Expiration Date: </label><br>
                <input type="date" name="expiration_date" value="<?php echo $expiration_date; ?>"><br>
                <p style="color: red; margin: 0;"><?php echo $expiration_date_error; ?></p>
            </div>

            <div class="form-group">
                <label>Status: </label><br>
                <input type="radio" name="status" value="active" <?php if($status=="active") echo "checked"; ?>> Active<br>
                <input type="radio" name="status" value="inactive" <?php if($status=="inactive") echo "checked"; ?>> Inactive<br><br>
                <p style="color: red; margin: 0;"><?php echo $status_error; ?></p>
            </div>
        </div>


            <input type="submit" value="Save Product">
        </form>
    </div>
</body>
</html>
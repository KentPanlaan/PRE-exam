<?php
require_once('connection.php');

// Open database connection
$connection = $newconnection->openConnection();

// Get form input values
$searchTerm = isset($_POST['search']) ? trim($_POST['search']) : '';
$availability = isset($_POST['availability']) ? $_POST['availability'] : '';
$categoryFilter = isset($_POST['category_filter']) ? $_POST['category_filter'] : '';
$startDate = isset($_POST['start_date']) ? $_POST['start_date'] : '';
$endDate = isset($_POST['end_date']) ? $_POST['end_date'] : '';

// Prepare SQL query with dynamic conditions
$sql = 'SELECT * FROM product WHERE 1=1';

if (!empty($searchTerm)) {
    $sql .= ' AND (ProductName LIKE :searchTerm OR Category LIKE :searchTerm)';
}

if ($availability == 'in_stock') {
    $sql .= ' AND Quantity > 0';
} elseif ($availability == 'out_of_stock') {
    $sql .= ' AND Quantity = 0';
}

if (!empty($categoryFilter)) {
    $sql .= ' AND Category = :categoryFilter';
}

if (!empty($startDate) && !empty($endDate)) {
    $sql .= ' AND DateofPurchase BETWEEN :startDate AND :endDate';
}

$sql .= ' ORDER BY ProductID DESC';

// Prepare and bind parameters for the query
$stmt = $connection->prepare($sql);

if (!empty($searchTerm)) {
    $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%');
}

if (!empty($categoryFilter)) {
    $stmt->bindValue(':categoryFilter', $categoryFilter);
}

if (!empty($startDate) && !empty($endDate)) {
    $stmt->bindValue(':startDate', $startDate);
    $stmt->bindValue(':endDate', $endDate);
}

// Execute the statement
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body>

<?php
// Add, delete, and edit student operations
$newconnection->addStudent();
$newconnection->deleteStudent();
$newconnection->editStudent();
?>

<div class="container">
    <form action="" method="POST" class="row g-12">
        <div class="row">
            <div class="col-md-6">
                <label for="Category" class="form-label">Category</label>
                <select id="Category" class="form-select" name="Category" required>
                    <option>Guitar Apliancess</option>
                    <option>Electric Guitar</option>
                    <option>Acoustic Guitar</option>
                    <option>Bass Guitar</option>
                    <option>Amplifier</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="ProductName" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="ProductName" name="ProductName" required>
            </div>
            <div class="col-md-6">
                <label for="Quantity" class="form-label">Quantity</label>
                <input type="text" class="form-control" id="Quantity" name="Quantity" required>
            </div>
            <div class="col-md-6">
                <label for="RetailPrice" class="form-label">Retail Price</label>
                <input type="text" class="form-control" id="RetailPrice" name="RetailPrice" required>
            </div>
            <div class="col-md-6">
                <label for="DateofPurchase" class="form-label">Date Of Purchase</label>
                <input type="date" class="form-control" id="DateofPurchase" name="DateofPurchase" required>
            </div>
            <div class="col-12">
                <br>
                <button type="submit" class="btn btn-primary" name="addstudent">Add Product</button>
            </div>
        </div>
    </form>

    <div class="container my-3">
        <form action="new.php" method="POST" class="row g-3">
            <div class="col-md-3">
                <label for="category_filter">Category:</label>
                <select name="category_filter" class="form-select">
                    <option value="">All Categories</option>
                    <option value="Guitar Apliancess" <?php if ($categoryFilter == 'Guitar Apliancess') echo 'selected'; ?>>Guitar Apliancess</option>
                    <option value="Electric Guitar" <?php if ($categoryFilter == 'Electric Guitar') echo 'selected'; ?>>Electric Guitar</option>
                    <option value="Acoustic Guitar" <?php if ($categoryFilter == 'Acoustic Guitar') echo 'selected'; ?>>Acoustic Guitar</option>
                    <option value="Bass Guitar" <?php if ($categoryFilter == 'Bass Guitar') echo 'selected'; ?>>Bass Guitar</option>
                    <option value="Amplifier" <?php if ($categoryFilter == 'Amplifier') echo 'selected'; ?>>Amplifier</option>
                </select>
            </div>
            <div class="col-md-3">
                <label>Availability:</label>
                <select name="availability" class="form-select">
                    <option value="">Product Availability</option>
                    <option value="in_stock" <?php if ($availability == 'in_stock') echo 'selected'; ?>>In Stock</option>
                    <option value="out_of_stock" <?php if ($availability == 'out_of_stock') echo 'selected'; ?>>Out of Stock</option>
                </select>
            </div>
            <div class="col-md-3">
                <label>From:</label>
                <input type="date" class="form-control" name="start_date" value="<?php echo $startDate; ?>">
            </div>
            <div class="col-md-3">
                <label>To:</label>
                <input type="date" class="form-control" name="end_date" value="<?php echo $endDate; ?>">
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Apply Filters</button>
            </div>
        </form>
    </div>

    <div class="container my-3">
        <form action="new.php" method="POST" class="row g-3">
            <div class="col-md-9">
                <input type="text" class="form-control" name="search" placeholder="Search products..." value="<?php echo $searchTerm; ?>">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">Search</button>
            </div>
        </form>
    </div>

    <br>

    <table class="table table-primary">
        <thead>
            <tr>
                <th>#</th>
                <th>Category</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Retail Price</th>
                <th>Date Of Purchase</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
          
            if ($result) {
                foreach ($result as $row) {
                    ?>
                    <tr>
                        <td><?php echo $row->ProductID; ?></td>
                        <td><?php echo $row->Category; ?></td>
                        <td><?php echo $row->ProductName; ?></td>
                        <td><?php echo $row->Quantity; ?></td>
                        <td><?php echo $row->RetailPrice; ?></td>
                        <td><?php echo $row->DateofPurchase; ?></td>
                        <td>
                            <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModel<?php echo $row->ProductID; ?>">Edit</a>
                        </td>
                        <?php include('edit_model.php'); ?>
                        <td>
                            <form action="" method="post">
                                <button type="submit" class="btn btn-danger" value="<?php echo $row->ProductID; ?>" name="delete_student">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

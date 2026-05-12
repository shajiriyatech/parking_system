<?php
include 'layout.php';
include '../config/db.php';

$search = "";

if(isset($_GET['search'])){

    $search = $_GET['search'];

    $result = $conn->query("
    SELECT * FROM cards
    WHERE
    flat_number LIKE '%$search%' OR
    name LIKE '%$search%' OR
    card_number LIKE '%$search%' OR
    vehicle_number LIKE '%$search%'
    ORDER BY id DESC
    ");

} else {

    $result = $conn->query("SELECT * FROM cards ORDER BY id DESC");
}
$total = $conn->query("SELECT COUNT(*) as total FROM cards")
->fetch_assoc()['total'];

$active = $conn->query("SELECT COUNT(*) as total FROM cards WHERE status='active'")
->fetch_assoc()['total'];

$blocked = $conn->query("SELECT COUNT(*) as total FROM cards WHERE status='blocked'")
->fetch_assoc()['total'];
?>

<div class="topbar d-flex justify-content-between align-items-center">

<h4>Dashboard</h4>

<?php if($_SESSION['role'] != 'security'){ ?>
    <a href="add_card.php" class="btn btn-primary">
        + Add Card
    </a>
<?php } ?>

</div>

<div class="row mb-4">
<div class="col-md-4">
<div class="card shadow border-0">
<div class="card-body">
<h5>Total Cards</h5>
<h2><?php echo $total; ?></h2>
</div>
</div>
</div>

<div class="col-md-4">
<div class="card shadow border-0">
<div class="card-body">
<h5>Active Cards</h5>
<h2 class="text-success"><?php echo $active; ?></h2>
</div>
</div>
</div>

<div class="col-md-4">
<div class="card shadow border-0">
<div class="card-body">
<h5>Blocked Cards</h5>
<h2 class="text-danger"><?php echo $blocked; ?></h2>
</div>
</div>
</div>

</div>

<div class="card shadow border-0">
<div class="card-body">

<form method="GET" class="mb-3">

<div class="row">

<div class="col-md-10">
<input type="text"
name="search"
value="<?php echo $search; ?>"
class="form-control"
placeholder="Search flat, name, card or vehicle">
</div>

<div class="col-md-2">
<button class="btn btn-primary w-100">
Search
</button>
</div>
</div>

</form>

<table class="table table-bordered table-hover align-middle">

<thead class="table-dark">
<tr>
<th>UID</th>
<th>Flat</th>
<th>Name</th>
<th>Card</th>
<th>Vehicle</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<?php while($row = $result->fetch_assoc()){ ?>

<tr>
<td><?php echo $row['uid']; ?></td>
<td><?php echo $row['flat_number']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['card_number']; ?></td>
<td><?php echo $row['vehicle_number']; ?></td>

<td>

<?php if($row['status'] == 'active'){ ?>
    <span class="badge bg-success">Active</span>
<?php } else { ?>
    <span class="badge bg-danger">Blocked</span>
<?php } ?>

</td>

<td>

<div class="d-flex gap-1">

<a href="view_card.php?id=<?php echo $row['id']; ?>"
class="btn btn-info btn-sm text-white">
View
</a>
<?php if($_SESSION['role'] != 'security'){ ?>

<a href="edit_card.php?id=<?php echo $row['id']; ?>"
class="btn btn-warning btn-sm">
Edit
</a>

<?php } ?>

<?php if($_SESSION['role'] == 'manager'){ ?>

<a href="delete_card.php?id=<?php echo $row['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete this card?')">
Delete
</a>

<?php } ?>

</div>

</td>

</tr>
<?php } ?>

</tbody>

</table>

</div>
</div>

<?php include 'footer.php'; ?>
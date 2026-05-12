<?php
include 'layout.php';
include '../config/db.php';

$id = $_GET['id'];

$data = $conn->query("SELECT * FROM cards WHERE id='$id'")
->fetch_assoc();
?>

<div class="topbar">
<h4>Resident Details</h4>
</div>

<div class="card shadow border-0">
<div class="card-body">

<table class="table table-bordered">

<tr>
<th width="250">UID</th>
<td><?php echo $data['uid']; ?></td>
</tr>

<tr>
    <th>Flat Number</th>
<td><?php echo $data['flat_number']; ?></td>
</tr>

<tr>
<th>Name</th>
<td><?php echo $data['name']; ?></td>
</tr>

<tr>
<th>Card Number</th>
<td><?php echo $data['card_number']; ?></td>
</tr>

<tr>
<th>Vehicle Number</th>
<td><?php echo $data['vehicle_number']; ?></td>
</tr>

<tr>
<th>Status</th>
<td>

<?php if($data['status'] == 'active'){ ?>
    <span class="badge bg-success">Active</span>
    <?php } else { ?>
    <span class="badge bg-danger">Blocked</span>
<?php } ?>

</td>
</tr>

<tr>
<th>Block Reason</th>
<td>
<?php echo $data['block_reason'] ?: '-'; ?>
</td>
</tr>

</table>

<?php if($_SESSION['role'] == 'manager'){ ?>

<?php if($data['status'] == 'active'){ ?>

<button
class="btn btn-danger"
data-bs-toggle="modal"
data-bs-target="#blockModal">
Block Card
</button>

<?php } else { ?>

<a href="toggle_status.php?id=<?php echo $data['id']; ?>"
class="btn btn-success">
Activate Card
</a>

<?php } ?>

<?php } ?>

<a href="dashboard.php" class="btn btn-secondary">
Back
</a>

</div>
</div>

<div class="modal fade" id="blockModal" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">

<form method="POST" action="toggle_status.php">
    <div class="modal-header">
<h5 class="modal-title">Block Card</h5>
</div>

<div class="modal-body">

<input type="hidden"
name="card_id"
value="<?php echo $data['id']; ?>">

<div class="mb-3">
<label>Reason for blocking</label>
<textarea
name="block_reason"
class="form-control"
required></textarea>
</div>

<div class="alert alert-warning">
Are you sure you want to block this card?
</div>

</div>

<div class="modal-footer">
    <button
type="button"
class="btn btn-secondary"
data-bs-dismiss="modal">
Cancel
</button>

<button
type="submit"
name="confirm_block"
class="btn btn-danger">
Confirm Block
</button>

</div>

</form>

</div>
</div>
</div>

<?php include 'footer.php'; ?>
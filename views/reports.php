<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $data["title"] ?? ""; ?></title>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
            integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"
            defer></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
            integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link type="text/css" rel="stylesheet" href="./public/css/style.css"/>
</head>
<body>
<!--Header Section-->
<?php require_once "components/header.php"; ?>
<!--End Header Section-->

<div class="container-fluid mt-4">
    <h2 class="mb-4">Submissions Report</h2>
    <!-- Filter Form -->
    <form id="filter-form" action="/reports" class="row g-3">
        <div class="col-md-3">
            <label for="user_id" class="form-label">User ID</label>
            <input
                    value='<?php echo $data["user_id"] ?? ""; ?>'
                    type="text"
                    class="form-control"
                    id="user_id"
                    name="user_id"
                    placeholder="Enter User ID">
        </div>
        <div class="col-md-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input
                    value='<?php echo $data["from_date"] ?? ""; ?>'
                    type="date" class="form-control" id="from_date" name="from_date">
        </div>
        <div class="col-md-3">
            <label for="end_date" class="form-label">End Date</label>
            <input
                    value='<?php echo $data["to_date"] ?? ""; ?>'
                    type="date" class="form-control" id="to_date" name="to_date">
        </div>
        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    <!-- Results Table -->
    <div class="table-responsive mt-4">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Amount</th>
                <th>UserID</th>
                <th>Receipt ID</th>
                <th>Items</th>
                <th>Buyer Email</th>
                <th>City</th>
                <th>Note</th>
                <th>Phone</th>
                <th>Entry By</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody id="report-table-body">
			<?php
                $reports = $data["reports"];
				foreach ($reports as $report) {
                    $id = htmlentities($report["id"]);
                    $amount = htmlentities($report["amount"]);
                    $buyer = htmlentities($report["buyer"]);
                    $receipt_id = htmlentities($report["receipt_id"]);
                    $items = htmlentities(is_array($report["items"]) ? implode("<br>", $report["items"]) : $report["items"]);
                    $buyer_email = htmlentities($report["buyer_email"]);
                    $city = htmlentities($report["city"]);
                    $note = htmlentities($report["note"]);
                    $phone = htmlentities($report["phone"]);
                    $entry_by = htmlentities($report["entry_by"]);
                    $entry_at = htmlentities($report["entry_at"]);
                    echo
					"<tr>
                        <td>$id</td>
                        <td>$amount</td>
                        <td>$buyer</td>
                        <td>$receipt_id</td>
                        <td>$items</td>
                        <td>$buyer_email</td>
                        <td>$city</td>
                        <td>$note</td>
                        <td>$phone</td>
                        <td>$entry_by</td>
                        <td>$entry_at</td>
                    </tr>";
                }
			?>
            </tbody>
        </table>
    </div>
</div>

<script>

</script>


</body>
</html>
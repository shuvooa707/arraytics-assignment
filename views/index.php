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

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8" id="form-section">
			<?php
				if (isLoggedIn() && !isset($_COOKIE["form_submitted_in_24_hours"])) {
					echo include "./views/components/main-submit-form.php";
				} else if(!isLoggedIn()) {
					echo "
                        <a href='/login' class=\"\">Login</a> to submit form
                    ";
				}
			?>
            <!--      Main Form      -->
            <!--      End Main Form      -->
        </div>

        <div class="col-lg-8 p-3 hide bg-white rounded rounded-1" id="success-message-section">
            <h2>Form Submission Successful</h2>
        </div>
		
		<?php
            if ( isset($_COOKIE["form_submitted_in_24_hours"]) && isLoggedIn() ) {
	            $submittedTime = $_COOKIE["form_submitted_in_24_hours"];
                $timeLeft = ceil( (((86400) - (time() - $submittedTime)) / 60) / 60 );
	            echo "<div class='col-lg-8 p-3 text-center bg-white rounded rounded-1' id='submission-locked-section'>
                        <h3>Try Again in $timeLeft hours later</h3>
                    </div>";
            }
		?>
    </div>
</div>

<script>
    var text_max = 30;
    $('#count_message').html('0 / ' + text_max);

    $('#note').keyup(() => {
        var word_count = $('#note').val().trim().split(" ").length;
        var text_remaining = text_max - word_count - 1;

        if (word_count >= text_max) {
            let trimmedText = $('#note').val().trim().split(" ").slice(0, text_max).join(" ");
            $('#note').val(trimmedText);
        }

        $('#count_message').html(word_count + ' / ' + text_max);
    });
</script>


</body>
</html>
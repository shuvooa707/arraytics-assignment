<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $data["title"] ?? ""; ?></title>

    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
            integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
            integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"
            defer></script>

    <link type="text/css" rel="stylesheet" href="./public/css/style.css"/>
</head>
<body>
<div class="container-fluid bg-light">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <nav class="navbar navbar-expand-lg navbar-light px-5 bg-light">
                <a class="navbar-brand" href="#">Home</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!--     Main Form       -->
            <div class="card">
                <div class="card-header text-white bg-indigo">
                    <h2 class="mb-4">Submit Your Details</h2>
                </div>
                <div class="card-body">
                    <form id="submissionForm" action="/register" method="post" class="row">
                        <div class="mb-3 col-6">
                            <label class="form-label">Name<sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control form-control-sm" id="name" name="name" required>
                            <div class="invalid-feedback hide mt-0" id="amount-error-box">
                                <small>Only Text Is Allowed</small>
                            </div>
                        </div>

                        <div class="mb-3 col-6">
                            <label class="form-label">Email<sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control form-control-sm" id="email" name="email" maxlength="20" required>
                            <div class="invalid-feedback hide mt-0" id="email-error-box">
                                <small>Enter Valid Email Address</small>
                            </div>
                        </div>
                        
                        <div class="mb-3 col-6">
                            <label class="form-label">Password<sup class="text-danger">*</sup></label>
                            <input type="password" class="form-control form-control-sm" id="password" name="password" maxlength="20" required>
                            <div class="invalid-feedback hide mt-0" id="password-error-box">
                                <small>Password must be at least 8 characters long</small>
                            </div>
                        </div>
                        <div class="mb-3 col-6">
                            <label class="form-label">Retype Password<sup class="text-danger">*</sup></label>
                            <input type="password" class="form-control form-control-sm" id="repassword" name="repassword" maxlength="20" required>
                            <div class="invalid-feedback hide mt-0" id="repassword-error-box">
                                <small>Password don't match</small>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
            <!--     End Main Form       -->
        </div>
    </div>
</div>

<script>
    var text_max = 30;
    $('#count_message').html('0 / ' + text_max);

    $('#note').keyup(() => {
        var word_count = $('#note').val().trim().split(" ").length;
        var text_remaining = text_max - word_count - 1;
        
        if ( word_count >= text_max ) {
            let trimmedText = $('#note').val().trim().split(" ").slice(0, text_max).join(" ");
            $('#note').val(trimmedText);
        }

        $('#count_message').html(word_count + ' / ' + text_max);
    });
</script>
</body>
</html>
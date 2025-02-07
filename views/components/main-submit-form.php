<div class="card">
    <div class="card-header text-white bg-indigo">
        <h2 class="mb-4">Submit Your Details</h2>
    </div>
    <div class="card-body">
        <form id="submissionForm" class="row">
            <div class="mb-3 col-6">
                <label class="form-label">Amount<sup class="text-danger">*</sup></label>
                <input type="number" min="0" class="form-control" id="amount" name="amount" required>
                <div class="invalid-feedback hide mt-0" id="amount-error-box">
                    <small>Only Number Is Allowed</small>
                </div>
            </div>

            <div class="mb-3 col-6">
                <label class="form-label">Buyer<sup class="text-danger">*</sup></label>
                <input type="text" class="form-control" id="buyer" name="buyer" maxlength="20" required>
                <div class="invalid-feedback hide mt-0" id="buyer-error-box">
                    <small>Only Number Is Allowed</small>
                </div>
            </div>

            <div class="mb-3 col-6">
                <label class="form-label">Receipt ID</label>
                <input type="text" class="form-control" id="receipt_id" name="receipt_id" required>
                <div class="invalid-feedback hide mt-0" id="receipt_id-error-box">
                    <small>Example invalid form file feedback</small>
                </div>
            </div>

            <div class="mb-3 col-6">
                <label class="form-label">Items</label>
                <div id="itemsContainer">
                    <input type="text" id="items" class="form-control form-control-sm mb-2" name="items[]" required>
                </div>
                <div class="invalid-feedback hide mt-0" id="items-error-box">
                    <small>Example invalid form file feedback</small>
                </div>
                <button type="button" onclick="addItems()" class="btn btn-sm btn-primary" id="addItem">Add Item</button>
            </div>

            <div class="mb-3 col-12 well" style="position: relative">
                <label class="form-label">
                    Note<sup class="text-danger">*</sup>
                </label>
                <textarea class="form-control" id="note" name="note" rows="3" maxlength="200"
                          required></textarea>
                <span class="pull-right label label-default" id="count_message"></span>
                <div class="invalid-feedback hide mt-0" id="note-error-box">
                    <small>Example invalid form file feedback</small>
                </div>
            </div>

            <div class="mb-3 col-6">
                <label class="form-label">Buyer Email</label>
                <input type="email" class="form-control" id="buyer_email" name="buyer_email" required>
                <div class="invalid-feedback  hide mt-0" id="buyer_email-error-box">
                    <small>Example invalid form file feedback</small>
                </div>
            </div>

            <div class="mb-3 col-6">
                <label class="form-label">City</label>
                <input type="text" class="form-control" id="city" name="city" required>
                <div class="invalid-feedback  hide mt-0" id="city-error-box">
                    <small>Example invalid form file feedback</small>
                </div>
            </div>

            <div class="col-6  mb-3">
                <label class="form-label">Phone</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">+880</span>
                    </div>
                    <input type="number" class="form-control" id="phone" name="phone" required>
                    <div class="invalid-feedback hide mt-0" id="phone-error-box">
                        <small>Example invalid form file feedback</small>
                    </div>
                </div>
            </div>

            <div class="mb-3 col-6">
                <label class="form-label">Entry By</label>
                <input type="number" class="form-control" id="entry_by" name="entry_by" required>
                <div class="invalid-feedback  hide mt-0" id="entry_by-error-box">
                    <small>Example invalid form file feedback</small>
                </div>
            </div>

            <button onclick="handleSubmit(event)" type="button" class="btn btn-success">Submit</button>
        </form>
    </div>
</div>

<!--submit form script-->
<script type="text/javascript">

    const addItems = () => {
        $("#itemsContainer")
            .append(`<span><input type="text" id="items" class="form-control form-control-sm mb-2" name="items[]" required></span>`);
    }

    const handleSubmit = (e) => {
        e.preventDefault();
        const amount = $("#amount");
        const buyer = $("#buyer");
        const receipt_id = $("#receipt_id");
        const note = $("#note");
        const buyer_email = $("#buyer_email");
        const city = $("#city");
        const phone = $("#phone");
        const entry_by = $("#entry_by");

        let items = [];
        $("input[id='items']").each(function () {
            items.push($(this).val())
        });
        
        let r = validateData({
            amount: amount,
            buyer: buyer,
            receipt_id: receipt_id,
            items: items,
            note: note,
            buyer_email: buyer_email,
            city: city,
            phone: phone,
            entry_by: entry_by
        });
        
        if ( !r ) {
            swal({
                icon: "error",
                title: "Invalid Input",
                body: `Check Input Fields`,
                // footer: '<a href="#">Why do I have this issue?</a>'
            });
            return;
        }

        $.post("/users/form/submit", {
            amount: amount.val(),
            buyer: buyer.val(),
            receipt_id: receipt_id.val(),
            items: items,
            note: note.val(),
            buyer_email: buyer_email.val(),
            city: city.val(),
            phone: phone.val(),
            entry_by: entry_by.val()
        }, function (response) {
            response = JSON.parse(response);
            console.log(response.errors)
            if (response.message == "failed") {
                let errors = Object
                    .values(response.errors)
                    .reduce((acc, e) => {
                        return acc + `<li>${e}</li>`;
                    });
                
                Object
                    .keys(response.errors)
                    .forEach(key => {
                        const el = $("#"+key).next();
                        el.text(response.errors[key]);
                        el.removeClass("hide");
                    });
                
                swal({
                    icon: "error",
                    title: "Form Submission Failed",
                    body: `Check Input Fields`,
                    // footer: '<a href="#">Why do I have this issue?</a>'
                });
            }
            else {
                $("#form-section").addClass("hide");
                $("#success-message-section").removeClass("hide");
            }
        });
    }

    const validateData = function (data) {
        if ( !data["amount"].val() )
        {
            data["amount"]
                .next()
                .text("Enter Amount")
            data["amount"]
                .next()
                .removeClass("hide");
            
            return false;
        }
        else if ( isNaN(data["amount"].val()) )
        {
            data["amount"]
                .next()
                .text("Only Number Is Allowed")
            data["amount"]
                .next()
                .removeClass("hide");
            return false;
        }
        else {
            data["amount"]
                .next()
                .addClass("hide");
        }
        
        if ( !data["buyer_email"].val() )
        {
            data["buyer_email"]
                .next()
                .text("Enter Email Address")
            data["buyer_email"]
                .next()
                .removeClass("hide");
            return false;
        }
        else if ( !isValidEmail(data["buyer_email"].val()) )
        {
            data["buyer_email"]
                .next()
                .text("Enter Valid Email")
            data["buyer_email"]
                .next()
                .removeClass("hide");
            return false;
        }
        else {
            data["buyer_email"]
                .next()
                .addClass("hide");
        }

        // buyer id
        if ( !data["buyer"].val() )
        {
            data["buyer"]
                .next()
                .text("Enter Buyer Name or ID")
            data["buyer"]
                .next()
                .removeClass("hide");
            return false;

        }
        else if ( !isValidBuyer(data["buyer"].val()) )
        {
            data["buyer"]
                .next()
                .text("Buyer must contain only letters, numbers, and spaces (max 20 characters)")
            data["buyer"]
                .next()
                .removeClass("hide");
            return false;
        }
        else
        {
            data["buyer"]
                .next()
                .addClass("hide");
        }

        // receipt_id
        if ( !data["receipt_id"].val() )
        {
            data["receipt_id"]
                .next()
                .text("Enter Receipt ID")
            data["receipt_id"]
                .next()
                .removeClass("hide");
            return false;

        }
        else if ( !isValidReceiptId(data["receipt_id"].val()) )
        {
            data["receipt_id"]
                .next()
                .text("Receipt ID must contain only letters and numbers")
            data["receipt_id"]
                .next()
                .removeClass("hide");
            return false;
        }
        else
        {
            data["receipt_id"]
                .next()
                .addClass("hide");
        }


        // note
        if ( !data["note"].val() && data["note"].val().length )
        {
            data["note"]
                .next()
                .next()
                .text("Enter Note")
            data["note"]
                .next()
                .next()
                .removeClass("hide");
            return false;

        }
        else if ( !isValidNote(data["note"].val()) )
        {
            data["note"]
                .next()
                .next()
                .text("Note must be a maximum of 30 words")
            data["note"]
                .next()
                .next()
                .removeClass("hide");
            return false;
        }
        else
        {
            data["note"]
                .next()
                .next()
                .addClass("hide");
        }


        // city
        if ( !data["city"].val() )
        {
            data["city"]
                .next()
                .text("Enter Note")
            data["city"]
                .next()
                .removeClass("hide");
            return false;

        }
        else if ( !isValidCity(data["city"].val()) )
        {
            data["city"]
                .next()
                .text("Note must be a maximum of 30 words")
            data["city"]
                .next()
                .removeClass("hide");
            return false;
        }
        else
        {
            data["city"]
                .next()
                .addClass("hide");
        }
        
        // phone
        if ( !data["phone"].val() )
        {
            data["phone"]
                .next()
                .text("Enter Phone Number")
            data["phone"]
                .next()
                .removeClass("hide");
            return false;

        }
        else if ( !isValidPhone(data["phone"].val()) )
        {
            data["phone"]
                .next()
                .text("Phone must contain only numbers and 11 digits")
            data["phone"]
                .next()
                .removeClass("hide");
            return false;
        }
        else
        {
            data["phone"]
                .next()
                .addClass("hide");
        }

        // entry_by
        if ( !data["entry_by"].val() )
        {
            data["entry_by"]
                .next()
                .text("Enter Entry By ID")
            data["entry_by"]
                .next()
                .removeClass("hide");
            return false;

        }
        else if ( isNaN(data["entry_by"].val()) )
        {
            data["entry_by"]
                .next()
                .text("Entry By must contain only numbers")
            data["entry_by"]
                .next()
                .removeClass("hide");
            return false;
        }
        else
        {
            data["entry_by"]
                .next()
                .addClass("hide");
        }

        return true;
    }

    const isNumber = n => {
        const pattern = (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/);
        return  pattern.test(n);
    }
    const isValidEmail = e => (/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/).test(e);
    const isValidBuyer = e => (/^[a-zA-Z0-9 ]{1,20}$/).test(e);
    const isValidReceiptId = e => (/^[a-zA-Z0-9]+$/).test(e);
    const isValidNote = e => (/^(?:\S+\s*){1,30}$/u).test(e);
    const isValidCity = e => (/^[a-zA-Z ]+$/).test(e);
    const isValidPhone = e => (/^\d{10,11}$/).test(e);
</script>
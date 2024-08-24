<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        .receipt {
            width: 100%;
            max-width: 600px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background: #fff;
            margin: 0 auto 20px auto;
        }

        .header,
        .footer {
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            margin-bottom: 20px;
        }

        .content table {
            width: 100%;
            border-collapse: collapse;
        }

        .content table th,
        .content table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .btn-receipt {
            padding: 10px 20px;
            border-radius: 8px;
            background-color: #0056b3;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-receipt:hover {
            background-color: #004494;
        }
    </style>

    <!-- Bootstrap and JS libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
</head>

<body>

    <div class="container">
        <?php $count = 1; ?>
        <input type="hidden" id="user_id" value="<?php echo $student_id; ?>" />

        <?php foreach ($paymentsucceess as $payment) : ?>
            <div class="receipt" id="receipt<?php echo $count ?>">
                <div class="header">
                    <h1 style="text-align: center;">Payment Receipt</h1>
                    <p style="text-align: center;">Application Fee for Admission to M.B.B.S. Degree Course</p>
                </div>
                <div class="content" style="display:flex;justify-content:center">
                    <table>
                        <tr>
                            <th>Name:</th>
                            <td><?php echo htmlspecialchars($payment['firstname'] . ' ' . $payment['lastname']); ?></td>
                        </tr>
                        <tr>
                            <th>Amount:</th>
                            <td>₹<?php echo htmlspecialchars($payment['amount']); ?></td>
                        </tr>
                        <tr>
                            <th>Date:</th>
                            <td><?php echo date('d-m-Y', strtotime($payment['date'])); ?></td>
                        </tr>
                        <tr>
                            <th>Fee Type:</th>
                            <td><?php echo htmlspecialchars($payment['fee_details']); ?></td>
                        </tr>
                        <tr>
                            <th>Description:</th>
                            <td><?php echo htmlspecialchars($payment['description']); ?></td>
                        </tr>
                        <tr>
                            <th>Transaction ID:</th>
                            <td><?php echo htmlspecialchars($payment['transaction_id']); ?></td>
                        </tr>
                        <tr>
                            <th>Payment Mode:</th>
                            <td><?php echo htmlspecialchars($payment['payment_mode']); ?></td>
                        </tr>
                    </table>
                </div>
                <div class="footer" style="text-align: center;">
                    <p>Thank you for your payment!</p>
                </div>
                <style>
                    @media print {
                        .noprint {
                            visibility: hidden;
                        }
                    }
                </style>
                <button onclick="downloadReceipt(<?php echo $count++; ?>)" class="btn-receipt noprint">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z" />
                    </svg> Download Receipt
                </button>
            </div>
        <?php endforeach; ?>

    </div>
    <div class="row">
        <?php if (array_key_exists("Cashier", $role)) { ?>
            <button class="btn-receipt" id="verify-payment" onclick="confirmPayment()" style="margin-top:20px;text-align:center"><svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z" />
                </svg>Verify Payment</button>
        <?php } elseif (array_key_exists("Finance Controller", $role)) { ?>

            <button class="btn-receipt" id="verify-payment" onclick="controllerConfirmPayment()" style="margin-top:20px;text-align:center"><svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z" />
                </svg>Verify Payment</button>
        <?php } ?>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        function downloadReceipt(count) {
            var divToPrint = document.getElementById('receipt' + count);
            var printWindow = window.open('', 'Print-Window');
            printWindow.document.open();
            printWindow.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
            printWindow.document.close();
            setTimeout(function() {
                printWindow.close();
            }, 10);
        }

        function confirmPayment() {
            // Get the user ID from the hidden input field
            var student_id = $("#user_id").val();
            console.log(student_id);
            // Ask for user confirmation
            var confirmation = confirm("Are you sure you want to proceed?");

            if (confirmation) {
                $("#verify-payment").prop('disabled', true).css({
                    'filter': 'blur(2px)',
                    'opacity': '0.5'
                });

                $("#loading-screen").fadeIn();

                $.ajax({

                    url: '<?php echo base_url(); ?>admin/temporary_admission/cashierUpdateStatus/' + student_id,
                    type: 'POST',

                    success: function(data) {
                        console.log(data);
                        // var response = JSON.parse(data);
                        // alert(response.message);
                        window.location.href = "<?php echo base_url(); ?>admin/temporary_admission/show/" + student_id;
                    },

                });
            } else {
                alert("Operation canceled.");
            }
        }

        function controllerConfirmPayment() {
            // Get the user ID from the hidden input field
            var student_id = $("#user_id").val();
            console.log(student_id);
            // Ask for user confirmation
            var confirmation = confirm("Are you sure you want to proceed?");

            if (confirmation) {
                $("#verify-payment").prop('disabled', true).css({
                    'filter': 'blur(2px)',
                    'opacity': '0.5'
                });

                $("#loading-screen").fadeIn();

                $.ajax({

                    url: '<?php echo base_url(); ?>admin/temporary_admission/updateStatus/' + student_id,
                    type: 'POST',

                    success: function(data) {
                        // console.log(data);
                        // var response = JSON.parse(data);
                        // alert(response.message);
                        window.location.href = "<?php echo base_url(); ?>admin/temporary_admission/show/" + student_id;
                    },

                });
            } else {
                alert("Operation canceled.");
            }
        }

        function errorMsg(message) {
            // Define how to display error messages
            alert("Error: " + message);
        }

        function successMsg(message) {
            // Define how to display success messages
            alert("Success: " + message);
        }
    </script>
</body>

</html>
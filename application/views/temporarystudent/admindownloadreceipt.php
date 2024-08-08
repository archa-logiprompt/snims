<!DOCTYPE html>
<html>

<head>
    <title>Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .receipt {
            width: 100%;
            max-width: 600px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background: #fff;
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

        .footer button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
        }

        .footer button:hover {
            background-color: #0056b3;
        }
    </style>
    <!-- Include jsPDF and html2canvas libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
</head>

<body>
    <div class="row d-flex justify-content-evenly me-2">
        <style>
            .btn-receipt {
                padding: 10px 20px 10px 20px;
                border-radius: 8px;
                background-color: #0056b3;
                color: #fff;
                border: none;
                float: right;
            }
        </style>

        <div class="col-lg-12">
            <div class="receipt" id="receipt">

                <input type="hidden" id="user_id" value="<?php echo $userdata['id']; ?>" />

                <div class="header">
                    <h1>Payment Receipt</h1>
                    <p>Application Fee for Admission to M.B.B.S. Degree Course</p>
                </div>
                <div class="content">
                    <table>
                        <tr>
                            <th>Name:</th>
                            <td><?php echo $paymentsucceess['firstname'] . ' ' . $paymentsucceess['lastname']; ?></td>
                        </tr>
                        <tr>
                            <th>Amount:</th>
                            <td>₹<?php echo $paymentsucceess['amount']; ?></td>
                        </tr>
                        <tr>
                            <th>Date:</th>
                            <td><?php echo date('d-m-Y', strtotime($paymentsucceess['date'])); ?></td>
                        </tr>
                        <tr>
                            <th>Description:</th>
                            <td><?php echo $paymentsucceess['description']; ?></td>
                        </tr>
                        <tr>
                            <th>Transaction ID:</th>
                            <td><?php echo $paymentsucceess['transaction_id']; ?></td>
                        </tr>
                        <tr>
                            <th>Payment Mode:</th>
                            <td><?php echo $paymentsucceess['payment_mode']; ?></td>
                        </tr>
                    </table>
                </div>
                <div class="footer">
                    <p>Thank you for your payment!</p>

                </div>
            </div>

        </div>

        <div class="btn-container">
            <button onclick="downloadReceipt()" class="btn-receipt" style="margin-left:290px;margin-top:20px">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                    <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z" />
                </svg>
                Download Receipt
            </button>
        </div>
        <div class="btn-container">
            <button class="btn-receipt" onclick="confirmPayment()" style="margin-top:20px"><svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z" />
                </svg>Verify Payment</button>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
            function downloadReceipt() {
                const {
                    jsPDF
                } = window.jspdf;
                html2canvas(document.getElementById('receipt')).then(canvas => {
                    const imgData = canvas.toDataURL('image/png');
                    const pdf = new jsPDF('p', 'mm', 'a4');
                    const imgWidth = 190; // Adjusted width in mm
                    const pageHeight = 295; // A4 height in mm
                    const imgHeight = canvas.height * imgWidth / canvas.width;
                    let heightLeft = imgHeight;

                    let position = 0;
                    pdf.addImage(imgData, 'PNG', 15, position, imgWidth, imgHeight); // Added margins of 10 mm
                    heightLeft -= pageHeight;

                    while (heightLeft > 0) {
                        position -= pageHeight;
                        pdf.addPage();
                        pdf.addImage(imgData, 'PNG', 30, position, imgWidth, imgHeight); // Added margins of 10 mm
                        heightLeft -= pageHeight;
                    }

                    pdf.save('receipt.pdf'); // Directly triggers the download
                }).catch(error => {
                    console.error('Error generating PDF:', error);
                });
            }

            function confirmPayment() {
                // Get the user ID from the hidden input field
                var student_id = $("#user_id").val();
                console.log($("#user_id").val());
                // Ask for user confirmation
                var confirmation = confirm("Are you sure you want to proceed?");

                if (confirmation) {
                    $.ajax({
                        
                        url: '<?php echo base_url(); ?>temporary_user/TemporaryUser/updateStatus/' +student_id,
                        type: 'POST',
                       
                        success: function(data) {
                           
                            window.location.href = "<?php echo base_url(); ?>/admin/temporary_admission/search/"+student_id;
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
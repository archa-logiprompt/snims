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
    <div class="row d-flex justify-content-evenly"> 
        
        <div class="col-lg-12">
            <div class="receipt" id="receipt">
    
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
        <style>
            .btn-receipt{
                padding: 10px 20px 10px 20px;
                border-radius: 8px;
                background-color: #0056b3;
                color: #fff;
                border: none;
                float: right;
            }
        </style>
        <div class="-col-12 col-lg-12" style="padding-top: 20px;">
            <button onclick="downloadReceipt()" class="btn-receipt">Download Receipt</button>
        </div>

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
                    pdf.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight); // Added margins of 10 mm
                    heightLeft -= pageHeight;

                    while (heightLeft > 0) {
                        position -= pageHeight;
                        pdf.addPage();
                        pdf.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight); // Added margins of 10 mm
                        heightLeft -= pageHeight;
                    }

                    pdf.save('receipt.pdf'); // Directly triggers the download
                }).catch(error => {
                    console.error('Error generating PDF:', error);
                });
            }
        </script>
</body>

</html>
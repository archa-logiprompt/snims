<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#424242" />
    <title>School Management System</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/style-main.css">
</head>

<body style="background: #ededed;">
    <div class="container">
        <div class="row">
            <div class="paddtop20">
                <div class="col-md-8 col-md-offset-2 text-center">

                    <img src="<?php echo base_url('uploads/school_content/logo/' . $setting[0]['image']); ?>" style="width: 15%;">

                </div>

                <div class="col-md-6 col-md-offset-3 mt20">
                    <div class="paymentbg">
                        <div class="invtext">Fees Payment Details</div>
                        <div class="padd2 paddtzero">
                            <table class="table2" width="100%">
                                <tr>
                                    <th>Decription</th>
                                    <th class="text-right">Amount</th>
                                </tr>
                                <?php $total = 0;
                                $fee_details_array = array();
                                foreach ($categoryamount as $row) {
                                    $fee_details = $row['name'] . "-" . $row['type'];
                                    $fee_details_array[] = $fee_details;
                                ?>
                                    <tr>
                                        <td><?php echo $row['name'] . "-" . $row['type'] ?></td>
                                        <td class="text-right"><?php echo $row['amount'];
                                                                $total += $row['amount'] ?></td>
                                    </tr>
                                <?php
                                } ?>
                                <tr>
                                    <td>
                                        Total
                                    </td>
                                    <td class="text-right">
                                        <?php echo $total; ?>
                                    </td>
                                </tr>




                            </table>
                            <div class="divider"></div>
                            <?php $fee_details = implode(',', $fee_details_array) ?>
                            <form class="paddtlrb" method="POST" id="form">
                                <button type="button" onclick="window.history.go(-1); return false;" name="search" value="" class="btn btn-info"><i class="fa fa fa-chevron-left"></i> Back</button>
                                <button type="button" id="btnSubmit" class="btn btn-info pull-right"><i class="fa fa fa-money"></i> Pay</button>
                                <!-- <input type="hidden" name="student_fees_master_id" value="<?php echo $categoryamount['student_fees_master_id']; ?>"> -->
                                <!-- <input type="hidden" name="name" value="<?php echo $categoryamount['name']; ?>"> -->

                                <!-- <input type="hidden" name="fee_groups_feetype_id" value="<?php echo $params['fee_groups_feetype_id']; ?>"> -->
                                <!-- <input type="hidden" name="student_id" value="<?php echo $params['student_id']; ?>"> -->
                                <input type="hidden" name="mrctCode" value="T206030">
                                <!-- <input type="hidden" name="mrctCode" value="L1020487"> -->
                                <!-- <input type="hidden" name="incomename" value="<?php echo $params['payment_detail']->fee_group_name ?>"> -->
                                <!-- <input type="hidden" name="incometype" value="<?php echo $params['payment_detail']->code ?>"> -->
                                <input type="hidden" name="amount" value="<?php echo $total; ?>">
                                <!-- <input type="hidden" name="scheme" value="FIRST"> -->
                                <input type="hidden" name="scheme" value="test">
                                <input type="hidden" name="fee_details" value="<?php echo $fee_details ?>">
                                <input type="hidden" name="custID" value="c345802">
                                <input type="hidden" name="currency" value="INR">
                                <!-- <input type="hidden" name="fine" value="<?php echo $params['fine']; ?>">  -->
                                <input type="hidden" name="txn_id" value="<?php echo time(); ?>">

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript" src="https://www.paynimo.com/Paynimocheckout/server/lib/checkout.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $("#btnSubmit").click(function(e) {
            e.preventDefault();

            var str = $("#form").serialize();
            console.log(str)
            $.ajax({
                type: 'POST',
                cache: false,
                data: str,
                url: "<?php echo base_url('temporary_user/TemporaryUser/worldline') ?>",
                success: function(response) {

                    var obj = JSON.parse(response);
                    console.log(obj['data'][13])

                    function handleResponse(res) {
                        if (res && res.paymentMethod && res.paymentMethod.paymentTransaction) {
                            if (res.paymentMethod.paymentTransaction.statusCode === '0300') {
                                // success block
                            } else if (res.paymentMethod.paymentTransaction.statusCode === '0398') {
                                // initiated block
                            } else {
                                // error block
                            }
                        } else {
                            // error block
                        }
                    }
                    console.log('hashh', obj)
                    var configJson = {
                        'tarCall': false,
                        'features': {
                            'showPGResponseMsg': true,
                            'enableNewWindowFlow': <?php echo ($mer_array['enableNewWindowFlow'] == 1) ? 'true' : 'false'; ?>,
                            'enableAbortResponse': true,
                            'enableExpressPay': <?php echo ($mer_array['enableExpressPay'] == 1) ? 'true' : 'false'; ?>,
                            'enableInstrumentDeRegistration': <?php echo ($mer_array['enableInstrumentDeRegistration'] == 1) ? 'true' : 'false'; ?>,
                            'enableMerTxnDetails': true,
                            'siDetailsAtMerchantEnd': <?php echo ($mer_array['enableSIDetailsAtMerchantEnd'] == 1) ? 'true' : 'false'; ?>,
                            'enableSI': <?php echo ($mer_array['enableEmandate'] == 1) ? 'true' : 'false'; ?>,
                            'hideSIDetails': <?php echo ($mer_array['hideSIConfirmation'] == 1) ? 'true' : 'false'; ?>,
                            'enableDebitDay': <?php echo ($mer_array['enableDebitDay'] == 1) ? 'true' : 'false'; ?>,
                            'expandSIDetails': <?php echo ($mer_array['expandSIDetails'] == 1) ? 'true' : 'false'; ?>,
                            'enableTxnForNonSICards': <?php echo ($mer_array['enableTxnForNonSICards'] == 1) ? 'true' : 'false'; ?>,
                            'showSIConfirmation': <?php echo ($mer_array['showSIConfirmation'] == 1) ? 'true' : 'false'; ?>,
                            'showSIResponseMsg': <?php echo ($mer_array['showSIResponseMsg'] == 1) ? 'true' : 'false'; ?>,
                        },
                        'consumerData': {
                            'deviceId': 'WEBSH2',
                            'token': obj['hash'],
                            'returnUrl': obj['data'][12],
                            'responseHandler': handleResponse,
                            'paymentMode': 'all',
                            'checkoutElement': '<?php echo ($mer_array['embedPaymentGatewayOnPage'] == "1") ? "#worldline_embeded_popup" : ""; ?>',
                            'merchantLogoUrl': '<?php echo isset($mer_array['logoURL']) ? $mer_array['logoURL'] : ''; ?>',
                            'merchantId': obj['data'][0],
                            'currency': obj['data'][15],
                            'consumerId': obj['data'][8],
                            'consumerMobileNo': obj['data'][9],
                            'consumerEmailId': obj['data'][10],
                            'txnId': obj['data'][1],
                            'items': [{
                                'itemId': obj['data'][14],
                                'amount': obj['data'][2],
                                'comAmt': '0'
                            }],
                            'cartDescription': '}{custname:' + obj['data'][13],
                            'merRefDetails': [{
                                "name": "Txn. Ref. ID",
                                "value": obj['data'][1]
                            }],
                            'customStyle': {
                                'PRIMARY_COLOR_CODE': '<?php echo isset($mer_array['primaryColor']) ? $mer_array['primaryColor'] : ''; ?>',
                                'SECONDARY_COLOR_CODE': '<?php echo isset($mer_array['secondaryColor']) ? $mer_array['secondaryColor'] : ''; ?>',
                                'BUTTON_COLOR_CODE_1': '<?php echo isset($mer_array['buttonColor1']) ? $mer_array['buttonColor1'] : ''; ?>',
                                'BUTTON_COLOR_CODE_2': '<?php echo isset($mer_array['buttonColor2']) ? $mer_array['buttonColor2'] : ''; ?>'
                            },
                            'accountNo': obj['data'][11],
                            'accountHolderName': obj['data'][16],
                            'ifscCode': obj['data'][17],
                            'accountType': obj['data'][18],
                            'debitStartDate': obj['data'][3],
                            'debitEndDate': obj['data'][4],
                            'maxAmount': obj['data'][5],
                            'amountType': obj['data'][6],
                            'frequency': obj['data'][7]
                        }
                    };

                    console.log(configJson);

                    $.pnCheckout(configJson);
                    if (configJson.features.enableNewWindowFlow) {
                        pnCheckoutShared.openNewWindow();
                    }
                }
            });
        });
    });
</script>

</html>
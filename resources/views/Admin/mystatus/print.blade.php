<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Tax Invoice</title>
    <link rel="shortcut icon" type="image/png" href="./favicon.png" />
    <style>
        * {
            box-sizing: border-box;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #ddd;
            padding: 10px;
            word-break: break-all;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 16px;
        }

        .h4-14 h4 {
            font-size: 12px;
            margin-top: 0;
            margin-bottom: 5px;
        }

        .img {
            margin-left: "auto";
            margin-top: "auto";
            height: 30px;
        }

        pre,
        p {
            /* width: 99%; */
            /* overflow: auto; */
            /* bpicklist: 1px solid #aaa; */
            padding: 0;
            margin: 0;
        }

        table {
            font-family: arial, sans-serif;
            width: 100%;
            border-collapse: collapse;
            padding: 1px;
        }

        .hm-p p {
            text-align: left;
            padding: 1px;
            padding: 5px 4px;
        }

        td,
        th {
            text-align: left;
            padding: 8px 6px;
        }

        .table-b td,
        .table-b th {
            border: 1px solid #ddd;
        }

        th {
            /* background-color: #ddd; */
        }

        .hm-p td,
        .hm-p th {
            padding: 3px 0px;
        }

        .cropped {
            float: right;
            margin-bottom: 20px;
            height: 100px;
            /* height of container */
            overflow: hidden;
        }

        .cropped img {
            width: 400px;
            margin: 8px 0px 0px 80px;
        }

        .main-pd-wrapper {
            box-shadow: 0 0 10px #ddd;
            background-color: #fff;
            border-radius: 10px;
            padding: 15px;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #ddd;
            padding: 10px;
            font-size: 14px;
        }

        .invoice-items {
            font-size: 14px;
            border-top: 1px dashed #ddd;
        }

        .invoice-items td {
            padding: 14px 0;

        }
    </style>
</head>

<body>
    <section class="main-pd-wrapper" style="width: 450px; margin: auto">
        <div
            style="
                  text-align: center;
                  margin: auto;
                  line-height: 1.5;
                  font-size: 14px;
                  color: #4a4a4a;
                ">
                @if (!empty(env('APP_LOGO')))
                <img src="{{asset(env('APP_LOGO'))}}" style="max-width: 80px">
                @endif


            <p style="font-weight: bold; color: #000; margin-top: 15px; font-size: 18px;">
                {{env('APP_NAME')}}
            </p>
            <p style="margin: 15px auto;">
                {{env('APP_ADDRS')}}
            </p>
            {{-- <p>
                  <b>GSTIN:</b> 0987653456789
                </p>
                <p>
                  <b>CIN:</b> 0987653456789
                </p>
                <p>
                  <b>FSSAI No. :</b> 0987653456789
                </p> --}}

            <p>
                <b>Name:</b> {{ $mainuser['name'] }}
            </p>
            <p>
                <b>Mobile. :</b> {{ $mainuser['mobile'] }}
            </p>
            <p>
                <b>Address. :</b><br> {{ $mainuser['addr'] }}
            </p>
            <hr style="border: 1px dashed rgb(131, 131, 131); margin: 25px auto">
        </div>
        <table style="width: 100%; table-layout: fixed">
            <thead>
                <tr>
                    <th style="width: 50px; padding-left: 0;">Sn.</th>
                    <th style="width: 220px;">Service Name</th>
                    {{-- <th>QTY</th> --}}
                    <th style="text-align: right; padding-right: 0;">Price</th>
                </tr>
            </thead>
            <tbody>
                <?php $sr = 1; ?>
                @foreach ($services as $list)
                    <?php
                    $spt = 0;
                    $pt = 0;
                    $sget = App\Models\Service::select()
                        ->where('id', $list['serviceid'])
                        ->first(); ?>
                    <tr class="invoice-items">
                        <td><?= $sr++ ?></td>
                        <td>{{ $sget->name }}</td>
                        {{-- <td>1 PC</td> --}}
                        <td style="text-align: right;">₹ {{ $list->payment }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <?php
        $sercount = App\Models\ServiceTaken::select()
            ->where('leadid', $user['lead_id'])
            ->sum('payment');
        $paycount = App\Models\PaymentTaken::select()
            ->where('leadid', $user['lead_id'])
            ->sum('payment');
            //echo $user['id'];
        ?>
        <table style="width: 100%;
              background: #fcbd024f;
              border-radius: 4px;">
            <thead>
                <tr>
                    <th>Total</th>
                    <th style="text-align: center;">Item (<?= $sr - 1 ?>)</th>
                    <th>&nbsp;</th>
                    <th style="text-align: right;">₹ <?= $sercount ?></th>

                </tr>
            </thead>

        </table>

        <table
            style="width: 100%;
              margin-top: 15px;
              border: 1px dashed #00cd00;
              border-radius: 3px;">
            <thead>
                <tr>
                    <td>Receive Amount: </td>
                    <td style="text-align: right;">₹ <?= $paycount ?></td>
                </tr>
                <tr>
                    <td>Due Amount: </td>
                    <td style="text-align: right;">₹ {{ $sercount - $paycount }}</td>
                </tr>
                <tr>
                    <td>Total Amount: </td>
                    <td style="text-align: right;">₹ <?= $sercount ?></td>
                </tr>
            </thead>

        </table>

        <table style="width: 100%; table-layout: fixed">
            <thead>
                <tr>
                    <th style="width: 50px; padding-left: 0;text-align:center;"><button onclick="window.print()">Print</button></th>
                    <th style="width: 50px; padding-left: 0;text-align:center;"><button onclick="history.back()">Go to Home</button></th>

                </tr>
            </thead>
        </table>

    </section>
</body>

</html>

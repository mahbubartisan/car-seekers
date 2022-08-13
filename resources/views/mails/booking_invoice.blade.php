<html>

<body style="background-color:#e2e1e0;font-family: Open Sans, sans-serif;font-size:100%;font-weight:400;line-height:1.4;color:#000;">
<table style="max-width:670px;margin:50px auto 10px;background-color:#fff;padding:50px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24); border-top: solid 10px green;">
    <thead>
    <tr>
        <th style="text-align:left;"><h1><span style="color: red !important;">Car</span>Seekers</h1></th>
        <th style="text-align:right;font-weight:400;">{!! $data['booking_date'] !!}</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td style="height:35px;"></td>
    </tr>
    <tr>
        <td colspan="2" style="border: solid 1px #ddd; padding:10px 20px;">
            <p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:150px">Payment status</span><b style="color:green;font-weight:normal;margin:0">Success</b></p>
            <p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Transaction ID</span> {!! $data['transaction_id'] !!}</p>
            <p style="font-size:14px;margin:0 0 0 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Paid amount</span> {!! $data['total_paid'] !!}</p>
        </td>
    </tr>
    <tr>
        <td style="height:35px;"></td>
    </tr>
    <tr>
        <td style="width:50%;padding:20px;vertical-align:top">
            <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px">Name</span> {!! $data['customer_name'] !!}</p>
            <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Email</span> {!! $data['customer_email'] !!}</p>
            <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Phone</span> {!! $data['customer_contact'] !!}</p>
            <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Address</span> {!! $data['customer_address'] !!}</p>
        </td>
        <td style="width:50%;padding:20px;vertical-align:top">
            <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Duration of your Booking</span> {!! $data['total_duration'] !!}</p>
            <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Pick up Address</span> {!! $data['pick_up'] !!}</p>
            <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Drop off Address</span> {!! $data['drop_off'] !!}</p>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="font-size:20px;padding:30px 15px 0 15px;">Items</td>
    </tr>
    <tr>
        <td colspan="2" style="padding:15px;">
            <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;">
                Package <span style="display:block;font-size:13px;font-weight:normal;"></span> <b style="font-size:12px;font-weight:300;"> {!! $data['package'] !!}</b>
            </p>
            <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;">Duration<span style="display:block;font-size:13px;font-weight:normal;"></span> <b style="font-size:12px;font-weight:300;"> {!! $data['duration'] !!} Hours</b></p>
            <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;">Start Date<span style="display:block;font-size:13px;font-weight:normal;"></span> <b style="font-size:12px;font-weight:300;"> {!! $data['start_date'] !!}</b></p>
            <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;">Pick up<span style="display:block;font-size:13px;font-weight:normal;"></span> <b style="font-size:12px;font-weight:300;"> {!! $data['pick_up'] !!}</b></p>
            <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;">Drop off<span style="display:block;font-size:13px;font-weight:normal;"></span> <b style="font-size:12px;font-weight:300;"> {!! $data['drop_off'] !!}</b></p>
            <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;">Vehicle<span style="display:block;font-size:13px;font-weight:normal;"></span> <b style="font-size:12px;font-weight:300;"> {!! $data['vehicle'] !!}</b></p>
        </td>
    </tr>
    </tbody>
    <tfooter>
        <tr>
            <td colspan="2" style="font-size:14px;padding:50px 15px 0 15px;">
                <strong style="display:block;margin:0 0 10px 0;">Regards</strong> <span style="color: red !important;">Car</span>Seekers<br> {!! \App\User::where('role', 'Admin')->value('address') !!} !!}<br><br>
                <b>Phone:</b> {!! \App\User::where('role', 'Admin')->value('contact') !!}<br>
                <b>Email:</b> {!! \App\User::where('role', 'Admin')->value('email') !!}
            </td>
        </tr>
    </tfooter>
</table>
</body>

</html>

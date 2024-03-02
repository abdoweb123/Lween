<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Automatic Email</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta content="telephone=no" name="format-detection">
    <meta content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no;" name="viewport">
    <style>
        tr,
        td {
            border: none !important;
        }

    </style>
</head>

<body style="margin:0; padding:10px 0 0 0;" bgcolor="#FFFFFF">
    <table align="center" cellpadding="0" cellspacing="0" width="95%%" style="padding:15px;">
        <tr>
            <td align="center">
                <table align="center" border="1" cellpadding="0" cellspacing="0" width="600px" style="margin:15px; border: none;" bgcolor="#FFFFFF">
                    <tr>
                        <td align="center" style="padding:5px;">
                            <a href="https://tt.emcan-group.com" target="_blank">
                                <img src="https://brocarshop.com/logo.png" alt="Logo" style="width:50%;border:0;" />
                            </a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table align="center" cellpadding="0" cellspacing="0" width="95%%" style="padding:15px;">
        <tr>
            <td align="center">
                <table align="center" border="1" cellpadding="0" cellspacing="0" width="600px" style="margin:15px;padding:15px;border-collapse: separate; border-spacing: 5px 5px;border: 1px solid #DDB864;" bgcolor="#FFFFFF">
                    <tr>
                        <td bgcolor="#ffffff" style="padding: 30px 0;text-align: center;font-size: 24px;background: #f7efa7;">
                            New Order #{{ $Order['id'] }}
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" style="padding:10px 0;">
                            <table>
                                <tr>
                                    You&#39;ve recived the following order from Brocar
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" style="padding:10px 0;">
                            <table>
                                <tr>
                                    Order #{{ $Order['id'] }}
                                    <span style="color: #DDB864">( {{ $Order['created_at'] }} )</span>
                                </tr>

                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" style="padding:10px 0;">
                            <table style="width: 100%;text-align: center;">
                                <tr>
                                    <th style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" scope="col">Device</th>
                                    <th style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" scope="col">Quantity</th>
                                    <th style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" scope="col">Price</th>
                                    <th style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" scope="col">Color</th>
                                </tr>

                                @foreach ($Order->Devices as $Device)
                                <tr>
                                    <td style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" scope="col">{{ $Device->title_en }}</td>
                                    <td style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" scope="col">{{ $Device->pivot->quantity }}</td>
                                    <td style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" scope="col">{{ ($Device->pivot->total) .' '. Country()->currancy_code }}</td>
                                    <td style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" scope="col">{{ $Device->pivot->color_id ? Color($Device->pivot->color_id)->title_en : '' }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <th style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" scope="col">Sub Total :</th>
                                    <td style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" colspan="4">{{ format_number($Order->sub_total) .' '. Country()->currancy_code}}</td>
                                </tr>
                                @if($Order->discount > 0)
                                <tr>
                                    <th style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" scope="col">Discount :</th>
                                    <td style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" colspan="4">{{ format_number($Order->discount) .' '. Country()->currancy_code}}</td>
                                </tr>
                                @endif
                                @if($Order->coupon > 0)
                                <tr>
                                    <th style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" scope="col">Coupon :</th>
                                    <td style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" colspan="4">{{ format_number($Order->coupon) .' '. Country()->currancy_code}}</td>
                                </tr>
                                @endif
                                <tr>
                                    <th style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" scope="col">VAT :</th>
                                    <td style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" colspan="4">{{ format_number($Order->vat) .' '. Country()->currancy_code}}</td>
                                </tr>
                                @if($Order->charge_cost > 0)
                                <tr>
                                    <th style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" scope="col">Shipping :</th>
                                    <td style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" colspan="4">{{ format_number($Order->charge_cost) .' '. Country()->currancy_code}}</td>
                                </tr>
                                @endif
                                <tr>
                                    <th style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" scope="col">Payment Method :</th>
                                    <td style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" colspan="4">{{ $Order->PaymentMethod->title_en }}</td>
                                </tr>
                                <tr>
                                    <th style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" scope="col">Total :</th>
                                    <td style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" colspan="4">{{ format_number($Order->net_total) .' '. Country()->currancy_code }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    @if ($Order->Address)
                    <tr>
                        <td style="font-size: 28px; color: #DDB864;font-weight: bold">
                            Billing Address
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important">
                            <table>
                                <p>Name: {{ $Order->Client->name }}</p>
                                <p>Phone: {{ $Order->Client->phone }}</p>
                                <p>Email: {{ $Order->Client->email }}</p>

                                <p>Region: {{ $ $Order->Address->Region->title_en }}</p>

                                @if ($Order->Client->country_id == 2)
                                    @if($Order->Address->block)
                                        <p>Block: {{ $Order->Address->block }}</p>
                                    @endif
                                    @if($Order->Address->road)
                                        <p>Road: {{ $Order->Address->road }}</p>
                                    @endif
                                @else
                                    @if($Order->Address->block)
                                        <p>District: {{ $Order->Address->block }}</p>
                                    @endif
                                    @if($Order->Address->road)
                                        <p>Street: {{ $Order->Address->road }}</p>
                                    @endif
                                @endif

                                @if($Order->Address->building_no)
                                    <p>Building: {{ $Order->Address->building_no }}</p>
                                @endif
                                @if($Order->Address->floor_no)
                                    <p>Floor: {{ $Order->Address->floor_no }}</p>
                                @endif
                                @if($Order->Address->apartment)
                                    <p>Apartment: {{ $Order->Address->apartment }}</p>
                                @endif
                                @if($Order->Address->additional_directions)
                                    <p>Additional Directions: {!! $Order->Address->additional_directions !!}</p>
                                @endif
                            </table>
                        </td>
                    </tr>
                    @endif

                    @if ($Order->coupon > 0)
                    <tr>
                        <td>
                            Congratulations On The Sale
                        </td>
                    </tr>
                    @endif
                </table>
            </td>
        </tr>
    </table>
</body>

</html>

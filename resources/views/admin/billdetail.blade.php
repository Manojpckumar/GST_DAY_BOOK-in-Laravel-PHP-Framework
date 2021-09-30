<html>

<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <link rel="stylesheet" href="{{asset('css/bill.css')}}">
    <link rel="license" href="{{'https://www.opensource.org/licenses/mit-license/'}}">
    <script src="{{asset('js/bill.js')}}"></script>
</head>

<body>

    @foreach($billDetails as $bill)

    <header>
        <h1>Bill Details</h1>
        <address contenteditable>
            <p>{{ $bill->party_name }}</p>
            <p>{{ $bill->gst_num }}</p>

        </address>
        <span><img alt="" src="{{'http://www.jonathantneal.com/examples/invoice/logo.png'}}"><input type="file" accept="image/*"></span>
    </header>
    <article>
        <h1>Recipient</h1>
        <address style="display: none;" contenteditable>
            <p>Some Company<br>c/o Some Guy</p>
        </address>
        <table class="meta">
            <tr>
                <th><span contenteditable>Invoice #</span></th>
                <td><span contenteditable>{{ $bill->inv_num }}</span></td>
            </tr>
            <tr>
                <th><span contenteditable>Date</span></th>
                <td><span contenteditable>{{ $bill->bill_date}}</span></td>
            </tr>
            <tr>
                <th><span contenteditable>Bill Amount</span></th>
                @if($bill->bill_type == 'P')
                <td><span id="prefix" contenteditable>₹ </span><span>{{ $bill->pbill_amnt }}</span></td>
                @elseif($bill->bill_type == 'S')
                <td><span id="prefix" contenteditable> ₹ </span><span>{{ $bill->sbill_amnt }}</span></td>
                @elseif($bill->bill_type == 'E')
                <td><span id="prefix" contenteditable> ₹ </span><span>{{ $bill->ebill_amnt }}</span></td>
                @endif
            </tr>
        </table>
        <table class="inventory">
            <thead>
                <tr>
                    <th><span contenteditable>Sl No</span></th>
                    <th><span contenteditable>Narration</span></th>
                    <th><span contenteditable>Amount</span></th>
                    <!-- <th><span contenteditable>Quantity</span></th>
						<th><span contenteditable>Price</span></th> -->
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span contenteditable>1</span></td>
                    <td><span data-prefix></span><span contenteditable>{{$bill->bill_naration}}</span></td>

                    @if($bill->bill_type == 'P')
                    <td><span id="" contenteditable>₹ </span><span>{{ $bill->pbill_amnt }}</span></td>
                    @elseif($bill->bill_type == 'S')
                    <td><span id="" contenteditable>₹ </span><span>{{ $bill->sbill_amnt }}</span></td>
                    @elseif($bill->bill_type == 'E')
                    <td><span id="" contenteditable>₹ </span><span>{{ $bill->ebill_amnt }}</span></td>
                    @endif



                </tr>
            </tbody>
        </table>
        <!-- <a class="add">+</a> -->
        <table class="balance">
            <tr>
                <th><span contenteditable>Total</span></th>
                @if($bill->bill_type == 'P')
                <td><span data-prefix>₹ </span><span>{{ $bill->pbill_amnt }}</span></td>
                @elseif($bill->bill_type == 'S')
                <td><span data-prefix>₹ </span><span>{{ $bill->sbill_amnt }}</span></td>
                @elseif($bill->bill_type == 'E')
                <td><span data-prefix>₹ </span><span>{{ $bill->ebill_amnt }}</span></td>
                @endif
               
            </tr>

            <tr>
                <th><span contenteditable>CGST</span></th>
                <td><span data-prefix> ₹ </span><span contenteditable>{{$bill->cgst_sum}}</span></td>
            </tr>

            <tr>
                <th><span contenteditable>SGST</span></th>
                <td><span data-prefix>₹ </span><span>{{$bill->sgst_sum}}</span></td>
            </tr>

            <tr>
                <th><span contenteditable>IGST</span></th>
                <td><span data-prefix>₹ </span><span contenteditable>{{$bill->igst_sum}}</span></td>
            </tr>

            <tr>
                <th><span contenteditable>Total GST Paid</span></th>
                <td><span data-prefix>₹ </span><span>{{$bill->gst_sum}}</span></td>
            </tr>

        </table>
    </article>
    <aside>
        <h1><span contenteditable>GST Details</span></h1>
        <table class="inventory">
            <?php $number =1; ?>
            <thead>
                <tr>
                    <th><span contenteditable>#</span></th>
                    <th><span contenteditable>GST Slab</span></th>
                    <th><span contenteditable>Taxable</span></th>
                    <th><span contenteditable>Unit</span></th>
                    <th><span contenteditable>SGST</span></th>
                    <th><span contenteditable>CGST</span></th>
                    <th><span contenteditable>IGST</span></th>
                    <!-- <th><span contenteditable>Quantity</span></th>
						<th><span contenteditable>Price</span></th> -->
                </tr>
            </thead>
            <tbody>
                @foreach($gstDetails as $detail)
                <tr>
                    <td><span contenteditable>{{$number}}</span></td>
                    <td><span data-prefix></span><span contenteditable>{{$detail->gst_slab}}</span></td>
                    <td><span data-prefix></span><span contenteditable>{{$detail->tax_amount}}</span></td>
                    <td><span data-prefix></span><span contenteditable>{{$detail->pro_unit}}</span></td>
                    <td><span data-prefix></span><span contenteditable>{{$detail->pro_cgst}}</span></td>
                    <td><span data-prefix></span><span contenteditable>{{$detail->pro_sgst}}</span></td>
                    <td><span data-prefix></span><span contenteditable>{{$detail->pro_igst}}</span></td>
                </tr>
                <?php $number++; ?>
                @endforeach
            </tbody>
        </table>
    </aside>

    @endforeach
</body>

</html>
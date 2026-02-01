<h2>New Order Received</h2>

<p><strong>Invoice ID:</strong> {{ $order->invoice_id }}</p>
<p><strong>Customer Name:</strong> {{ $customer->name }}</p>
<p><strong>Phone:</strong> {{ $customer->phone }}</p>
<p><strong>Shipping Address:</strong> {{ $shipping->address }} ({{ $shipping->area }})</p>
<p><strong>Order Amount:</strong> {{ number_format($order->amount, 2) }}</p>

<h4>Order Details:</h4>
<table border="1" cellpadding="6" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>Purchase Price</th>
            <th>Sale Price</th>
            <th>Discount</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orderDetails as $item)
            <tr>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->qty }}</td>
                <td>{{ $item->purchase_price }}</td>
                <td>{{ $item->sale_price }}</td>
                <td>{{ $item->product_discount }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

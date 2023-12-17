<div class="row invoice-info">
    <div class="col-sm-12">
        <h4 class="text-right">Invoice #INV007612</h4>
    </div>
    <div class="col-sm-3  invoice-col">
        From
        <address>
            <strong>Themicly,</strong><br>Rajshahi <br>Bangladesh <br>Phone: (088) 016-1707 5540<br>Email:
            info@themicly.com
        </address>
    </div>
    <div class="col-sm-3 invoice-col">

        <label class="d-block">Customer Information</label>
        <div class="d-block">
            <div class="form-group">
                <input type="text"  name="customerName" class="form-control" placeholder="Enter Customer Name"
                    required>
                    <div>
                        @error('customerName') <span class="error">{{ $message }}</span> @enderror 
                    </div>
            </div>
            <div class="form-group">
                <input type="text"  name="customerPhone" class="form-control" placeholder="Enter Phone" 
                    required>
                    <div>
                        @error('customerPhone') <span class="error">{{ $message }}</span> @enderror 
                    </div>
            </div>
            {{-- <div class="form-group">
                    <textarea type="text" name="name" class="form-control h-82px" placeholder="Enter Address" value="Christopher Alex"></textarea>
                </div> --}}
        </div>

    </div>
    <div class="col-sm-3 invoice-col text-right">

        {{-- <b>Due Date:</b> Apr 12, 2023<br>
        <b>Account:</b> 968-34567-1234 --}}
    </div>
    {{-- <div class="col-sm-3 invoice-col text-right">
        <img height="100" src="{{asset('img/qr.png')}}" alt="">
    </div> --}}
</div>

<div class="row">
    <div class="col-12 table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="wp-10">SL</th>
                    <th class="wp-40">Product</th>
                    <th class="wp-20">Unit Price</th>
                    <th class="wp-15">Qty</th>
                    <th class="wp-15">Discount</th>
                    <th class="wp-15 text-right">Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    if (session('cart') != null) {
                        $invoiceItems = session('cart');
                    } else {
                        $invoiceItems = [];
                    }

                    $grandTotal = 0;
                    $grandDiscount = 0;

                @endphp
                @foreach ($invoiceItems as $key => $item)
                    @php

                        $product = App\Models\Product::all()->find($key);
                        $subtotal = $item * $product['sellingPrice'];
                        $grandTotal += $subtotal;
                    @endphp
                    <tr>
                        <td>{{ $key }}</td>
                        <td>{{ $product['name'] }}</td>
                        <td>{{ $product['sellingPrice'] }}</td>
                        <td>{{ $item }}</td>
                        <td>0</td>
                        <td class="text-right">{{ number_format($subtotal, 2, '.', '') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-6">
        <p class="lead">Payment Methods:</p>
        <input type="radio"  name="paymentMethod" id="cash" value="Cash" required /><label class="ml-2" for="cash">Cash</label><br />
        <input type="radio"  name="paymentMethod" id="E-Cash" value="E-Cash" required/><label class="ml-2" for="E-Cash">E-Cash</label><br />
        <div>
            @error('paymentMethod') <span class="error">{{ $message }}</span> @enderror 
        </div>
    </div>
    <div class="col-2"></div>
    <div class="col-4">
        <div class="table-responsive">
            @php
                $taxAmount = $grandTotal * 0.1; //this will be used later
                $grandTotalWithTax = $grandTotal + $taxAmount;

            @endphp
            <table class="table">
                <tbody>
                    <tr>
                        <th class="th-50">Subtotal:</th>
                        <td class="text-right">{{ number_format($grandTotal, 2, '.', '') }}</td>
                    </tr>
                    <tr>
                        <th>Tax (10%)</th>
                        <td class="text-right">{{ number_format($taxAmount, 2, '.', '') }}</td>
                    </tr>
                    <tr>
                        <th>Total:</th>
                        <td class="text-right"><input name="grandTotal"
                                value="{{ number_format($grandTotal, 2, '.', '') }}" readonly />
                                <div>
                                    @error('grandTotal') <span class="error">{{ $message }}</span> @enderror 
                                </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

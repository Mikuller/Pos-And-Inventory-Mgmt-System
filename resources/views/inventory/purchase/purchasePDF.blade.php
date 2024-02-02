<div class="col-md-9">
    <div class="card mb-0">
        <div class="card-body">
            <div class="col-md-12">
                <div class="card">
                    @if ($purchase != null)
                        <div class="card-header d-block">
                            <h3>Purchase Date :: <span class="text-success">{{ date_format( $purchase->created_at, "F j, Y, g:i a")  }}</span></h3>
                        </div>
                        <div class="card-body">
                            <div class="dt-responsive">


                                <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                
                                                <th class="wp-10">SL</th>
                                                <th class="wp-30">Product</th>
                                                <th class="wp-20 text-center">Unit Price</th>
                                                <th class="wp-15">Quanity</th>
                                                <th class="wp-20 text-center">Total</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($purchase->products as $index => $product)
                                                <tr>
                                                   
                                                    <td>{{ $index + 1 }}</td>
                                                    <td> 
                                                        {{ $product->name }}</td>
                                                    <td><input type="text" name="price"
                                                            class="form-control w-100 text-center hm-30"
                                                            value="{{ number_format($product->purchasePrice - $product->purchasePrice * 0.15) }}"
                                                            readonly></td>
                                                    <td><input type="text" name="Quantity"
                                                            class="form-control w-60 text-center hm-30"
                                                            value={{ number_format($product->pivot->amount) }} readonly></td>
                                                    <td class="text-right">
                                                        {{ number_format($product->pivot->amount * ($product->purchasePrice - $product->purchasePrice * 0.15)) }}
                                                    </td>
                                                </tr>
                                            @endforeach
            
            
                                            <tr>
                                                <th class="border-0" colspan="3"></th>
                                                <th>Sub Total</th>
                                                <th class="text-right">{{number_format($purchase->grandTotal - $purchase->totalTax) }}</th>
                                            </tr>
                                            <tr>
                                                <td class="border-0" colspan="3"></td>
                                                <td>Tax (<span id="tax-per">15</span>%)</td>
                                                <td class="text-right">{{ $purchase->totalTax }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-0" colspan="3"></td>
                                                <td>Shipping</td>
                                                <td class="text-right">{{number_format($purchase->shippingCost)}}</td>
                                            </tr>
                                           
                                            <tr>
                                                <th class="border-0" colspan="3"></th>
                                                <th>Grand Total</th>
                                                <th class="text-right">{{ number_format($purchase->grandTotal) }}
                                                </th>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@livewireStyles
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table,
    th,
    td {
        border: 1px solid #ddd;
    }

    th,
    td {
        padding: 12px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    td {
        background-color: #ffffff;
    }

    a.btn-success {
        margin-bottom: 20px;
        display: inline-block;
    }

    .text-center {
        text-align: center;
    }

    .text-right {
        text-align: right;
    }

    .hm-30 {
        height: 30px;
    }

    .w-60 {
        width: 60%;
    }
    th {
        background-color: #f2f2f2;
    }

    td, th {
        vertical-align: middle;
    }

    @media (max-width: 768px) {
        .w-60 {
            width: 100%;
        }
    }
</style>


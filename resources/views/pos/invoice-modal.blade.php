<!-- Preview Invoice Modal -->
<div class="modal fade edit-layout-modal pr-0 " id="InvoiceModal" role="dialog" aria-labelledby="InvoiceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog mw-70" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="InvoiceModalLabel">Preview Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="card-header">
                    <h3 class="d-block w-100 p-3"><small class="float-right"><b>Issue
                                Date:</b>{{ date('Y-m-d') }}<br></small></h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('sales.create') }}" method="POST">
                        @csrf
                        <div class="row invoice-info">
                            <div class="col-sm-12">
                                <h4 class="text-right">Invoice #INV0{{ App\Models\Product::all()->count() + 1 }}</h4>
                            </div>
                            <div class="col-sm-3  invoice-col">
                                From
                                <address>
                                    <strong>Fitsum Mobile,</strong><br>Fitsum <br>Ethiopia, Adama <br>Phone: +251
                                    949402695<br>Email:
                                    Fitsa55@gmail.com
                                </address>
                            </div>
                            <div class="col-sm-3 invoice-col">

                                <label class="d-block">Customer Information</label>
                                <div class="d-block">

                                    @if (session('customerInfo') != null)
                                        To
                                        <address>
                                            <strong>{{ session('customerInfo')['customerName'] }}</strong><br>Phone:
                                            {{ session('customerInfo')['customerPhone'] }}
                                        </address>
                                    @endif

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
                                            <th class="wp-10">ID</th>
                                            <th class="wp-40">Product</th>
                                            <th class="wp-20">Unit Price</th>
                                            <th class="wp-15">Qty</th>

                                            <th class="wp-15 text-right">Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $invoiceItems = null;
                                            if (session('cart') != null) {
                                                $invoiceItems = session('cart');
                                            } else {
                                                $invoiceItems = [];
                                            }

                                            $grandTotal = 0;
                                            // $grandDiscount = 0;
                                        @endphp
                                        @if ($invoiceItems != null)
                                            @forelse ($invoiceItems as $key => $item)
                                                @php

                                                    $product = App\Models\Product::all()->find($key);
                                                    $subtotal = $item * $product['sellingPrice'];
                                                    $grandTotal += $subtotal;
                                                @endphp
                                                <tr>
                                                    <td>{{ $key }}</td>
                                                    <td>{{ $product['name'] }}</td>
                                                    <td>{{ $product['sellingPrice'] }}
                                                    </td>
                                                    <td>{{ $item }}</td>

                                                    <td class="text-right">{{ number_format($subtotal, 2, '.', '') }}
                                                    </td>
                                                </tr>
                                            @empty
                                            @endforelse
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <p class="lead">Payment Methods:</p>
                                <input type="radio" name="paymentMethod" id="cash" value="Cash"
                                    required /><label class="ml-2" for="cash">Cash</label><br />
                                <input type="radio" name="paymentMethod" id="E-Cash" value="E-Cash"
                                    required /><label class="ml-2" for="E-Cash">E-Cash</label><br />
                                <div id="eCashRefNumberWrapper" class="form-group" style="display: none;">
                                    
                                    <div class="row" id="bankInfoWrapper">
                                        <div class="col-sm-7 pr-0">
                                            <select class="form-control" name="depositBank" required>
                                                <option selected="selected" value="">Select Deposit Bank</option>
                                                @php
                                                    $banks = App\Models\DepositBank::latest()->get();
                                                @endphp
                                                @forelse ($banks as $bank)
                                                <option value="{{$bank->id}}">{{$bank->bankName."-".$bank->accNum}}</option>
                                                    
                                                @empty
                                                <option value="">No bank Info Added Yet</option>
                                                    
                                                @endforelse

                                            </select>

                                        </div>
                                        
                                        <div class="col-sm-8 pr-0 pl-2 ml-2 pt-1 ">
                                            <input class="form-control mt-2 " type="text" name="eCashRefNumber"
                                                id="eCashRefNumber" placeholder="Txn Refrence Number" required/>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-2"></div>
                            <div class="col-4">
                                <div class="table-responsive">
                                    @php

                                        // $taxAmount = $grandTotal * 0.15; //this will be used later
                                        // $subTotal = $grandTotal - $taxAmount;
                                        // $grandTotalWithTax = $grandTotal + $taxAmount; //this is commented because the total price for all products is tax included
                                    @endphp
                                    <table class="table">
                                        <tbody>
                                            {{-- <tr>
                                                <th class="th-50">Subtotal:</th>
                                                <td class="text-right">{{ number_format($subTotal, 2, '.', '') }}</td>
                                            </tr> --}}
                                            {{-- <tr>
                                                <th>Tax (15%)</th>
                                                <td class="text-right"><input class="text-center" type="text"
                                                        name="totalTax"
                                                        value="{{ number_format($taxAmount, 2, '.', '') }}" readonly />
                                                </td>
                                            </tr> --}}
                                            <tr>
                                                <th>Grand Total:</th>
                                                <td class="text-right"><input class="text-center" type="text"
                                                        name="grandTotal"
                                                        value="{{ number_format($grandTotal, 2, '.', '') }}"
                                                        readonly />

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <div class="row no-print">
                            <div class="col-12">

                                <button type="submit" class="btn btn-success pull-right"><i
                                        class="fa fa-credit-card"></i> Submit Payment</button>


                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Get the radio button and text input elements
    const eCashRadio = document.getElementById('E-Cash');
    const cashRadio = document.getElementById('cash');
   
    const eCashRefNumberWrapper = document.getElementById('eCashRefNumberWrapper');
   

    const refNum = document.getElementById('eCashRefNumber');
    // Add event listener to the radio button
    eCashRadio.addEventListener('change', function() {
        // If the E-Cash radio button is checked, show the text input
        if (this.checked) {
            eCashRefNumberWrapper.style.display = 'block';
            refNum.required = true;
            creditAccountNum.required = true;
        } else {
            // If the E-Cash radio button is unchecked, hide the text input
            eCashRefNumberWrapper.style.display = 'none';
            refNum.required = false;
            creditAccountNum.required = false;

        }
    });
    cashRadio.addEventListener('change', function() {

        if (this.checked) {
            eCashRefNumberWrapper.style.display = 'none';
            refNum.required = false;
            creditAccountNum.required = false;

        } else {
            eCashRefNumberWrapper.style.display = 'block';
            refNum.required = true;
            creditAccountNum.required = true;
        }
    });
   
</script>


@livewireStyles
<style>
    /* Add the following styles to your existing stylesheet or in a <style> tag in your HTML */

    .row.invoice-info {
        margin-bottom: 20px;
    }

    .row.invoice-info address {
        font-size: 14px;
    }

    .table thead th,
    .table tbody td {
        border: 1px solid #ddd;
        padding: 10px;
    }

    .table thead th {
        background-color: #f2f2f2;
    }

    .table tbody td {
        background-color: #ffffff;
    }

    .table-responsive {
        margin-top: 20px;
    }

    .row:last-child {
        margin-top: 20px;
    }

    .col-6,
    .col-4 {
        padding: 0 15px;
    }

    .col-6 p.lead {
        margin-bottom: 15px;
    }

    input[type="radio"] {
        margin-right: 5px;
    }
</style>

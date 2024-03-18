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
                <div class="card-header p-2">

                    <h3 class="d-block w-100 p-3"><small class="float-right"><b>Issue
                                Date : </b>{{ date_format( session('sale')->created_at, "F j, Y, g:i a")  }}<br></small></h3>


                </div>
                <div class="card-body">
                    
                       <div class="row invoice-info">
                        <div class="col-sm-12">
                            <h4 class="text-right">Invoice #INV0{{session('sale')->id}}</h4>
                        </div>
                        <div class="col-sm-3  invoice-col">
                            From
                            <address>
                                <strong>Yene POS,</strong><br>Mikuda <br>Ethiopia, Adama <br>Phone: +251 949402695<br>Email:
                                fasikamillion75@gmail.com
                            </address>
                        </div>
                        <div class="col-sm-3 invoice-col">
                    
                            <label class="d-block">Customer Information</label>
                            <div class="d-block">
                    
                                @if (session('sale') != null)
                                    To
                                    <address>
                                        <strong>{{ session('sale')->customerName}}</strong><br>Phone:
                                        {{session('sale')->customerPhone}}
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
                                  
                                    @if ( session('sale') != null)
                                        @forelse ( session('sale')->products as $product)
                                        
                                            <tr>
                                                <td>{{ $product->id }}</td>
                                                <td>{{ $product['name'] }}</td>
                                                <td>{{ $product['sellingPrice'] - $product['sellingPrice'] * 0.15 }}</td>
                                                <td>{{ $product->pivot->amount }}</td>
                    
                                                <td class="text-right">{{ number_format(($product['sellingPrice'] - $product['sellingPrice'] * 0.15 * $product->pivot->amount), 2, '.', '') }}</td>
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
                            <p class="lead">Payment Method:</p>
                            <input type="text" class="text-center" value="{{ session('sale')->eCashRefNumber==null  ? session('sale')->paymentMethod  : session('sale')->paymentMethod." : ".session('sale')->eCashRefNumber }}" readonly/><br />
                            
    
                        </div>
                        <div class="col-2"></div>
                        <div class="col-4">
                            <div class="table-responsive">
                                @php
                    
                                    
                                    $subTotal = session('sale')->grandTotal - session('sale')->totalTax;
                                    // $grandTotalWithTax = $grandTotal + $taxAmount; //this is commented because the total price for all products is tax included
                                @endphp
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th class="th-50">Subtotal:</th>
                                            <td class="text-right">{{ number_format($subTotal, 2, '.', '') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tax (15%)</th>
                                            <td class="text-right"><input class="text-center" type="text" name="totalTax"
                                                    value="{{ number_format(session('sale')->totalTax, 2, '.', '') }}" readonly/></td>
                                        </tr>
                                        <tr>
                                            <th>Grand Total:</th>
                                            <td class="text-right"><input  class="text-center" type="text" name="grandTotal"
                                                    value="{{ number_format(session('sale')->grandTotal, 2, '.', '') }}" readonly />
                    
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                        <div class="row no-print">
                            <div class="col-12">
                                  <a href="{{route('sales.generateInvoice')}}"><button type="button" class="btn btn-primary pull-right"><i class="fa fa-download"></i>
                                    Generate PDF</button> </a>
                            </div>
                        </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>
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

                   
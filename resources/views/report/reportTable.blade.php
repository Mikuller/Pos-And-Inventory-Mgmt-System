<div class="col-md-9">
    <div class="card mb-0">
        <div class="card-body">
            <div class="col-md-12">
                <div class="card">
                    @if ($data != [])
                        <div class="card-header d-block">
                            <h3>REPORT DATE INTERVAL :: <span class="text-success">{{ $startDate }} -
                                    {{ $endDate }}</span></h3>
                        </div>
                        <div class="card-body">
                            <div class="dt-responsive">


                                <a href="{{ route('report.download') }}" class="mb-8 btn-success btn-sm ">Download
                                    Report</a>


                                <table id="complex-dt" class="table table-striped table-bordered nowrap mt-5">
                                    @if ($data != [])
                                        <tr>
                                            <th rowspan="4">INCOME</th>
                                        <tr>
                                            <th>Total Sales Income</th>
                                            <td><span
                                                    class="text-success font-weight-bold">{{ number_format($data['totalSalesIncome']) }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Total Service Income</th>
                                            <td><span
                                                    class="text-success font-weight-bold">{{ number_format($data['totalServiceIncome']) }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Total Revenue</th>
                                            <td colspan="2">{{number_format($data['totalRevenue'])}}</td>
                                        </tr>
                                        </tr>
                                        <tr>
                                            <th rowspan="3">COST</th>
                                        <tr>
                                            <th>Total Cost of Sales</th>
                                            <td colspan="2">{{ number_format($data['totalPurchaseCost']) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total Shipping Cost</th>
                                            <td colspan="2">{{ number_format($data['totalShippingCost'] )}}</td>
                                        </tr>

                                        </tr>
                                        <tr>
                                            <th rowspan="2">GROSS INCOME</th>
                                        <tr>
                                            <th>INCOME - COST</th>
                                            <td colspan="2">{{ number_format($data['grossIncome'])  }}</td>
                                        </tr>

                                        </tr>
                                        <tr>
                                            <th rowspan="7">EXPENSES</th>
                                        <tr>
                                            <th>Rent Expense</th>
                                            <td>{{number_format($data['expenses']['Rent'])}}</td>
                                        </tr>
                                        <tr>
                                            <th>Service Expense</th>
                                            <td>{{number_format($data['expenses']['Service'])}}</td>
                                        </tr>
                                        <tr>
                                            <th>Food Expense</th>
                                            <td>{{number_format($data['expenses']['Food'])}}</td>
                                        </tr>
                                        <tr>
                                            <th>Salary Expense</th>
                                            <td>{{number_format($data['expenses']['Salary'])}}</td>
                                        </tr>
                                        <tr>
                                            <th>Transport Expense</th>
                                            <td>{{number_format($data['expenses']['Transport'])}}</td>
                                        </tr>
                                        <tr>
                                            <th>Other Expense</th>
                                            <td>{{number_format($data['expenses']['Other'])}}</td>
                                        </tr>

                                        </tr>
                                        <tr>
                                            <th rowspan="2">PROFIT</th>
                                        <tr>
                                            <th>Total Profit</th>
                                            <td colspan="2">{{ number_format($data['totalProfit']) }}</td>
                                        </tr>

                                        </tr>
                                    @endif

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
</style>

<html>
<title>GLOBALTHRIFT : Print PaySlip </title>

<!-- Fonts -->

<style>
    @page {
        margin-top: 0px;
        margin-bottom: 0px;
    }

    body {
        font-family: 'Calibri';
        padding: 10px;
    }

    .text-center {

        text-align: center;
    }

    .text-left {
        text-align: left;
    }

    .text-right {
        text-align: right;
    }

    hr {
        border-top: #000;

    }


    .table {
        border: 1px solid #000 !important;
        width: 100%;
    }

    .table td {
        border: 1px solid #000 !important;
    }

    .table th {
        border: 1px solid #000 !important;
    }

    .table {
        border-collapse: collapse;
    }
    .nice-break{
        page-break-before: auto;
    }
</style>
</head>

<body>
    @foreach($Employee as $emp)
    <br/><br/><br/><br/><br/><br/>
                        <div id="{{$emp->Employee_Code}}">
                            <legend>{{$emp->Title}}&nbsp;{{$emp->EmpFirstName}}&nbsp;{{$emp->EmpMiddleName}}&nbsp;{{$emp->EmpLastName}}</legend><br/>
                            <label>Payslip of __/{{$monthof}}/{{$yearof}}, Global Thrift and Credit Cooperative Society Ltd.</label><br/><br/>
                            <table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 12px !important;" >
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Salary Head</th>
                                        <th>Salary Head Code</th>
                                        <th>Income</th>
                                        <th>Deduction</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sl=0;
                                        $totin=0;
                                        $totded=0;
                                    @endphp
                                    @foreach($payslipAll as $slip)
                                    @php
                                        $sl++;
                                    @endphp
                                    @if($emp->Employee_Code==$slip->Emp_Code)
                                    <tr>
                                        <td>{{$sl}}</td>
                                        <td>{{$slip->SalaryHeadID}}</td>
                                        <td>{{$slip->SalaryHeadCode}}</td>
                                        @if($slip->Income==1)
                                            <td style="text-align:right">{{$slip->Amount}}</td>
                                            <td> </td>
                                            @php
                                                $totin=$totin+$slip->Amount;
                                            @endphp
                                        @else
                                            <td ></td>
                                            <td style="text-align:right">{{$slip->Amount}}</td>
                                            @php
                                                $totded=$totded+$slip->Amount;
                                            @endphp
                                        @endif
                                        {{-- <td style="text-align:right">{{$tot}}</td> --}}
                                        <td></td>
                                    </tr>
                                    @endif
                                    @endforeach
                                    <tr>
                                        <th colspan="3" style="text-align:right">TOTAL:</th>
                                        <th style="text-align:right">{{$totin}}</th>
                                        <th style="text-align:right">{{$totded}}</th>
                                        <th style="text-align:right">{{$totin-$totded}}</th>
                                    </tr>
                                </tbody>
                                <p style="page-break-before: always">
                            </table>
                        </div>
                        {{-- <p style="page-break-before: always"> --}}
                        @endforeach


</body>

</html>

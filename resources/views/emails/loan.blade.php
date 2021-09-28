@component('mail::message')
<style>
    p{
        color: #2d2a2a !important;
    }
    strong{
        font-weight: 600;
        color: #2d2a2a !important;
    }
    h4{
        line-height: 1rem;
        font-size: 18px;
        font-weight: 700;
        color: #2d2a2a !important;
    }
    span{
        color: #2d2a2a !important;
    }
</style>
@if( $data['type'] == 'loan request')

<p>Hello Super Admin,</p>
<p>
    You have a new loan request, below are the applicant's details:<br> 
    <strong>Client ID : </strong>{{ $data['client_no'] }}<br>
    <strong>Client Name : </strong> {{ $data['name'] }}<br>
    <strong>Client Phone no : </strong>{{ $data['phone'] }}<br>
<p>
    <h4>Loan Details</h4>
<p>
    <strong>Form Payment : </strong>&#x20A6;{{ number_format($data['formpayment']) }}<br>
    <strong>Tenure : </strong> {{ $data['tenure'] }} month<br>
    <strong>Loan Amount : </strong>&#x20A6;{{ number_format($data['loan_amount']) }}<br>
    <strong>Intrest Rate : </strong>{{ number_format($data['intrest_percent'])  }}%<br>
    <strong>Calculated Intrest : </strong>&#x20A6;{{ number_format($data['intrest'])  }}<br>
    <strong>Calculated First Payment : </strong>&#x20A6;{{ number_format($data['fp_amount']) }}<br>
    <strong>Calculated Total Expected Payback : </strong>&#x20A6;{{ number_format($data['total_payback']) }}<br>
</p>
<p>Note that this request is still in review, no disbursement has been made yet, click <a href="" target="_blank">here</a> to login and review.</p>

<span>Request was handled by  {{ $data['admin_incharge'] }},<br>
    On {{ date('d, M Y, @ h:i:s', strtotime($data['date'])) }}.</span>
@endif

@if( $data['type'] == 'update loan request')

<p>Hello Super Admin,</p>
<p>
    A loan request with <strong>Client ID : </strong>{{ $data['client_no'] }} was updated, below are the Updated details:<br> 
    <strong>Client ID : </strong>{{ $data['client_no'] }}<br>
    <strong>Client Name : </strong> {{ $data['name'] }}<br>
    <strong>Client Phone no : </strong>{{ $data['phone'] }}<br>
<p>
    <h4>Loan Details</h4>
<p>
    <strong>Tenure : </strong> {{ $data['tenure'] }} month<br>
    <strong>Loan Amount : </strong>&#x20A6;{{ number_format($data['loan_amount']) }}<br>
    <strong>Calculated Intrest : </strong>&#x20A6;{{ number_format($data['intrest'])  }}<br>
    <strong>Intrest Rate : </strong>{{ number_format($data['intrest_percent'])  }}%<br>
    <strong>Calculated Forward Payment : </strong>&#x20A6;{{ number_format($data['fp_amount']) }}(Unpaid)<br>
    <strong>Calculated Total Expected Payback : </strong>&#x20A6;{{ number_format($data['total_payback']) }}<br>
</p>
<p>Note that this request is still in review, no disbursement has been made yet, click <a href="" target="_blank">here</a> to login and review.</p>
<span>Update was handled by  {{ $data['admin_incharge'] }},<br>
    On {{ date('d, M Y, @ h:i:s', strtotime($data['date'])) }}.</span>
@endif

@if( $data['type'] == 'loan disbursement')

<p>Hello Super Admin,</p>
<p>
    A disbursement has just been made to client with <strong>ID No: </strong>{{ $data['client_no'] }}, below are details of the disbursement:<br> 
    <strong>Client ID : </strong>{{ $data['client_no'] }}<br>
    <strong>Client Name : </strong> {{ $data['name'] }}<br>
    <strong>Client Phone no : </strong>{{ $data['phone'] }}<br>
</p>
    <h4>Loan Details</h4>
<p>
    <strong>Tenure : </strong> {{ $data['tenure'] }} month<br>
    <strong>Loan Amount : </strong>&#x20A6;{{ number_format($data['loan_amount']) }}<br>
    <strong>Intrest : </strong>&#x20A6;{{ number_format($data['intrest'])  }}<br>
    <strong>Total Payback : </strong>&#x20A6;{{ number_format($data['total_payback']) }}<br>
    <strong>Loan Duration : </strong>{{ date('M, Y', strtotime($data['disbursement_date'])) }} - {{ date('M, Y', strtotime($data['loan_duration'])) }}<br>
</p>
<h4>Payment Details</h4>
<p>
    <strong>Expected Profit : </strong>&#x20A6;{{ number_format($data['expect_profit']) }}<br>
    <strong>Forward Payment : </strong>&#x20A6;{{ number_format($data['fp_amount']) }} <span>({{ $data['fp_status'] }})</span><br>
    <strong>Monthly Payback : </strong>&#x20A6;{{ number_format($data['monthly_payback']) }}<br>
    <strong>Next Due Date : </strong>{{ date('d, M Y', strtotime($data['next_due_date'])) }}<br>
    <strong>Expected Payback : </strong>&#x20A6;{{ number_format($data['expect_pay']) }}<br>
</p>
<p>Click <a href="" target="_blank">here</a> to login and review, login on desktop for best review.</p>

<span>Disbursed by  {{ $data['admin_incharge'] }},<br>
    On {{ date('d, M Y, @ h:i:s', strtotime($data['disbursement_date'])) }}.</span>
@endif
@endcomponent

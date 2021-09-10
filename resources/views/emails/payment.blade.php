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

@if( $data['type'] == 'payment')

<p>Hello Super Admin,</p>
<p>
    A new payment had just been made by client with <strong>ID No: </strong>{{ $data['client_no'] }}, below are details of the payment:<br> 
    <strong>Client ID : </strong>{{ $data['client_no'] }}<br>
    <strong>Client Name : </strong> {{ $data['name'] }}<br>
    <strong>Client Phone no : </strong>{{ $data['phone'] }}<br>
</p>
    <h4>Loan Details</h4>
<p>
    <strong>Tenure : </strong> {{ $data['tenure'] }} month<br>
    <strong>Loan Amount : </strong>#{{ $data['loan_amount'] }}<br>
    <strong>Intrest : </strong>#{{ $data['intrest'] }}<br>
    <strong>Total Payback : </strong>#{{ $data['total_payback'] }}<br>
    <strong>Loan Duration : </strong>{{ date('M, Y', strtotime($data['disbursement_date'])) }} - {{ date('M, Y', strtotime($data['loan_duration'])) }}<br>
    <strong>Total Amount Paid : </strong>#{{ $data['total_amountpaid'] }} (this pay included)<br>
    <strong>Total Actual Profit Made : </strong>#{{ $data['actual_profit'] }} (this pay included)
</p>
<h4>Payment Details</h4>
<p>
    <strong>Amount Paid: </strong>#{{ $data['amount_paid'] }}<br>
    <strong>No of time the client has paid is : </strong>{{ $data['no_of_time_paid'] }}<br>
</p>
<h4>Next Payment Details</h4>
<p>
    <strong>Outstanding Pay : </strong>#{{ $data['outstanding'] }}<br>
    <strong>Balance Brought Forward: </strong>#{{ $data['bb_forward'] }}<br>
    <strong>Monthly Payback : </strong>#{{ $data['monthly_payback'] }}<br>
    <strong>Expected Next Pay : </strong>#{{ $data['next_pay'] }}<br>
    <strong>Next Due Date : </strong>{{ date('d, M Y', strtotime($data['next_due_date'])) }}<br>
</p>
<p>Click <a href="" target="_blank">here</a> to login and review, login on desktop for best review.</p>

<span>Payment handled by {{ $data['admin_incharge'] }},<br>
    On {{ date('d, M Y, @ h:i:s', strtotime($data['date_paid'])) }}.</span>
@endif

@if( $data['type'] == 'payment completed')

<p>Hello Super Admin,</p>
<p>
    A new payment had just been made by client with <strong>ID No: </strong>{{ $data['client_no'] }}, this payment makes the last payment of the client for this tenure, below are details of the payment:<br> 
    <strong>Client ID : </strong>{{ $data['client_no'] }}<br>
    <strong>Client Name : </strong> {{ $data['name'] }}<br>
    <strong>Client Phone no : </strong>{{ $data['phone'] }}<br>
</p>
    <h4>Loan Details</h4>
<p>
    <strong>Tenure : </strong>{{ $data['tenure'] }} month<br>
    <strong>Loan Amount : </strong>#{{ $data['loan_amount'] }}<br>
    <strong>Intrest : </strong>#{{ $data['intrest'] }}<br>
    <strong>Total Payback : </strong>#{{ $data['total_payback'] }}<br>
    <strong>Loan Duration : </strong>{{ date('M, Y', strtotime($data['disbursement_date'])) }} - {{ date('M, Y', strtotime($data['loan_duration'])) }}<br>
    <strong>Total Amount Paid:</strong>#{{ $data['total_amountpaid'] }} (this pay included)<br>
    <strong>Monthly Payback : </strong>#{{ $data['monthly_payback'] }}
</p>
<h4>Payment Details</h4>
<p>
    <strong>Amount Paid : </strong>#{{ $data['amount_paid'] }}<br>
    <strong>No of time the client has paid is : </strong>{{ $data['no_of_time_paid'] }}<br>
</p>
<p>Click <a href="" target="_blank">here</a> to login and review, login on desktop for best review.</p>
<p> Note that this loan tenure has been closed beacuse the payback has been completed, Our total profit was #{{ $data['actual_profit'] }}</p>

<span>Payment handled by {{ $data['admin_incharge'] }},<br>
    On {{ date('d, M Y, @ h:i:s', strtotime($data['date_paid'])) }}.</span>
@endif

@if( $data['type'] == 'payment extended')

<p>Hello Super Admin,</p>
<p>
    A new payment has just been made by client with <strong>ID No: </strong>{{ $data['client_no'] }}, the client has come to the end of its initial tenure, but expected payback has not been completed, the tenure has now been extended by 1 month, below are details of the payment:<br> 
    <strong>Client ID : </strong>{{ $data['client_no'] }}<br>
    <strong>Client Name : </strong> {{ $data['name'] }}<br>
    <strong>Client Phone no : </strong>{{ $data['phone'] }}<br>
</p>
    <h4>Loan Details</h4>
<p>
    <strong>Initial Tenure : </strong> {{ $data['tenure'] }} month<br>
    <strong>Loan Amount : </strong>#{{ $data['loan_amount'] }}<br>
    <strong>Intrest : </strong>#{{ $data['intrest'] }}<br>
    <strong>Total Payback : </strong>#{{ $data['total_payback'] }}<br>
    <strong>Loan Duration : </strong>{{ date('M, Y', strtotime($data['disbursement_date'])) }} - {{ date('M, Y', strtotime($data['loan_duration'])) }}<br>
    <strong>Total Amount Paid : </strong>#{{ $data['total_amountpaid'] }} (this pay included)<br>
    <strong>Total Actual Profit Made : </strong>#{{ $data['actual_profit'] }} (this pay included)
</p>
<h4>Payment Details</h4>
<p>
    <strong>Amount Paid: </strong>#{{ $data['amount_paid'] }}<br>
    <strong>No of time the client has paid is : </strong>{{ $data['no_of_time_paid'] }}<br>
</p>
<h4>Next Payment Details</h4>
<p>
    <strong>Outstanding Pay : </strong>#{{ $data['outstanding'] }}<br>
    <strong>Balance Brought Forward: </strong>#{{ $data['bb_forward'] }}<br>
    <strong>Monthly Payback : </strong>#{{ $data['monthly_payback'] }}<br>
    <strong>Expected Next Pay : </strong>#{{ $data['next_pay'] }}<br>
    <strong>Next Due Date : </strong>{{ date('d, M Y', strtotime($data['next_due_date'])) }}<br>
</p>
<p>Click <a href="" target="_blank">here</a> to login and review, login on desktop for best review.</p>

<span>Payment handled by {{ $data['admin_incharge'] }},<br>
    On {{ date('d, M Y, @ h:i:s', strtotime($data['date_paid'])) }}.</span>
@endif
@endcomponent
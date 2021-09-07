@extends('layouts.main') 
@section('title','Loan History') 
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Loan History</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home')  }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Loan</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <div class="row">
                    <div class="col-md-8 col-sm-12">
                        <span>Here is the begining of loan request, for all loan input, </span><br><span>forward payment must have been made else, it's made on disbursement</span>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a href="{{ route('requestloan') }}">
                            <button class="btn btn-primary pull-right" type="button" data-bs-toggle="tooltip" title="Add new debitor">Request Loan</button>
                        </a>
                    </div>
                </div>
              </div>
              <div class="card-body">
                  @include('includes.alerts');
                <div class="table-responsive">
                    <table class="display" id="advance-1">
                      <thead>
                        <tr>
                          <th>Client ID #</th>
                          <th>Name</th>
                          <th>Loan Amount</th>
                          <th>Outstanding</th>
                          <th>Tenure</th>
                          <th>Date Applied</th>
                          <th>Forward Payment</th>
                          <th>Expected Payback</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($loans as $loan )
                        <tr>
                            <td>123445</td>
                            <td>{{ $loan->client->name }}</td>
                            <td>{{ $loan->loan_amount }}</td>
                            <td>
                                @foreach ($loan->payment as $payment)
                                @if ($payment->payment_status == 0 )
                                {{ $payment->outstanding_payment }}
                                @endif
                                @endforeach 
                            </td>
                            <td>{{ $loan->tenure }}</td>
                            <td>{{ $loan->created_at->format('M ,d Y') }}</td>
                            <td>
                                {{ $loan->fp_amount }}<br>
                                @if ($loan->fp_status == 'Not paid')
                                <span class="font-secondary f-12">{{ $loan->fp_status }}</span>
                                @endif
                                @if ($loan->fp_status == 'Paid')
                                <span class="font-success f-12">{{ $loan->fp_status }}</span>
                                @endif
                            </td>
                            <td>{{ $loan->total_payback }}</td>
                            <td>
                                @if ($loan->status == 0)
                                <div class="span badge rounded-pill pill-badge-warning">In Review
                                </div>
                                @endif
                                @if ($loan->status == 1)
                                <div class="span badge rounded-pill pill-badge-secondary">Disbursed</div>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                        <button class="btn btn-light view-loan" type="button" 
                                            data-bs-toggle="modal" 
                                            data-loanid="{{ $loan->id }}"
                                            data-payback="{{ !is_null($loan->monthly_payback) ? '#'.$loan->monthly_payback : 'Not Available' }}"
                                            data-profit=" {{ !is_null($loan->expected_profit) ? '#'.$loan->expected_profit : 'Not Available' }}"
                                            
                                            data-clientno="{{ $loan->client->client_no }}"
                                            data-name="{{ $loan->client->name }}" 
                                            data-phone="{{ $loan->client->phone }}"
                                            data-disabled ='
                                            @if ($loan->status == 0)
                                            <button class="btn btn-primary" type="submit">Disburse</button>
                                            @endif'
                                            data-date="{{ $loan->created_at->format('d, M Y') }}"
                                            data-status= '
                                            @if ($loan->status == 0)
                                            <div class="span badge rounded-pill pill-badge-warning">In Review
                                            </div>
                                            @elseif ($loan->status == 1)
                                            <div class="span badge rounded-pill pill-badge-secondary">Disbursed</div>
                                            @endif'
                                            data-picture = 
                                            '@if($loan->client->profile_picture)
                                                <img width="40px" src="{{ "/".$loan->client->profile_picture }}" class="b-r-half pull-right">
                                            @else 
                                                <img width="40px" src="/profile_pictures/avater.png" class="pull-right"> 
                                            @endif'
                                            data-disburse="{{ !is_null($loan->disbursement_date) ? date('d,M Y', strtotime($loan->disbursement_date)) : 'Not Disburse' }}"
                                            data-loan="{{ json_encode($loan->toArray()) }}" 
                                            data-bs-target="#loandetails" 
                                            data-bs-toggle="tooltip" title="View Full Details">
                                            <i class="fas fa-eye text-warning"></i>
                                        </button>
                                        @if ($loan->status == 0)
                                        <a href="{{ route('editloan', $loan->id) }}">
                                            <button class="btn btn-light" type="button" data-bs-toggle="tooltip" title="Edit Loan Details"><i class="fas fa-edit text-info"></i></button>
                                        </a>
                                        @endif
                                        @if ($loan->status == 1)
                                        
                                        @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
              </div>
            </div>
        </div>
    </div>
  </div>
<script>
    $(document).on('click', 'button.view-loan', function(){
            const loanid = $(this).data('loanid');
            const loan = $(this).data('loan');
            const clientno = $(this).data('clientno');
            const name = $(this).data('name');
            const phone = $(this).data('phone');
            const picture = $(this).data('picture');
            const date = $(this).data('date');
            const status = $(this).data('status');
            const payback = $(this).data('payback');
            const disburse = $(this).data('disburse');
            const disabled = $(this).data('disabled');
            const profit = $(this).data('profit');
            //set each form field on the modal
            const loanmodal = $("#loandetails");
            loanmodal.find('[name="loan_id"]').val(loan.id);
            loanmodal.find('#amount').text(loan.loan_amount);
            loanmodal.find('#intrest').text(loan.intrest);
            loanmodal.find('#payback').text(loan.total_payback);
            loanmodal.find('#fpamount').text(loan.fp_amount);
            loanmodal.find('#fpstatus').text(loan.fp_status);
            loanmodal.find('#duration').text(loan.duration);
            loanmodal.find('#dd').text(disburse);
            loanmodal.find('#expected_pay').text(payback);
            loanmodal.find('#expected_profit').text(profit);
            loanmodal.find('#tenure').text(loan.tenure);
            loanmodal.find('#name').text(name);
            loanmodal.find('#phone').text(phone);
            loanmodal.find('#client_no').text(clientno);
            loanmodal.find('#applieddate').text(date);
            $('#profile_picture ').empty()
            $('#profile_picture').append(picture)

            $('#client_status *').empty()
            $('#client_status').append(status) 

            $('#disburse_button ').empty()
            $('#disburse_button').append(disabled) 
        });  
</script>
@include('loan.popup')
@endsection

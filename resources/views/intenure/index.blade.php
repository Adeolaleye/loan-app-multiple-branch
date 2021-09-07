@extends('layouts.main') 
@section('title','All Debtors') 
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>All Clients in Tenure <br> <span class="f-14 font-bold text-warning"> {{ $counter }} total clients in tenure</span></h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">All Debitors</li>
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
                        <span>Here is the details of all clients that are in tenure,</span><br><span>Note that clients in tenure cannot be given loan unti the end of a tenure.</span>
                    </div>
                </div>
              </div>
              <div class="card-body">
                  @include('includes.alerts')
                <div class="table-responsive">
                    <table class="display" id="basic-2">
                      <thead>
                        <tr>
                            <th>Client ID #</th>
                            <th>Client Name</th>
                            <th>Loan Amount (#)</th>
                            <th>Monthly Pay</th>
                            <th>Duration</th>
                            <th>Next Due Date</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($loans as $loan )
                        <tr>
                            <td>{{ $loan->client->client_no }}</td>
                            <td>{{ $loan->client->name }}</td>
                            <td>{{ $loan->loan_amount }}</td>
                            <td>{{ round($loan->monthly_payback,1) }}</td>
                            <td>
                                {{ date('M Y', strtotime($loan->disbursement_date)) }} - {{ date('M Y', strtotime($loan->loan_duration)) }}
                            </td>
                            <td>
                                @foreach ($loan->payment as $payment)
                                @if ($payment->payment_status == 0 )
                                {{ date('d,M Y', strtotime($payment->next_due_date)) }}
                                @endif
                                @endforeach 
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                        <button class="btn btn-light view-tenure" type="button" 
                                            data-bs-toggle="modal" 
                                            data-loanid="{{ $loan->id }}"
                                            data-payback="{{ !is_null(round($loan->monthly_payback,1)) ? '#'.round($loan->monthly_payback,1) : 'Not Available' }}"
                                            data-profit=" {{ !is_null($loan->expected_profit) ? '#'.$loan->expected_profit : 'Not Available' }}"
                                            data-duration="{{ date('M Y', strtotime($loan->disbursement_date)) }} - {{ date('M Y', strtotime($loan->loan_duration)) }}"
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
                                            data-bs-target="#tenuredetails" 
                                            data-bs-toggle="tooltip" title="View Full Details">
                                            <i class="fas fa-eye text-warning"></i>
                                        </button>
                                        @if (!is_null($loan->payment) && $loan->payment->sum('amount_paid') < $loan->total_payback)
                                            <form action="{{ route('makepayment', $loan->id) }}">
                                                <button class="btn btn-light text-success" type="submit">Pay Now</button>
                                            </form> 
                                        @endif
                                        {{-- <form action="{{ route('makepayment', $loan->id) }}">
                                            <button class="btn btn-light text-success" type="submit">Pay Now</button>
                                        </form>  --}}
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
    $(document).on('click', 'button.view-tenure', function(){
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
            const duration = $(this).data('duration');
            //set each form field on the modal
            const loanmodal = $("#tenuredetails");
            loanmodal.find('[name="loan_id"]').val(loan.id);
            loanmodal.find('#amount').text(loan.loan_amount);
            loanmodal.find('#intrest').text(loan.intrest);
            loanmodal.find('#payback').text(loan.total_payback);
            loanmodal.find('#fpamount').text(loan.fp_amount);
            loanmodal.find('#fpstatus').text(loan.fp_status);
            loanmodal.find('#tenure').text(loan.tenure);
            loanmodal.find('#duration').text(duration);
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

            const url = loanmodal.find('a').attr('href');
            let urlArray = url.split('/');
            urlArray[urlArray.length - 1] = loanid;
            const newurl = urlArray.join('/');

            loanmodal.find('a').attr('href', newurl);
        });  
</script>
@include('intenure.popup')
@endsection
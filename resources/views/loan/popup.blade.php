{{-- show loan details --}}
<div class="modal fade" id="loandetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title f-16"><span>Client ID: </span><span id="client_no"></span></h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="post" action="{{ route('disburse.loan') }}">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div id="profile_picture" class="col-2 col-sm-2 col-md-2 col-lg-2 p-r-0">
                </div>
                <div class="col-7 col-sm-7 col-md-7 col-lg-7 padding-0">
                    <h5 class="text-left f-16" id="name" style="margin-bottom: 0rem"></h5>
                    <span id="phone" class="f-12"></span>
                </div>
                <div id="client_status" class="col-3 col-sm-3 col-md-3 col-lg-3" style="margin-left: -15px">
                </div>
            </div>
            <div class="row m-t-20">
                <div class="col-4 col-lg-4 text-center">
                    <p class="f-14 text-warning" style="margin-bottom: 0rem">Loan Request</p>
                    <h3 class="f-14 f-w-600"><span>#</span><span id="amount"></span></h3>
                </div>
                <div class="col-4 col-lg-4 text-center">
                    <p class="f-14 text-info" style="margin-bottom: 0rem">Expected Intrest</p>
                    <h3 class="f-14 f-w-600"> <span id="intrest"></span><br>
                        <span class="font-success f-12 f-w-300"><span id="intrestper"></span>% per month</span></h3>
                </div>
                <div class="col-4 col-lg-4 text-center">
                    <p class="f-14 text-success" style="margin-bottom: 0rem">Total Payback</p>
                    <h3 class="f-14 f-w-600"><span>#</span><span id="payback"></span></h3>
                </div>
            </div>
            <div class="dropdown-divider"></div>
                <div class="card-body">
                    <span>Form Payment: <strong id="formpayment"></strong>(<span>Paid</span>)</span><br>
                    <span>Tenure: <strong id="tenure"></strong></span><br>
                    <span>Date Of Disbursement: <strong id="dd"></strong></span><br>
                    <span>Expected Monthly Pay: <strong id="expected_pay"></strong></span><br>
                    <span>Forward Payment: <strong id="fpamount">#</strong>(<span id="fpstatus"></span>)</span><br>
                    {{-- <span>Monthly Interest: <strong>#</strong><strong id="">intrest/tenure</strong></span><br> --}}
                    <span>Expected Profit: <strong id="expected_profit"></strong></span><br>
                    <div class="bg-secondary-light m-10 p-t-10 p-b-10 text-center b-r-6">
                      <span class="" >Applied&nbsp;<span id="applieddate"></span></span>
                    </div>
                    <div class="form-check checkbox checkbox-primary mb-0">
                            <input class="form-check-input" id="checkbox-primary-1" type="checkbox" name="fp_status" required>
                            <label class="form-check-label" for="checkbox-primary-1">Forward Payment</label>
                            <input class="form-check-input" type="hidden" value="" name="loan_id">
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
            <span id="disburse_button"></span>
        </div>
        </form>
      </div>
    </div>
  </div>
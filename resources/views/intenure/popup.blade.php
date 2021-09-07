{{-- show details --}}
<div class="modal fade" id="tenuredetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title f-16"><span>Client ID: </span><span id="client_no"></span></h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
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
                        <span class="font-success f-12 f-w-300">5% per month</span></h3>
                </div>
                <div class="col-4 col-lg-4 text-center">
                    <p class="f-14 text-success" style="margin-bottom: 0rem">Total Payback</p>
                    <h3 class="f-14 f-w-600"><span>#</span><span id="payback"></span></h3>
                </div>
            </div>
            <div class="dropdown-divider"></div>
                <div class="card-body">
                    <span>Date Of Disbursement: <strong id="dd"></strong></span><br>
                    <span>Expected Monthly Pay: <strong id="expected_pay"></strong></span><br>
                    <span>Forward Payment: <strong id="fpamount">#</strong>(<span id="fpstatus"></span>)</span><br>
                    <span>Expected Profit: <strong id="expected_profit"></strong></span><br>
                    {{-- <span>Monthly Interest: <strong>#</strong><strong id="">intrest/tenure</strong></span><br> --}}
                    <span>Duration: <strong id="duration"></strong></span><br>
                    <span>Tenure: <strong><span id="tenure"></span><span>&nbsp; months</span></strong></span>
                    <div class="bg-secondary-light m-10 p-t-10 p-b-10 text-center b-r-6">
                        <span class="" >Applied&nbsp;<span id="applieddate"></span></span>
                    </div>
                    <div class="dropdown-divider"></div>
                    <span>Total Sum Paid: <strong id="">12,000</strong></span><br>
                    <span>Remaining Amount: <strong id="">#45,500</strong></span><br>
                    <div class="dropdown-divider"></div>
                    <h6>First Month Payment</h6>
                    <span>Balance Brought Forward: <strong id="">500</strong></span><br>
                    <span>Expected Amount: <strong id="">12,500</strong></span><br>
                    <span>Amount Paid: <strong id="">12,500</strong></span><br>
                    <span>Date: <strong id="">12/10/2021</strong></span><br>
                    <div class="dropdown-divider"></div>
                    <h6>Second Month</h6>
                    <span>Balance Brought Forward: <strong id="">500</strong></span><br>
                    <span>Expected Amount: <strong id="">12,500</strong></span><br>
                    <span>Amount Paid: <strong id="">12,500</strong></span><br>
                    <span>Date: <strong id="">12/10/2021</strong></span><br>
                </div>
        </div>
        <form method="post" action="">
            @csrf
            <div class="modal-footer">
                <input type="text" name="loan_id">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                <a href="{{ route('makepayment', $loan->id) }}"><button class="btn btn-primary" type="button">Make Payment</button></a>
            </div>
          </form>
      </div>
    </div>
  </div>
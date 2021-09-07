{{-- Make Payment --}}
<div class="modal fade" id="makepayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title f-16">Random Payment</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="">
                @csrf
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="col-form-label" for="purpose">Purpose</label>
                            <input class="form-control" type="text" value="">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label" for="Amount">Amount</label>
                            <input class="form-control" type="text" value="">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="button">Pay</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Save Money --}}
<div class="modal fade" id="savemoney" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title f-16">Save Money</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="">
                @csrf
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="col-form-label" for="amount">Amount</label>
                            <input class="form-control" type="text" value="" name="amount">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="button">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- delete client --}}
<div class="modal fade" id="deleteclient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title f-16">Delete <span id="todel2"></span> Details</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('destroy', $client->id) }}">
                @csrf
                    <div class="modal-body text-center">
                      <p class="p-t-5 f-16">
                          By deleting this client, all client's <strong>loan</strong> and <strong>payment</strong> history will be deleted,<br><br>Are you sure you want to delete <br> <span id="todel"></span>?
                      </p>
                      <p class="text-warning">Note that this action cannot be undone</p>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                      <button type="submit" class="btn btn-primary">Yes delete</button>
                      <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">No take me back</button>
                    </div>
                </form>
        </div>
    </div>
</div>
{{-- delete client --}}
<div class="modal fade" id="deleteclient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title f-16">Delete Client</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @if (isset($client->id))
            <form method="post" action="{{ route('destroy', $client->id) }}">
                @csrf
                    <div class="modal-body text-center">
                      <h5 class="p-t-5">
                          Are you sure you want to delete <br> <span id="todel"></span>?
                      </h5>
                      <p>This action cannot be undone</p>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                      <button type="submit" class="btn btn-primary">Yes delete</button>
                      <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">No take me back</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
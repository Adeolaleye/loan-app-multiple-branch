{{-- Add Admin --}}
<div class="modal fade" id="addadmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title f-16">Create New Admin</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('createadmin') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                        <div class="mb-3">
                            <label class="col-form-label" for="fullname">Fullname <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label" for="phone">Phone No <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="phone" value="{{ old('phone') }}">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label" for="email">Email Address <span class="text-danger">*</span></label>
                            <input class="form-control" type="email" value="{{ old('email') }}" name="email">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label" for="password">Password <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input class="form-control" type="password" value="{{ old('password') }}" name="password" id="password">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label" for="Role">Role <span class="text-danger">*</span></label>
                            <select class="form-control" name="role" required>
                                <option value=""{{ old('role') ? '' : ' selected' }} disabled>Select Role</option>
                                <option value="Super Admin"{{ old('role') }} >Super Admin</option>
                                <option value="Supervisor"{{ old('role') }} >Supervisor</option>
                                <option value="Branch Manager"{{ old('role') }}>Branch Manager</option>
                                <option value="Officer"{{ old('role') }}>Officer</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label" for="profile_picture">Profile Picture (Optional)</label>
                            <input class="form-control" type="file" value="{{ old('profile_picture') }}" name="profile_picture">
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Create Admin</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- delete admin --}}
<div class="modal fade" id="deleteadmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title f-16">Delete Admin</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('destroyuser', $user->id) }}">
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
        </div>
    </div>
</div>

{{-- Edit admin --}}
<div class="modal fade" id="editadmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title f-16">Edit Admin </h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('update', $user->id) }}" enctype="multipart/form-data">
                @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="col-form-label" for="fullname">Fullname <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="name" value="" required>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label" for="phone">Phone No <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="phone" value="" required>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label" for="email">Email Address <span class="text-danger">*</span></label>
                            <input class="form-control" type="email" value="" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Role <span class="text-danger">*</span></label>
                            <select class="form-control" name="role" required>
                                <option value="{{ $user->role }}">{{ $user->role }}</option>
                                <option value="Super Admin"{{ old('role') }} >Super Admin</option>
                                <option value="Branch Manager"{{ old('role') }}>Branch Manager</option>
                                <option value="Officer"{{ old('role') }}>Officer</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label" for="profile_picture">Profile Picture</label>
                            <div class="avatar">
                                @if($user->profile_picture)
                                    <img width="40px" src="{{ "/".$user->profile_picture }}" class="b-r-half"> 
                                @endif
                            </div>
                            <input class="form-control" type="file" name="profile_picture">
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                      <button type="submit" class="btn btn-primary">Update</button>
                      <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">No take me back</button>
                    </div>
            </form>
        </div>
    </div>
</div>
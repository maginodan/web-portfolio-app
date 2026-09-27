<!-- Edit User Modal -->
<div class="modal fade"
     id="editModal{{ $user->id }}"
     tabindex="-1"
     role="dialog"
     aria-labelledby="editModalLabel{{ $user->id }}">

    <div class="modal-dialog" role="document">

        <form method="POST"
              action="{{ route('admin.users.update', $user->id) }}">

            @csrf
            @method('PATCH')

            <div class="modal-content">

                <!-- Header -->
                <div class="modal-header">

                    <button type="button"
                            class="close"
                            data-dismiss="modal">
                        <span>&times;</span>
                    </button>

                    <h4 class="modal-title"
                        id="editModalLabel{{ $user->id }}">

                        <i class="fa fa-edit"></i>
                        Edit User

                    </h4>

                </div>

                <!-- Body -->
                <div class="modal-body">

                    <!-- Current Photo -->
                    <div class="form-group text-center">

                        @if ($user->image)

                            <img src="{{ asset('uploads/images/' . $user->image) }}"
                                 width="80"
                                 height="80"
                                 class="img-circle"
                                 style="object-fit: cover;"
                                 alt="{{ $user->name }}">

                        @else

                            <img src="{{ asset('uploads/avatar.png') }}"
                                 width="80"
                                 height="80"
                                 class="img-circle"
                                 style="object-fit: cover;"
                                 alt="{{ $user->name }}">

                        @endif

                    </div>

                    <!-- Name -->
                    <div class="form-group">

                        <label for="edit_name_{{ $user->id }}">
                            Name
                        </label>

                        @error('name')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                        @enderror

                        <input type="text"
                               class="form-control"
                               id="edit_name_{{ $user->id }}"
                               name="name"
                               value="{{ old('name', $user->name) }}"
                               placeholder="Enter full name"
                               required>

                    </div>

                    <!-- Email -->
                    <div class="form-group">

                        <label for="edit_email_{{ $user->id }}">
                            Email
                        </label>

                        @error('email')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                        @enderror

                        <input type="email"
                               class="form-control"
                               id="edit_email_{{ $user->id }}"
                               name="email"
                               value="{{ old('email', $user->email) }}"
                               placeholder="Enter email address"
                               required>

                    </div>

                    <!-- Bio -->
                    <div class="form-group">

                        <label for="edit_bio_{{ $user->id }}">
                            Bio
                        </label>

                        <textarea class="form-control"
                                  id="edit_bio_{{ $user->id }}"
                                  name="bio"
                                  rows="4"
                                  placeholder="Enter user bio">{{ old('bio', $user->bio) }}</textarea>

                    </div>

                    <!-- Password -->
                    <div class="form-group">

                        <label for="edit_password_{{ $user->id }}">
                            Password
                        </label>

                        @error('password')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                        @enderror

                        <input type="password"
                               class="form-control"
                               id="edit_password_{{ $user->id }}"
                               name="password"
                               placeholder="Leave empty to keep current password">

                        <p class="help-block">
                            Leave this field empty if you do not want to change the password.
                        </p>

                    </div>

                </div>

                <!-- Footer -->
                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-default"
                            data-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit"
                            class="btn btn-primary">
                        <i class="fa fa-save"></i>
                        Update User
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>
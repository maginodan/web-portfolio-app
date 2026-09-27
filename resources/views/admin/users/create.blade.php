<!-- Create User Modal -->
<div class="modal fade"
     id="createModal"
     tabindex="-1"
     role="dialog"
     aria-labelledby="createModalLabel">

    <div class="modal-dialog" role="document">

        <form method="POST"
              action="{{ route('admin.users.store') }}">

            @csrf

            <div class="modal-content">

                <!-- Header -->
                <div class="modal-header">

                    <button type="button"
                            class="close"
                            data-dismiss="modal">
                        <span>&times;</span>
                    </button>

                    <h4 class="modal-title" id="createModalLabel">
                        <i class="fa fa-user-plus"></i>
                        Add New User
                    </h4>

                </div>

                <!-- Body -->
                <div class="modal-body">

                    <!-- Name -->
                    <div class="form-group">

                        <label for="create_name">
                            Name
                        </label>

                        @error('name')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                        @enderror

                        <input type="text"
                               class="form-control"
                               id="create_name"
                               name="name"
                               value="{{ old('name') }}"
                               placeholder="Enter full name"
                               required>

                    </div>

                    <!-- Email -->
                    <div class="form-group">

                        <label for="create_email">
                            Email
                        </label>

                        @error('email')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                        @enderror

                        <input type="email"
                               class="form-control"
                               id="create_email"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="Enter email address"
                               required>

                    </div>

                    <!-- Bio -->
                    <div class="form-group">

                        <label for="create_bio">
                            Bio
                        </label>

                        <textarea class="form-control"
                                  id="create_bio"
                                  name="bio"
                                  rows="4"
                                  placeholder="Enter user bio">{{ old('bio') }}</textarea>

                    </div>

                    <!-- Password -->
                    <div class="form-group">

                        <label for="create_password">
                            Password
                        </label>

                        @error('password')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                        @enderror

                        <input type="password"
                               class="form-control"
                               id="create_password"
                               name="password"
                               placeholder="Enter password"
                               required>

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
                            class="btn btn-success">
                        <i class="fa fa-save"></i>
                        Save User
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>
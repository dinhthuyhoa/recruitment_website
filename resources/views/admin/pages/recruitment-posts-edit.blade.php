@extends('admin.master.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <form id="frmUpdateCruitmentPost" method="POST"
                    action="{{ route('admin.posts.recruitment.update', $post->id) }}" enctype="multipart/form-data"
                    onsubmit="return checkSubmit()">
                    @csrf
                    <h5 class="card-header">Edit Post</h5>
                    <!-- Account -->
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-sm-center gap-4">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <img src="{{ asset('storage/' . $post->recruitment_image) }}" alt="user-avatar"
                                    class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                                <div class="button-wrapper">
                                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                        <span class="d-none d-sm-block">Upload new photo</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>

                                    </label>
                                    <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                        <i class="bx bx-reset d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Reset</span>
                                    </button>

                                    <p class="text-muted mb-0">Upload image for post</p>
                                </div>
                            </div>
                            @if (Auth::check() && (Auth::user()->role == \App\Enums\UserRole::Administrator
                                                    || Auth::user()->role == \App\Enums\UserRole::SubAdmin))
                                <div class="mb-3 col-md-6">
                                    <label for="title" class="form-label">Status</label>
                                    <select name="post_status" id="post_status" class="form-control">
                                        <option value="publish" {{ $post->post_status == 'publish' ? 'selected' : '' }}>
                                            Published
                                        </option>
                                        <option value="pendding" {{ $post->post_status == 'pendding' ? 'selected' : '' }}>
                                            Pendding
                                        </option>
                                        <option value="draft" {{ $post->post_status == 'draft' ? 'selected' : '' }}>
                                            Draft
                                        </option>
                                    </select>
                                </div>
                            @endif
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">

                        <input type="file" id="upload" class="account-file-input" hidden
                            accept="image/png, image/jpeg" name="avatar" />
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="title" class="form-label">Title *</label>
                                <input class="form-control" type="text" id="title" name="title"
                                    value="{{ $post->post_title }}" autofocus required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Address *</label>
                                <input class="form-control" type="text" name="address" id="address"
                                    value="{{ $post->recruitment_address }}" required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">E-mail *</label>
                                <input class="form-control" type="text" id="email" name="email"
                                    value="{{ $post->recruitment_email }}" placeholder="Enter email..." required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="phone" class="form-label">Phone *</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{ $post->recruitment_phone }}" placeholder="Phone" required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="deadline" class="form-label">Deadline *</label>
                                <input class="form-control" type="datetime-local" id="deadline" name="deadline"
                                    value="{{ date('Y-m-d\TH:i', strtotime($post->recruitment_deadline)) }}" required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="vacancy" class="form-label">Vacancy *</label>
                                <input class="form-control" type="number" min="1" id="vacancy" name="vacancy"
                                    placeholder="10" value="{{ $post->recruitment_vacancy }}" required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="position" class="form-label">Position *</label>
                                <input class="form-control" type="text" id="position" name="position"
                                    placeholder="PHP Developer" value="{{ $post->recruitment_position }}" required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="salary" class="form-label">Salary *</label>
                                <input class="form-control" type="text" id="salary" name="salary"
                                    value="{{ $post->recruitment_salary }}" required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="experience" class="form-label">Experience *</label>
                                <input class="form-control" type="text" id="experience" name="experience"
                                    placeholder="1 year" value="{{ $post->recruitment_experience }}" required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="job_nature" class="form-label">Job Nature *</label>
                                <input class="form-control" type="text" id="job_nature" name="job_nature"
                                    placeholder="Full-time" value="{{ $post->recruitment_job_nature }}" required />
                            </div>

                            <style>
                                .ck.ck-content {
                                    min-height: 10em !important;
                                }
                            </style>
                            <div class="mb-3 col-12">
                                <label for="content" class="form-label">Content *</label>
                                <textarea class="form-control" id="content" rows="8" placeholder="Post content" name="content">{!! $post->post_content !!}</textarea>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" name="submit" value="redirect" form="frmUpdateCruitmentPost"
                                class="btn btn-primary me-2">Save Changes</button>
                            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                        </div>

                    </div>
                    <!-- /Account -->
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    {{-- CK_Editor --}}
    <script>
        ClassicEditor
            .create(document.querySelector('#content'), {
                ckfinder: {
                    uploadUrl: "{{ route('image.upload') . '?_token=' . csrf_token() }}",
                },
                mediaEmbed: {
                    previewsInData: true
                }
            }).catch(error => {
                console.error(error);
            });
    </script>

    {{-- Input mask --}}
    <script src="https://unpkg.com/inputmask@4.0.4/dist/inputmask/dependencyLibs/inputmask.dependencyLib.js"></script>
    <script src="https://unpkg.com/inputmask@4.0.4/dist/inputmask/inputmask.js"></script>
    <script src="https://unpkg.com/inputmask@4.0.4/dist/inputmask/inputmask.date.extensions.js"></script>
    <script>
        Inputmask().mask("input");
    </script>
@endsection

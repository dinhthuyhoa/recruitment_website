@extends('admin.master.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4 p-3">
                <div class="d-flex justify-content-between">
                    <h4>Infor apply</h4>

                </div>
                <hr>
                <div class="d-flex flex-column justify-content-center align-items-center apply-block">
                    @if (!is_null($apply->post->post_image))
                        <img src="{{ asset('storage/' . $apply->post->post_image) }}" alt="Avatar" class="rounded-circle me-2"
                            width="100" />
                    @endif
                    <h4 class="my-2"><a href="{{ route('posts.recruitment.details', $apply->post->id) }}"
                            target="_blank">{{ $apply->post->post_title }}</a></h4>

                    <h6>{{ $apply->post->user->name }} - Recruiter</h6>
                    <div class="d-flex my-2">
                        <table class="table table-hover" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Recruitment Information</th>
                                    <th>Content</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Vacancy:</td>
                                    <td>{{ $apply->post->recruitment_vacancy }} Position</td>
                                </tr>
                                <tr>
                                    <td>Salary:</td>
                                    <td>{{ $apply->post->recruitment_salary }}</td>
                                </tr>
                                <tr>
                                    <td>Location:</td>
                                    <td>{{ $apply->post->recruitment_address }}</td>
                                </tr>
                                <tr>
                                    <td>Job Nature:</td>
                                    <td>{{ $apply->post->recruitment_job_nature }}</td>
                                </tr>
                                <tr>
                                    <td>Exprience:</td>
                                    <td>{{ $apply->post->recruitment_experience }}</td>
                                </tr>
                                <tr>
                                    <td>Deadline:</td>
                                    <td>{{ date('H:i d/m/Y', strtotime($apply->post->recruitment_deadline)) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>



                <div class="apply-block">
                    <div class="d-flex">
                        <div class="col-12 col-md-6">
                            @if ($apply->user)
                                <p>
                                    <b>User:</b>
                                    <a target="_blank"
                                        href="{{ route('users.edit', $apply->user->id) }}">{{ $apply->user->name }}</a>
                                </p>
                            @endif
                            <p><b>Full name:</b> {{ $apply->fullname }}</p>
                            <p><b>Gender:</b> {{ $apply->gender == 'Male' ? 'Male' : 'Female' }}</p>
                            <p><b>Email:</b> {{ $apply->email }}</p>
                            <p><b>Phone:</b> {{ $apply->phone }}</p>
                            <p><b>Address:</b> {{ $apply->address }}</p>
                            <p><b>Birthday:</b> {{ date('d/m/Y', strtotime($apply->birthday)) }}</p>
                            <p><b>Note:</b> {{ $apply->candidate_note }}</p>
                        </div>
                        @if (Auth::check() && Auth::user()->role == $apply->post->user->role)
                            <div class="col-12 col-md-6">
                                @if ($apply->status == 'pendding')
                                    <form action="{{ route('admin.job_apply.update_status', $apply->id) }}" method="post">
                                        @csrf
                                        <div class="d-flex flex-column" style="gap: 10px">
                                            <div class="col">
                                                <textarea name="message" id="message" class="w-100" rows="10" placeholder="Message..."></textarea>
                                            </div>
                                            <div class="col">
                                                <select name="apply_status" id="apply_status" class="form-control">
                                                    <option value="approved"
                                                        {{ $apply->status == 'approved' ? 'selected' : '' }}>
                                                        Approved
                                                    </option>
                                                    <option value="pendding"
                                                        {{ $apply->status == 'pendding' ? 'selected' : '' }}>
                                                        Pendding
                                                    </option>
                                                    <option value="failed"
                                                        {{ $apply->status == 'failed' ? 'selected' : '' }}>
                                                        Failed
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <button class="btn btn-success" type="submit">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                    @if ($apply->status == 'pendding')
                                        <span class="badge bg-label-warning me-1 fs-1">Pendding</span>
                                    @elseif($apply->status == 'approved')
                                        <span class="badge bg-label-success me-1 fs-1">Approved</span>
                                    @else
                                        <span class="badge bg-label-danger me-1 fs-1">Faild</span>
                                    @endif
                                @endif

                            </div>
                        @endif
                    </div>

                </div>

                <div class="d-flex apply-block" style="gap: 10px">
                    <strong>Attachment:</strong>
                    <a href="{{ asset('storage/' . $apply->attachment) }}" target="_blank"> View here</a>
                    <span>|</span>
                    <a href="{{ asset('storage/' . $apply->attachment) }}" download=""> Download here</a>
                </div>
            </div>
        </div>
    </div>
@endsection

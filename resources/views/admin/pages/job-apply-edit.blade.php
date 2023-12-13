@extends('admin.master.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4 p-3">
                <div class="d-flex justify-content-between">
                    <h4>{{trans('admin-auth.infor_apply')}}</h4>

                </div>
                <hr>
                <div class="d-flex flex-column justify-content-center align-items-center apply-block">
                    @if (!is_null($apply->post->post_image))
                        <img src="{{ asset('storage/' . $apply->post->post_image) }}" alt="Avatar" class="rounded-circle me-2"
                            width="100" />
                    @endif
                    <h4 class="my-2"><a href="{{ route('posts.recruitment.details', $apply->post->id) }}"
                            target="_blank">{{ $apply->post->post_title }}</a></h4>

                    <h6>{{ $apply->post->user->name }} - {{trans('admin-auth.recruiter')}}</h6>
                    <div class="d-flex my-2">
                        <table class="table table-hover" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>{{trans('admin-auth.recruitment_info')}}</th>
                                    <th>{{trans('admin-auth.content')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{trans('admin-auth.vacancy')}}:</td>
                                    <td>{{ $apply->post->recruitment_vacancy }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('admin-auth.salary') }}:</td>
                                    <td>
                                        @php
                                            $selectedSalary = $apply->post->recruitment_salary;
                                            $formattedSalary = '';

                                            switch ($selectedSalary) {
                                                case '1000000-3000000':
                                                    $formattedSalary = '1,000,000 - 3,000,000 VND';
                                                    break;
                                                case '3500000-5000000':
                                                    $formattedSalary = '3,500,000 - 5,000,000 VND';
                                                    break;
                                                case '5500000-7000000':
                                                    $formattedSalary = '5,500,000 - 7,000,000 VND';
                                                    break;
                                                case '7500000-9000000':
                                                    $formattedSalary = '7,500,000 - 9,000,000 VND';
                                                    break;
                                                case '10000000+':
                                                    $formattedSalary = trans('all-jobs.over') . ' 10,000,000 VND';
                                                    break;
                                                case 'negotiable':
                                                    $formattedSalary = trans('all-jobs.negotiable');
                                                    break;
                                            }
                                            @endphp

                                        {{ $formattedSalary }}
                                    </td>
                                </tr>

                                <tr>
                                    <td>{{trans('admin-auth.location_recruitment')}}:</td>
                                    <td>{{ $apply->post->recruitment_address }}</td>
                                </tr>
                                <tr>
                                    <td>{{trans('admin-auth.job_nature')}}:</td>
                                    <td>{{ $apply->post->recruitment_job_nature }}</td>
                                </tr>
                                <tr>
                                    <td>{{trans('admin-auth.experience')}}:</td>
                                    <td>{{ $apply->post->recruitment_experience }}</td>
                                </tr>
                                <tr>
                                    <td>{{trans('admin-auth.deadline')}}:</td>
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
                                    <b>{{trans('admin-auth.user')}}:</b>
                                    <a target="_blank"
                                        href="{{ route('profile.user', $apply->user->id) }}">{{ $apply->user->name }}</a>
                                </p>
                            @endif
                            <p><b>{{trans('admin-auth.full_name')}}:</b> {{ $apply->fullname }}</p>
                            <p><b>{{trans('admin-auth.gender')}}:</b> {{ $apply->gender == 'Male' ? 'Male' : 'Female' }}</p>
                            <p><b>{{trans('admin-auth.email')}}:</b> {{ $apply->email }}</p>
                            <p><b>{{trans('admin-auth.phone')}}:</b> {{ $apply->phone }}</p>
                            <p><b>{{trans('admin-auth.address')}}:</b> {{ $apply->address }}</p>
                            <p><b>{{trans('admin-auth.birthday')}}:</b> {{ date('d/m/Y', strtotime($apply->birthday)) }}</p>
                            <p><b>{{trans('admin-auth.notes')}}:</b> {{ $apply->candidate_note }}</p>
                        </div>
                        @if (Auth::check() && Auth::user()->role == $apply->post->user->role)
                            <div class="col-12 col-md-6">
                                @if ($apply->status == 'pending')
                                    <form action="{{ route('admin.job_apply.update_status', $apply->id) }}" method="post">
                                        @csrf
                                        <div class="d-flex flex-column" style="gap: 10px">
                                            <div class="col">
                                                <!-- <textarea name="message" id="message" class="w-100" rows="10" placeholder="{{trans('admin-auth.message')}}"></textarea> -->
                                                <div class="mb-3 col-12">
                                                <style>
                                .ck.ck-content {
                                    min-height: 10em !important;
                                }
                            </style>
                                <label for="content" class="form-label">{{trans('admin-auth.message')}} </label>
                                <textarea class="form-control" id="content" rows="8" placeholder="{{trans('admin-auth.message')}}" name="message"></textarea>
                            </div>
                                            </div>
                                            <div class="col">
                                                <select name="apply_status" id="apply_status" class="form-control">
                                                    <option value="approved"
                                                        {{ $apply->status == 'approved' ? 'selected' : '' }}>
                                                        {{trans('admin-auth.approved')}}
                                                    </option>
                                                    <option value="pending"
                                                        {{ $apply->status == 'pending' ? 'selected' : '' }}>
                                                        {{trans('admin-auth.pending')}}
                                                    </option>
                                                    <option value="failed"
                                                        {{ $apply->status == 'failed' ? 'selected' : '' }}>
                                                        {{trans('admin-auth.failed')}}
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <button class="btn btn-success" type="submit">{{trans('admin-auth.save_changes')}}</button>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                    @if ($apply->status == 'pending')
                                        <span class="badge bg-label-warning me-1 fs-5">{{trans('admin-auth.pending')}}</span>
                                    @elseif($apply->status == 'approved')
                                        <span class="badge bg-label-success me-1 fs-5">{{trans('admin-auth.approved')}}</span>
                                    @else
                                        <span class="badge bg-label-danger me-1 fs-5">{{trans('admin-auth.failed')}}</span>
                                    @endif
                                @endif

                            </div>
                        @endif
                    </div>

                </div>

                <div class="d-flex apply-block" style="gap: 10px">
                    <strong>{{trans('admin-auth.attachments')}}:</strong>
                    <a href="{{ asset('storage/' . $apply->attachment) }}" target="_blank">{{trans('admin-auth.view_here')}}</a>
                    <span>|</span>
                    <a href="{{ asset('storage/' . $apply->attachment) }}" download="">{{trans('admin-auth.download_here')}}</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
{{-- CK_Editor --}}
    <script>
        ClassicEditor.create(document.querySelector('#content'), {
                ckfinder: {
                    uploadUrl: "{{ route('image.upload') . '?_token=' . csrf_token() }}",
                },
                mediaEmbed: {
                    previewsInData: true
                }
            }).catch(error => {
                console.log('123456');
            });
    </script>
@endsection
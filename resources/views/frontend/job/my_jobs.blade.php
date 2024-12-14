@extends('frontend.layout.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">My Jobs</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                @include('frontend.auth.sidebar')
            </div>
            <div class="col-lg-9">
                @include('frontend.message')
                <div class="card border-0 shadow mb-4 p-3">
                    <div class="card-body card-form">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3 class="fs-4 mb-1">My Jobs</h3>
                            </div>
                            <div style="margin-top: -10px;">
                                <a href="{{ route('create_post_job') }}" class="btn btn-primary">Post a Job</a>
                            </div>
                            
                        </div>
                        <div class="table-responsive">
                            <table class="table ">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Job Created</th>
                                        <th scope="col">Applicants</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="border-0">
                                    @if ($jobs->isNotEmpty())
                                    <?php $cnt = 1; ?>
                                    @foreach($jobs as $job)
                                        <tr class="active">
                                            <td>{{ $cnt }}</td>
                                            <td>
                                                <div class="job-name fw-500">{{ $job->title }}</div>
                                                <div class="info1">{{ $job->jobType->name }} | {{ $job->location }}</div>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($job->created_at)->format('d M, Y') }}</td>
                                            <td>0</td>
                                            <td>
                                                @if ($job->deleted == 0)
                                                    <div class="job-status text-capitalize">active</div>
                                                @else
                                                    <div class="job-status text-capitalize">expired</div>
                                                @endif
                                                
                                            </td>
                                            <td>
                                                <div class="action-dots float-end">
                                                    <a href="#" class="" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                        {{-- <i class="fa-solid fa-ellipsis" aria-hidden="true"></i> --}}
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item" href="{{ route('job_detail') }}"> <i class="fa fa-eye" aria-hidden="true"></i> View</a></li>
                                                        <li><a class="dropdown-item" href="{{ route('show_post_job', $job->id) }}"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a></li>
                                                        <li><a class="dropdown-item" href="{{ route('delete_post_job', $job->id) }}" onclick="confirmDeleteJob({{ $job->id }})"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $cnt++ ?>
                                    @endforeach
                                    @endif
                                </tbody>
                                
                            </table>
                        </div>
                    </div>

                    <div>
                        {{ $jobs->links() }}
                    </div>
                </div> 
            </div>
        </div>
    </div>
</section>
@endsection

@section('customJS')
<script type="text/javascript">
    function confirmDeleteJob(jobId){
        if (confirm('Are you sure you want to delete this job?')) {
            $.ajax([
                url: "{{ route('delete_post_job') }}",
                type: 'get',
                data: {jobId: jobId},
                dataType: 'json',
                success: function(response){
                    window.location.href="{{ route('my_jobs') }}";
                }
            ]);
        }
    }
</script>
    
@endsection
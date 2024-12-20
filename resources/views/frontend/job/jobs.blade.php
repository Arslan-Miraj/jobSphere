@extends('frontend.layout.app')

@section('main')
<section class="section-3 py-5 bg-2 ">
    <div class="container">     
        <div class="row">
            <div class="col-6 col-md-10 ">
                <h2>Find Jobs</h2>  
            </div>
            <div class="col-6 col-md-2">
                <div class="align-end">
                    <select name="sort" id="sort" class="form-control">
                        <option value="1" {{ (Request::get('sort') == '1') ? 'selected' : '' }}>Latest</option>
                        <option value="0" {{ (Request::get('sort') == '0') ? 'selected' : '' }}>Oldest</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row pt-5">
            <div class="col-md-4 col-lg-3 sidebar mb-4">
                <form action="" name="filters" id="filters">
                    <div class="card border-0 shadow p-4">
                        <div>
                            <a href="{{ route('jobs') }}" class="btn btn-secondary float-end">Reset</a>
                        </div>
                        <div class="mb-4">
                            <h2>Keywords</h2>
                            <input type="text" name="keywords" id="keywords" placeholder="Keywords" value="{{ Request::get('keyword') }}" class="form-control">
                        </div>

                        <div class="mb-4">
                            <h2>Location</h2>
                            <input type="text" name="location" id="location" placeholder="Location" value="{{ Request::get('location') }}" class="form-control">
                        </div>

                        <div class="mb-4">
                            <h2>Category</h2>
                            <select name="category" id="category" class="form-control">
                                <option value="">Select a Category</option>
                                @foreach ($categories as $category)
                                <option {{ (Request::get('category') == $category->id ? 'selected' : '') }} value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>                   

                        <div class="mb-4">
                            <h2>Job Type</h2>
                            @if ($job_types->isNotEmpty())
                                @foreach ($job_types as $types)
                                    <div class="form-check mb-2"> 
                                        <input 
                                            {{ (in_array($types->id, $jobTypeArray)) ? 'checked' : ''}} 
                                            class="form-check-input " 
                                            name="job_type" 
                                            type="checkbox" 
                                            value="{{ $types->id }}" 
                                            id="job-type-{{ $types->id }}">    
                                        <label class="form-check-label " for="job-type-{{ $types->id }}">{{ $types->name }}</label>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <div class="mb-4">
                            <h2>Experience</h2>
                            <input 
                                type="number" 
                                value="{{ Request::get('experience') }}" 
                                name="experience" 
                                id="experience" 
                                placeholder="Experience In Years" 
                                class="form-control">
                        </div> 
                        <button type="submit" class="btn btn-primary">Search</button> 
                    </div>
                </form>
            </div>
            <div class="col-md-8 col-lg-9 ">
                <div class="job_listing_area">                    
                    <div class="job_lists">
                    <div class="row">
                        @if ($latest_jobs->isNotEmpty())
                            @foreach ($latest_jobs as $job)
                                <div class="col-md-4">
                                    <div class="card border-0 p-3 shadow mb-4">
                                        <div class="card-body">
                                            <h3 class="border-0 fs-5 pb-2 mb-0">{{ $job->title }}</h3>
                                            <p>{{ Str::words($job->description, 5) }}</p>
                                            <div class="bg-light p-3 border">
                                                <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                    <span class="ps-1">{{ $job->location }}</span>
                                                </p>
                                                <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                    <span class="ps-1">{{ $job->jobType->name }}</span>
                                                </p>
                                                @if(!is_null($job->salary))
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                        <span class="ps-1">{{ $job->salary }}</span>
                                                    </p>
                                                @endif
                                            </div>

                                            <div class="d-grid mt-3">
                                                <a href="job-detail.html" class="btn btn-primary btn-lg">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @else
                                <div class="col-md-12">No jobs found.</div>
                            @endif
                                
                        {{ $latest_jobs->links() }}                         
                    </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
@endsection
@section('customJS')
    <script>
        $(document).ready(function(){
            $('#filters').submit(function(e){
                e.preventDefault();
                var url = '{{ route("jobs") }}?';

                var keyword = $("#keywords").val();
                var location = $("#location").val();
                var category = $("#category").val();
                var checked_job_type = $("input:checkbox[name='job_type']:checked").map(function(){
                    return $(this).val();
                }).get();
                var experience = $("#experience").val();
                var sort = $('#sort').val();

                // If keyword has a value
                if(keyword != ""){
                    url += '&keyword='+keyword;
                }
                url += (location != "") ? "&location="+location: "";
                url += (category != "") ? "&category="+category: "";

                if(checked_job_type.length > 0){
                    url += '&jobType='+checked_job_type;
                }
                
                url += (experience != "") ? "&experience="+experience: "";
                url += "&sort="+sort;
                window.location.href = url;

            });

            $('#sort').change(function (){
                $('#filters').submit();
            })
        });

    </script>
@endsection
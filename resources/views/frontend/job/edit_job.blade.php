@extends('frontend.layout.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Post Job</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                @include('frontend.auth.sidebar')
            </div>
            <div class="col-lg-9">
                {{-- @include('frontend.message') --}}
                <form id="updateJobForm" name="updateJobForm">
                    @csrf
                    <div class="card border-0 shadow mb-4">
                        <div class="card-body card-form p-4">
                            <h3 class="fs-4 mb-1">Edit Job Details</h3>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="title" class="mb-2">Title<span class="req">*</span></label>
                                    <input type="text" placeholder="Job Title" id="title" name="title" class="form-control" value="{{ $job->title }}">
                                    <p></p>
                                </div>
                                <div class="col-md-6  mb-4">
                                    <label for="" class="mb-2">Category<span class="req">*</span></label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="">Select a Category</option>
                                        @if($categories->isNotEmpty())
                                            @foreach($categories as $category)
                                                <option {{ ($job->category_id == $category->id) ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p></p>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="" class="mb-2">Job Type<span class="req">*</span></label>
                                    <select name="job" id="job" class="form-select">
                                        <option>Select Job Type</option>
                                        @if($job_types->isNotEmpty())
                                            @foreach($job_types as $type)
                                                <option {{ ($job->job_type_id == $type->id) ? 'selected' : '' }} value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p></p>
                                </div>
                                <div class="col-md-6  mb-4">
                                    <label for="" class="mb-2">Vacancy<span class="req">*</span></label>
                                    <input type="number" min="1" placeholder="Vacancy" id="vacancy" name="vacancy" class="form-control" value="{{ $job->vacancy }}">
                                    <p></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6  mb-4">
                                    <label for="" class="mb-2">Experience<span class="req">*</span></label>
                                    <input type="text" placeholder="Experience" id="experience" name="experience" class="form-control" value="{{ $job->experience }}">
                                    <p></p>
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Salary</label>
                                    <input type="text" placeholder="Salary" id="salary" name="salary" class="form-control" value="{{ $job->salary }}">
                                    <p></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-4">
                                    <label for="" class="mb-2">Location<span class="req">*</span></label>
                                    <input type="text" placeholder="location" id="location" name="location" class="form-control" value="{{ $job->location }}">
                                    <p></p>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="" class="mb-2">Description<span class="req">*</span></label>
                                <textarea class="form-control" name="description" id="description" cols="5" rows="5" placeholder="Description">{{ $job->description }}</textarea>
                                <p></p>
                            </div>

                            <div class="mb-4">
                                <label for="" class="mb-2">Benefits</label>
                                <textarea class="form-control" name="benefits" id="benefits" cols="5" rows="5" placeholder="Benefits">{{ $job->benefits }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label for="" class="mb-2">Responsibility</label>
                                <textarea class="form-control" name="responsibility" id="responsibility" cols="5" rows="5" placeholder="Responsibility">{{ $job->responsibilities }}</textarea>
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Qualifications</label>
                                <textarea class="form-control" name="qualifications" id="qualifications" cols="5" rows="5" placeholder="Qualifications">{{ $job->qualifications }}</textarea>
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Keywords<span class="req">*</span></label>
                                <input type="text" placeholder="keywords" id="keywords" name="keywords" class="form-control" value="{{ $job->keywords }}">
                                <p></p>
                            </div>

                            <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Company Details</h3>

                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Name<span class="req">*</span></label>
                                    <input type="text" placeholder="Company Name" id="company_name" name="company_name" class="form-control" value="{{ $job->company_name }}">
                                    <p></p>
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Location</label>
                                    <input type="text" placeholder="Location" id="company_location" name="company_location" class="form-control" value="{{ $job->company_location }}">
                                    <p></p>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="" class="mb-2">Website</label>
                                <input type="text" placeholder="Website" id="website" name="website" class="form-control" value="{{ $job->website }}">
                                <p></p>
                            </div>
                        </div> 
                        <div class="card-footer  p-4">
                            <button type="submit" class="btn btn-primary">Update Job</button>
                        </div>   
                    </div>  
                </form>             
            </div>
        </div>
    </div>
</section>
@endsection

@section('customJS')
<script type="text/javascript">
    $('#updateJobForm').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: '{{ route("edit_post_job", $job->id) }}',
            type: 'post',
            dataType: 'json',
            data: $('#updateJobForm').serializeArray(),
            // serializeArray() gets all form values & store in object format
            success: function(response){
                if (response.status == true){
                    $('#title').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    $('#category').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    // $('#job').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    $('#vacancy').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    $('#experience').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    $('#description').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    $('#company_name').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    window.location.href = "{{ route('my_jobs') }}";
                }
                else{
                    var errors = response.errors;

                    if (errors.title){
                        $('#title').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.title);
                    }
                    else{
                        $('#title').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    }

                    if (errors.category){
                        $('#category').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.category);
                    }
                    else{
                        $('#category').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    }

                    if (errors.job){
                        $('#job').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.job);
                    }
                    else{
                        $('#job').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    }

                    if (errors.vacancy){
                        $('#vacancy').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.vacancy);
                    }
                    else{
                        $('#vacancy').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    }

                    if (errors.experience){
                        $('#experience').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.experience);
                    }
                    else{
                        $('#experience').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    }

                    if (errors.description){
                        $('#description').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.description);
                    }
                    else{
                        $('#description').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    }

                    if (errors.company_name){
                        $('#company_name').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.company_name);
                    }
                    else{
                        $('#company_name').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    }

                }
            }
            
        });
    });
</script>
    
@endsection
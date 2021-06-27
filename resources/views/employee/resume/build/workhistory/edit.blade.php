@extends('employee.layouts.app')

@section('styles')
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/css/bootstrap-datepicker.min.css'>
@endsection

@section('content')

<div class="container">

  <div class="row login-form justify-content-center">
    <div class="middle-box">
      <div>
        <div class="progress">
          <div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar"
              aria-valuemin="0" aria-valuemax="36" style="width: 36%;">
              <span>36%</span>
          </div>
        </div>

        <div class="step well">

          <h2 class="bold h3 mb-4" data-wow-delay="0s">
              What is your most recent Job?
          </h2>

          <P>
              We'll use your skills and experience to recommend a salary.
          </P>

          <form method="POST" action="{{ route('employee_resume.build.work_history.update', ['work' => $work->id]) }}">
            @csrf

            <div class="mb-3 row">
              <div class="col-md-6">
                  <label class="col-form-label">Title</label>
                  <input id="title" type="text" class="form-control" name="title" value="{{ old('title') ?? $work->title }}" required>

                  @error('title')
                      <span class="invalid-feedback d-block" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div><!-- col-md-6 -->

              <div class="col-md-6">
                  <label class="col-form-label">Company</label>
                  <input id="company" type="text" class="form-control" name="company" value="{{ old('company') ?? $work->company }}" required>
        
                  @error('company')
                      <span class="invalid-feedback d-block" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div><!-- col-md-6 -->
            </div>

            <div class="form-check">
                <input id="currently_work_here" class="form-check-input" type="checkbox" name="currently_work_here" value="1"
                {{$work->currently_work_here ? 'checked' : ''}}>
                <label class="form-check-label" for="currently_work_here">
                    I currently work here
                </label>
            </div>



            <div class="mb-3 row">
                <div class="col-md-6">
                    <label class="col-form-label">Started</label>
                    <div class="form-group">
                        <div>
                            <div class="input-group date started_year mb-3" data-date-format="dd.mm.yyyy">
                                <input type="text" class="form-control" placeholder="dd.mm.yyyy" name="started_year" id="started_year" required
                                value="{{ old('started_year') ?? $work->started_year }}">
                                <span class="input-group-addon input-group-text">
                                    <i class="lnir lnir-calendar"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    @error('started_year')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div><!-- col-md-6 -->

                <div class="col-md-6">
                    <label class="col-form-label">Ended</label>
                    <div class="form-group">
                      <div>
                          <div class="input-group date ended_year mb-3" data-date-format="dd.mm.yyyy">
                              <input type="text" class="form-control" placeholder="dd.mm.yyyy" name="ended_year" id="ended_year" required
                              value="{{ old('ended_year') ?? $work->ended_year }}">
                              <span class="input-group-addon input-group-text">
                                  <i class="lnir lnir-calendar"></i>
                              </span>
                          </div>
                      </div>
                    </div>

                    @error('ended_year')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div><!-- col-md-6 -->


            </div>

            <div class="mb-3 row">
                <label class="col-12 col-form-label">Describe your accomplishments in this role</label>
                <div class="col-md-12">
                    <textarea name="accomplishment" class="form-control" required rows="3">{{ old('accomplishment') ?? $work->accomplishment }}</textarea>

                    @error('accomplishment')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div><!-- col-md-12 -->
            </div><!-- row -->

            <div class="text-center">
              <button type="submit" class="action next btn blue-btn ctrl-standard is-reversed typ-subhed fx-sliderIn btn-block">Save</button>
              <a href="{{route('employee_resume.build.work_history')}}" class="btn-block action back btn btn-info my-3" style="font-size: 12px;">{{ __('Cancel') }}</a>
            </div>
          </form>

          <div class="text-center">
            @if($delete_btn)
              <form action="{{ route('employee_resume.build.work_history.delete', ['work' => $work->id]) }}" method="post" 
                onsubmit="return confirm('Do you really want to delete this?');" class="mt-4">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger btn-block" style="font-size: 12px;">Delete</button>
              </form>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection


@section('scripts')
<script src='{{url('/')}}/employee/js/bootstrap-datepicker.min.js'></script>
@if($work->currently_work_here)
<script>
$('[name=ended_year]').val('');
$('[name=ended_year]').prop('disabled', 'disabled');
</script>
@endif
<script>
$('.input-group.date').datepicker({ format: "dd.mm.yyyy", autoclose: true, endDate: new Date(new Date().setDate(new Date().getDate())) });

$("#currently_work_here").change(function() {
    if(this.checked) {
      $('[name=ended_year]').val('');
      $('[name=ended_year]').prop('disabled', 'disabled');
    }else{
      $('[name=ended_year]').prop('disabled', false);
    }
});
</script>
@endsection
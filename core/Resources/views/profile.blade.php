@extends('layouts.app', ['title' => 'Profile', 'breadcrumbs' => [
    [
        'title' => 'Home',
        'icon' => 'fa fa-dashboard',
        'route' => 'home'
    ], [
        'title' => 'Profile',
        'icon' => 'fa fa-user',
        'route' => 'profile',   
        'active' => true
    ]
]])

@section('content')
<div class="row">
    <div class="col-md-3">
        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="{{ asset('assets/img/avatar.png') }}" alt="{{ auth()->user()->full_name }}'s Profile Picture'">

                <h3 class="profile-username text-center">{{ auth()->user()->full_name }}</h3>

                <p class="text-muted text-center">{{ implode(", ", auth()->user()->roles->pluck('name')->toArray()) }}</p>

                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <i class="fa fa-envelope"></i> <a class="pull-right">{{ auth()->user()->email }}</a>
                    </li>
                    <li class="list-group-item">
                        <i class="fa fa-check"></i>  <a class="pull-right">{{ (!empty(auth()->user()->email_verified_at)) ? auth()->user()->email_verified_at->format('d F Y') : "-" }}</a>
                    </li>
                </ul>

                <a href="javascript:void(0);" class="btn btn-primary btn-block" id="triggerChangeTab"><b>Change Password</b></a>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#basic" data-toggle="tab" aria-expanded="true">Basic Information</a></li>
                <li><a href="#change-password" data-toggle="tab" aria-expanded="true">Change Password</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="basic">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="change-password">
                    {!! form($formChangePassword) !!}
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('#triggerChangeTab').click(function() {
            $('.nav-tabs > .active').next('li').find('a').trigger('click');
        });
    });
</script>
@endpush
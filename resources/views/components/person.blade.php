<div class="card">
  <div class="card-header">
    <div class="card-title text-center">
      @yield('content-title')
    </div>
  </div>
  <div class="card-body">

    @yield('content-header')
    <div class="row">
      <div class="input-group col-md-6 mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" for="first_name"> First Name</span>
        </div>
        @yield('first_name')
      </div>

      <div class="input-group col-md-6 mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" for="last_name"> Last Name</span>
        </div>
        @yield('last_name')
      </div>
    </div>

    <div class="row">
      <div class="input-group col-md-8 mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" for="email"> Email</span>
        </div>
        @yield('email')
      </div>

      <div class="input-group col-md-4 mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" for="email">Gender</span>
        </div>
        @yield('gender')
      </div>


    </div>

    <div class="row">
      <div class="input-group col-md-6 mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" for="number"> Number</span>
        </div>
        @yield('number')
      </div>

      <div class="input-group col-md-6  mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" for="number">Year Group</span>
        </div>
        @yield('year')
      </div>
    </div>

    <div class="row">
      <div class="input-group col-md-6 mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" for="tags">Tags</span>
        </div>
        @yield('tags')
      </div>

      <div class="input-group col-md-6 mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" for="user_tags">User tags</span>
        </div>
        @yield('usertags')
      </div>
    </div>

    <a class="dropdown-toggle" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Additional Information</a>
    <div class="collapse multi-collapse" id="multiCollapseExample1">
    
      <div class="row">
        <div class="input-group col-md-6 mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" for="dob">Date of Birth</span>
          </div>
          @yield('dob')
        </div>

        <div class="input-group col-md-6 mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" for="baptism">Baptism</span>
          </div>
          @yield('baptism')
        </div>
      </div>

      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" for="parents">Parents</span>
        </div>
        @yield('parents')
      </div>

      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" for="school">School</span>
        </div>
        @yield('school')
      </div>

      <div class="row">
        <div class="col-md-12 mb-3">
          <label class="label" for="notes">Notes</label>
          @yield('notes')
        </div>
      </div>

      @yield('additional-footer')
    </div>
      
    <hr class="mb-4">
    @yield('content-footer')
    
    <div class="row">
      @yield('buttons')
    </div>

    </form>
  </div>
</div>
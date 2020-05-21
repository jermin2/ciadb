<div class="card col-lg-8 col-md-11 col-sm-12 mx-auto">
  <div class="card-header">
    <div class="card-title text-center">
      @yield('title')
    </div>
  </div>
  <div class="card-body d-flex justify-content-center col-md-12 col-lg-12 mx-auto">

    @yield('header')
      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="label" for="first_name"> First Name</label>

          @yield('first_name')
          <div class="invalid-feedback">Valid first name is required. </div>
        </div>

        <div class="col-md-6 mb-3">
          <label class="label" for="last_name"> Last Name</label>

          @yield('last_name')
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 mb-3">
          <label for="email">Email <span class="text-muted">(Optional)</span></label>
          @yield('email')
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 mb-3">
          <label for="number">Phone Number <span class="text-muted">(Optional)</span></label>
          @yield('number')
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="tags">Tags <span class="text-muted">(Optional)</span></label>
          <!-- Tags -->
          @yield('tags')
        </div>
        <div class="col-md-6 mb-3">
          <label for="tags">User tags <span class="text-muted">(Optional)</span></label>
          <!-- Tags -->
          @yield('usertags')         
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 mb-3">
          <label class="label" for="notes">Notes</label>
          @yield('notes')
        </div>
      </div>
      @yield('footer')
      <hr class="mb-4">
      <div class="row">
        <div class="col-md-12">
        @yield('buttons')
        </div>
      </div>

    </form>
  </div>
</div>
  <div class="card">
    <div class="card-header">
      <div class="card-title text-center">
        <h2>Goals / Prayers </h2>
      </div>
    </div>
    <div class="card-body">
      <form method="POST" action="goals">
      @csrf
        <table>
          <thead>
            <tr>
              <th>Goal/prayer</th>
              <th>Start date</th>
              <th>End Date</th>
              <th>private</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><input class="form-control" type="text" name="goal" placeholder="Goal"></td>
              <td>@component('components.timepicker', ['pickername'=>'start_date'])
                          @endcomponent
              </td>
              <td>@component('components.timepicker', ['pickername'=>'end_date'])
                          @endcomponent</td>
              <td><input class="" type="checkbox" name="private"></td>
              <td><button class="btn btn-success" type="submit">Add</button>
            </tr>
            @yield('goals');

          </tbody>
        </table>

        </div>
      </form>
    </div>
  </div>
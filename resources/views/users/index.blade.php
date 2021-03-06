@extends ('layouts/main')

@section ('content')
  <div class="card">
    <div class="card-header">
      <h2 class="card-title">User Management</h2>
    </div>
    <div class="card-body">
      <div class="table-responsive">
      <table class="table table-striped table-sm" >
        <thead>
          <tr>
            <th> User email </th>
            <th> Associated person </th>
            <th> Role </th>
            <th> Actions  </th>
          </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
          <tr>
            <td>
              {{ $user->email }}
            </td>
            <td>
              @isset($user->person)
                <a href="{{ route('people.show', $user->person->id) }}">{{ $user->person->name() }} </a>
              @else
                <span style="color:red">Not associated</span>
              @endisset
            </td>
            <td>
              @foreach($user->roles as $role)
                {{ $role->name }}
              @endforeach
            </td>
            <td>
              <a href="{{route('users.edit', $user->id)}}" class="btn btn-primary btn-sm">Edit</a>
              @can('delete_users')
              <a href="{{route('users.delete', $user->id)}}" class="btn btn-danger btn-sm">Delete</a>
              @endcan
            </td>
          </tr>

        @endforeach
        </tbody>
      </table>
    </div>

    </div>
  </div>



@endsection
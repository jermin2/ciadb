@extends ('layouts/main')

@section ('content')
    <div class="col-md-8 col-lg-6">

    <table>
      <thead>
        <th>
          <td> User email </td>
          <td> Associated person </td>
        </th>
</thead>
    <tbody>
    @foreach($users as $user)
      <tr>
        <td>
          {{ $user->email }}
        </td>

    @endforeach
    </div>


@endsection
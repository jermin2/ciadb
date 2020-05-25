<div class="card">
    <div class="card-header">
        <h2 class="card-title">{{$title}}</h2>
    </div>
  <div class="card-body">
      <table>
          <thead>
              <tr>
                  <th>Name</th>
                  <th>Actions</th>
                  {{ $tagtype_header ?? '' }}
              </tr>
          </thead>
          <tbody>
        {{$content}}

          </tbody>
      </table>
  </div>
</div>
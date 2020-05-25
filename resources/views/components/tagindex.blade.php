<div class="card">
  <div class="card-header">
      <div class="card-title">
          <h2>{{$title}}</h2>
      </div>
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
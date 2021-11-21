<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                
                <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">User</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td><span class="badge bg-success">{{ $permission->name }}</span></td>
                            <td>{{ $permission->users->count() }}</td>
                            <td>@mdo</td>
                          </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</div>
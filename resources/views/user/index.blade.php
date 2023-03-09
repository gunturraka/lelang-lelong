@extends('template.master')

@section('content')
<div class="container-fluid">
  <div class="row">
    <!-- /.col -->
    <div class="col-md-12">
      <div class="card">
              <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary mb-3"href="/user/create">
                      <li class="nav-icon fa fas fa-user-plus"></li>
                      Buat Akun
                    </a>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                  </div>
                <div class="card-body p-0">
                <table class="table table-hover">
                      <thead>
                          <tbody>
                              <tr>
                                  <th>No</th>
                                  <th>Nama</th>
                                  <th>Username</th>
                                  <th>Level</th>
                                  <th>Telepon</th>
                                  <th></th>
                              </tr>
                          </tbody>
                      </thead>
                      @foreach ($users as $user)
                      <tbody>
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->username }}</td>
                          <td>{{ $user->level }}</td>
                          <td>{{ $user->telepon }}</td>
                          <td>
                            <form action="{{ route('user.destroy', [$user->id]) }}"method="POST">
                            {{-- <a href="{{ route('user.show', $user->id)}}"class="btn btn-primary">Detail</a>
                            <a href="{{ route('user.edit', $user->id)}}"class="btn btn-warning">Edit</a> --}}
                            <a class="btn btn-primary btn-sm" href="{{ route('user.show', $user->id)}}">
                              <i class="fas fa-folder"></i>
                              View
                            </a>
                            <a class="btn btn-info btn-sm" href="{{ route('user.edit', $user->id)}}">
                              <i class="fas fa-pencil-alt"></i>
                                Edit
                            </a>
                              @csrf
                              @method('DELETE')   
                              <button class="btn btn-danger btn-sm" type="submit"value="Delete">
                                <i class="fas fa-trash">
                                </i>
                                Delete
                              </button>
                         </form>
                          </td>
                      </tr>
                      </tbody>
                      @endforeach
                  </table>
</section>
@endsection
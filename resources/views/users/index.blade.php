@extends('layouts.master')
@section('title', 'Users')
@section('content')
    @if (session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @endif
    @if (session('error'))
        <p class="alert alert-danger">{{ session('error') }}</p>
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $err)
            <p class="alert alert-danger">{{ $err }}</p>
        @endforeach
    @endif
    <form method="get">
        <div class="form-group row">
            <div class="col-sm-8">

            </div>
            <div class="col-md-4">
                <input type="text" name="cari" id="cari" class="form-control" placeholder="Search Data" autofocus
                    value="{{ $cari }}">
            </div>
        </div>
    </form>
    <button class="btn-sm btn-primary " data-toggle="modal" data-target="#tambahUser"></i>Add User</button>

    <table class="table table-hover bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Avatar</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $index = ($users->currentpage() - 1) * $users->perpage() + 1;
            @endphp
            @foreach ($users as $user)
                <tr>

                    <td>{{ $index++ }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><img width="40px" height="50px" src="{{ asset('image/' . $user->avatar) }}"></td>
                    <td>
                        <a href="" class="btn btn-sm btn-warning" data-toggle="modal"
                            data-target="#editUser{{ $user->id }}"><i class="fas fa-pencil-alt"></i>Edit</a>
                        <form action="{{ route('user.destroy', $user) }}" method="post"style="display:inline"
                            onsubmit="return confirm('Yakin Mau diHapus ? ')">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Update -->
                <div class="modal fade" id="editUser{{ $user->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('user.update', $user) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Name</label>
                                            <input type="text" class="form-control" name="name" placeholder="Name"
                                                value="{{ $user->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="Email"
                                                value="{{ $user->email }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Avatar</label><br>
                                            @if ($user->avatar)
                                                <img src="{{ asset('image/' . $user->avatar) }}"
                                                    class="img-preview2 img-fluid" width="300px">
                                            @else
                                                <img class="img-preview2 img-fluid" width="300px">
                                            @endif
                                            <input type="file" class="form-control" name="avatar" id="avatar2"
                                                placeholder="Upload File" onchange="previewImage2()">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update Data</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                </div>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}




    <!-- Modal Tambah -->
    <div class="modal fade" id="tambahUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Avatar</label>
                                <img class="img-preview img-fluid" width="300px">
                                <input type="file" class="form-control" name="avatar" id="avatar"
                                    placeholder="Upload File" onchange="previewImage()">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage() {
            const image = document.querySelector('#avatar');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const blob = URL.createObjectURL(image.files[0]);
            imgPreview.src = blob;

        }

        function previewImage2() {
            const image = document.querySelector('#avatar2');
            const imgPreview = document.querySelector('.img-preview2');

            imgPreview.style.display = 'block';

            const blob = URL.createObjectURL(image.files[0]);
            imgPreview.src = blob;

        }
    </script>



@endsection

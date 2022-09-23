@extends('layouts.master')
@section('title', 'Product')
@section('content')

    <button class="btn-sm btn-primary " data-toggle="modal" data-target="#tambahProduct"></i>Add Product</button>

    <table class="table table-hover bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Nickname</th>
                <th>Logo</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($data as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->nickname }}</td>
                    <td><img width="50px" src="{{ $data->url }}" alt=""></td>

                </tr>
                </div>
            @endforeach
        </tbody>
    </table>


    <script>
        function previewImage() {
            const image = document.querySelector('#url');
            const imgPreview = document.querySelector('.img-previews');

            imgPreview.style.display = 'block';

            const blob = URL.createObjectURL(image.files[0]);
            imgPreview.src = blob;

        }
    </script>


    <!-- Modal Tambah -->
    <div class="modal fade" id="tambahProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="id" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">NickName</label>
                                <input type="text" class="form-control" name="nickname" placeholder="NickName">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Url</label>
                                <img class="img-previews img-fluid" width="300px">
                                <input type="file" class="form-control" name="url" id="url"
                                    placeholder="Upload File" onchange="previewImage()">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Account</label>
                                <input type="text" class="form-control" name="account" placeholder="Account">
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

@endsection

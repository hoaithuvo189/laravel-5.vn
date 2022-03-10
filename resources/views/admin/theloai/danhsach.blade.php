@php
    /** @var \App\Http\Controllers\TheLoaiController $theloai */
@endphp

@extends("admin.layout.index")
@section("content")
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Thể loại
                        <small>Danh sách</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                @if(session("thongbao"))
                    <div class="alert alert-success">
                        {{ session("thongbao") }}
                    </div>
                @endif

                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Tên thể loại</th>
                            <th class="text-center">Tên không dấu</th>
                            <th class="text-center">Delete</th>
                            <th class="text-center">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($theloai as $tl)
                            <tr class="odd gradeX">
                                <td class="text-center">{{ $tl->id }}</td>
                                <td class="text-center">{{ $tl->Ten }}</td>
                                <td class="text-center">{{ $tl->TenKhongDau }}</td>
                                <td class="text-center"><i class="fa fa-trash-o fa-fw"></i><a href="/admin/theloai/xoa/{{ $tl->id }}"> Delete</a></td>
                                <td class="text-center"><i class="fa fa-pencil fa-fw"></i> <a href="/admin/theloai/sua/{{ $tl->id }}">Edit</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection

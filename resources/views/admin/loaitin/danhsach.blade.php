@extends("admin.layout.index")
@section("content")
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Loai Tin
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
                    <tr align="center">
                        <th class="text-center">ID</th>
                        <th class="text-center">Tên</th>
                        <th class="text-center">Tên Không dấu</th>
                        <th class="text-center">Tên Thể loại</th>
                        <th class="text-center">Delete</th>
                        <th class="text-center">Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($loaitin as $lt)
                            <tr class="odd gradeX">
                                <td class="text-center">{{ $lt->id }}</td>
                                <td class="text-center">{{ $lt->Ten }}</td>
                                <td class="text-center">{{ $lt->TenKhongDau }}</td>
                                <td class="text-center">{{ $lt->theloai->Ten }}</td> {{--"theloai" là tên method trong LoaiTin Model--}}
                                <td class="text-center"><i class="fa fa-trash-o fa-fw"></i><a href="/admin/loaitin/xoa/{{ $lt->id }}"> Delete</a></td>
                                <td class="text-center"><i class="fa fa-pencil fa-fw"></i> <a href="/admin/loaitin/sua/{{ $lt->id }}">Edit</a></td>
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

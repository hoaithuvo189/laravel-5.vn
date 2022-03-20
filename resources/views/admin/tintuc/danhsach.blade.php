@extends("admin.layout.index")
@section("content")
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tin Tức
                        <small>Danh Sách</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Tiêu đề</th>
                        <th class="text-center">Tóm tắt</th>
                        <th class="text-center">Thể loại</th>
                        <th class="text-center">Loại tin</th>
                        <th class="text-center">Xem</th>
                        <th class="text-center">Nổi bật</th>
                        <th class="text-center">Delete</th>
                        <th class="text-center">Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($tintuc as $tt)
                            <tr class="odd gradeX">
                                <td class="text-center">{{ $tt->id }}</td>
                                <td class="text-center">{{ $tt->TieuDe }}
                                    <img style="width:100px;" src="/upload/tintuc/{{ $tt->Hinh }}" alt="">
                                </td>
                                <td class="text-center">{{ $tt->TomTat }}</td>
                                <td class="text-center">{{ $tt->loaitin->theloai->Ten }}</td>
                                <td class="text-center">{{ $tt->loaitin->Ten }}</td>
                                <td class="text-center">{{ $tt->SoLuotXem }}</td>
                                <td class="text-center">{{ ($tt->NoiBat === 0) ? "Có" : "Không" }}</td>
                                <td class="text-center"><i class="fa fa-trash-o  fa-fw"></i><a href="/admin/tintuc/xoa/{{ $tt->id }}">Xóa</a></td>
                                <td class="text-center"><i class="fa fa-pencil fa-fw"></i> <a href="/admin/tintuc/sua/{{ $tt->id }}">Sửa</a></td>
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

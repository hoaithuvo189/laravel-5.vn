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
                @if(session("thongbao"))
                    <div class="alert alert-success">
                        {{ session("thongbao") }}
                    </div>
                @endif
                <div class="col-lg-12" style="overflow: auto;">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example" style="overflow:auto">
                        <thead>
                        <tr>
                            <th class="text-center" style="min-width:50px;">ID</th>
                            <th class="text-center" style="min-width:100px;">Tiêu đề</th>
                            <th class="text-center" style="min-width:50px;">Tóm tắt</th>
                            <th class="text-center" style="min-width:65px;">Thể loại</th>
                            <th class="text-center" style="min-width:65px;">Loại tin</th>
                            <th class="text-center" style="min-width:50px;">Xem</th>
                            <th class="text-center" style="min-width:60px;">Nổi bật</th>
                            <th class="text-center" style="min-width:60px;">Delete</th>
                            <th class="text-center" style="min-width:50px;">Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tintuc as $tt)
                            <tr class="odd gradeX">
                                <td class="text-center">{{ $tt->id }}</td>
                                <td class="text-center">{{ $tt->TieuDe }}
                                    <img style="width:100px;" src="/upload/tintuc/{{ $tt->Hinh }}" alt="">
                                </td>
                                <td class="text-center">{!! $tt->TomTat !!}</td>
                                <td class="text-center">{{ $tt->loaitin->theloai->Ten }}</td>
                                <td class="text-center">{{ $tt->loaitin->Ten }}</td>
                                <td class="text-center">{{ $tt->SoLuotXem }}</td>
                                <td class="text-center">{{ ($tt->NoiBat === 1) ? "Có" : "Không" }}</td>
                                <td class="text-center"><i class="fa fa-trash-o  fa-fw"></i><a href="/admin/tintuc/xoa/{{ $tt->id }}">Xóa</a></td>
                                <td class="text-center"><i class="fa fa-pencil fa-fw"></i> <a href="/admin/tintuc/sua/{{ $tt->id }}">Sửa</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection

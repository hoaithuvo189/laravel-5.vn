@extends("admin.layout.index")
@section("content")
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Slide
                        <small>Danh Sách</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                            {{ $err }} <br>
                        @endforeach
                    </div>
                @endif

                @if(session("thongbao"))
                    <div class="alert alert-success">
                        {{ session("thongbao") }}
                    </div>
                @endif
                <div class="col-lg-12" style="overflow: auto">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example" style="overflow: auto">
                        <thead>
                        <tr>
                            <th class="text-center" style="min-width:50px;">ID</th>
                            <th class="text-center" style="min-width:50px;">Tên</th>
                            <th class="text-center" style="min-width:100px;">Nội dung</th>
                            <th class="text-center" style="min-width:140px;">Hình</th>
                            <th class="text-center" style="min-width:50px;">link</th>
                            <th class="text-center" style="min-width:50px;">Delete</th>
                            <th class="text-center" style="min-width:50px;">Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($slide as $sl)
                            <tr class="odd gradeX" align="center">
                                <td>{{ $sl->id }}</td>
                                <td>{{ $sl->Ten }}</td>
                                <td>{{ $sl->NoiDung }}</td>
                                <td>
                                    <img style="max-width: 200px;" src="/upload/slide/{{ $sl->Hinh }}" alt="">
                                </td>
                                <td>{{ $sl->link }}</td>

                                <td class="center"><i class="fa fa-trash-o fa-fw"></i><a href="/admin/slide/xoa/{{ $sl->id }}">Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="/admin/slide/sua/{{ $sl->id }}">Edit</a></td>
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

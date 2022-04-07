@extends("admin.layout.index")

@section("content")
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User
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
                        <th class="text-center">Tên</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Quyền</th>
                        <th class="text-center">Delete</th>
                        <th class="text-center">Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user as $u)
                        <tr class="odd gradeX" align="center">
                            <td class="user_id">{{ $u->id }}</td>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>
                                <button class="change-quyen btn {{ $u->quyen === 1 ? "btn-primary" : "btn-info" }}"
                                        type="button"
                                        data-user-id="{{ $u->id }}">

                                        {{ $u->quyen === 1 ? "Admin" : "User" }}
                                </button>
                            </td>

                            <td class="center"><i class="fa fa-trash-o fa-fw"></i><a href="/admin/user/xoa/{{ $u->id }}"> Delete</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="/admin/user/sua/{{ $u->id }}">Edit</a></td>
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

@section("script")

<script>
    $('.change-quyen').on("click", function() {
        let user_id = $(this).data("user-id");
        let classQuyen = $(this);

        $.ajax({
            type: 'GET',
            dataType: 'JSON',
            url: '{{ route('change-quyen') }}',
            data: { // Gửi đối tượng qua controller
                'id': user_id
            },
            success:function(data) {
                /*  <td class="user_quyen" data-user-id="9">
                      Admin
                  </td>*/

                let classRemove = "";
                let classAdd = "";
                let content = "";

                console.log("data.success: " + data.success);

                if (data.quyen === 1) {
                    classRemove = "btn-info";
                    classAdd = "btn-primary";
                    content = "Admin";
                } else {
                    classRemove = "btn-primary";
                    classAdd = "btn-info";
                    content = "User";
                }

                $(classQuyen).removeClass(classRemove).addClass(classAdd);
                $(classQuyen).html(content);
            }
        });
    });
</script>
@endsection

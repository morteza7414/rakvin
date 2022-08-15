<x-main-layout>

    <x-slot name="title">
        مدیریت دسترسی ها
    </x-slot>

    <x-slot name="links">
        <!-- jsGrid -->
        <link rel="stylesheet" href="{{asset('assets/plugins/jsgrid/jsgrid.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/plugins/jsgrid/jsgrid-theme.min.css')}}">
    </x-slot>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">ویرایش دسترسی</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">خانه</a></li>
                            <li class="breadcrumb-item active">
                                ویرایش دسترسی {{$customer->name}} به آلبوم ها
                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">آلبوم هایی که میخواهید {{$customer->name}} دسترسی داشته باشد را انتخاب کنید</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="col-12">
                        <form method="post" action="{{route('store.customer.accessible',$customer->id)}}">
                            @csrf
                            <table class="table mj-table">
                                <thead role="rowgroup">
                                <tr role="row" class="title-row">
                                    <th>شناسه آلبوم</th>
                                    <th>نام آلبوم</th>
                                    <th>تعداد عکس</th>
                                    <th>دسترسی</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($albums as $album)
                                    <tr role="row" class="">
                                        <td>{{ $album->id }}</td>
                                        <td>{{ $album->name }}</td>
                                        <td>{{ count($album->images) }}</td>
                                        <td>
                                            @if($customer->isAccessToAlbum($album->id))
                                                <input type="checkbox" value="true" checked="checked"
                                                       name="isAccess{{$album->id}}">
                                            @else
                                                <input type="checkbox" value="false" name="isAccess{{$album->id}}">
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-sm btn-dark stand-middle">
                                <i class="fas fa-save"></i> ذخیره اطلاعات
                            </button>
                        </form>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->


    </div>
    <!-- /.content-wrapper -->


    <x-slot name="scripts">

        <!-- jsGrid -->
        <script src="{{asset('assets/plugins/jsgrid/demos/db.js')}}"></script>
        <script src="{{asset('assets/plugins/jsgrid/jsgrid.min.js')}}"></script>

        <!-- page script -->
        <script>
            $(function () {
                $("#jsGrid1").jsGrid({
                    height: "100%",
                    width: "100%",

                    sorting: true,
                    paging: true,

                    data: db.clients,

                    fields: [
                        {name: "Name", type: "text", width: 150},
                        {name: "Age", type: "number", width: 50},
                        {name: "Address", type: "text", width: 200},
                        {name: "Country", type: "select", items: db.countries, valueField: "Id", textField: "Name"},
                        {name: "Married", type: "checkbox", title: "Is Married"}
                    ]
                });
            });
        </script>

    </x-slot>

</x-main-layout>

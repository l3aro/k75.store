<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản trị - Store</title>
    <!-- css -->
    <link href="/assets/admin/css/bootstrap.min.css" rel="stylesheet">

    <link href="/assets/admin/css/styles.css" rel="stylesheet">
    <!--Icons-->
    <script src="/assets/admin/js/lumino.glyphs.js"></script>
    <link rel="stylesheet" href="/assets/admin/Awesome/css/all.css">
</head>

<body>
    <!-- header -->
    @include('admin.layouts.header')
    <!-- header -->
    <!-- sidebar left-->
    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <form role="search">
        </form>
        <ul class="nav menu">
            <li class="active"><a href="index.html"><svg class="glyph stroked dashboard-dial">
                        <use xlink:href="#stroked-dashboard-dial"></use>
                    </svg> Tổng quan</a></li>
            <li><a href="{{ route('admin.categories.index') }}"><svg class="glyph stroked clipboard with paper">
                        <use xlink:href="#stroked-clipboard-with-paper" /></svg> Danh Mục</a></li>
            <li><a href="listproduct.html"><svg class="glyph stroked bag">
                        <use xlink:href="#stroked-bag"></use>
                    </svg> Sản phẩm</a></li>
            <li><a href="order.html"><svg class="glyph stroked notepad ">
                        <use xlink:href="#stroked-notepad" /></svg> Đơn hàng</a></li>
            <li role="presentation" class="divider"></li>
            <li><a href="listuser.html"><svg class="glyph stroked male-user">
                        <use xlink:href="#stroked-male-user"></use>
                    </svg> Quản lý thành viên</a></li>

        </ul>

    </div>
    <!--/. end sidebar left-->

    <!--main-->
    @yield('content')
    <!--end main-->

    <!-- javascript -->
    <script src="/assets/admin/js/jquery-1.11.1.min.js"></script>
    <script src="/assets/admin/js/bootstrap.min.js"></script>
    <script src="/assets/admin/js/chart.min.js"></script>
    <script src="/assets/admin/js/chart-data.js"></script>

</body>

</html>
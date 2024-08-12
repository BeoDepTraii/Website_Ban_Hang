<?php

namespace App\Views\Admin;

use App\Views\BaseView;

class Home extends BaseView
{
    public static function render($data = null)
    {

?>

        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Thống Kê</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/admin">Trang chủ</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Thống Kê</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Sales Cards  -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-md-3">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-account-multiple"></i> <?= $data['total_user'] ?> </h1>
                                <h6 class="text-white">Người Dùng</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-3">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-calendar-text"></i><?= $data['total_category'] ?></h1>
                                <h6 class="text-white">Loại Sản Phẩm</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-3">
                        <div class="card card-hover">
                            <div class="box bg-warning text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-apple"></i><?= $data['total_product'] ?></h1>
                                <h6 class="text-white">Sản Phẩm</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-3">
                        <div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-border-outside"><?= $data['total_comment'] ?></i></h1>
                                <h6 class="text-white">Bình Luận</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Sales chart -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                            <h4 class="card-title">Thống Kê Sản Phẩm Theo Loại</h4>
                            </div>
                            <canvas id="product_by_category"></canvas>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Sales chart -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->

            <script>
                function productByCategoryChart(){
                    var php_data = <?= json_encode($data['product_by_category'])?>;
                    console.log(php_data);
                    var labels=[];
                    var data=[];

                    for(let i of php_data){
                        console.log(i);
                        labels.push(i.name);
                        data.push(i.count);
                    }

                    console.log(labels);
                    console.log(data);
                    
                    
                    
                const ctx = document.getElementById('product_by_category');

                new Chart(ctx, {
                    type: 'pie',
                    data: {
                    labels: labels,
                    datasets: [{
                        label: 'Số lượng sản phẩm',
                        data: data,
                        borderWidth: 1
                    }]
                    },
                    
                });
            }
            productByCategoryChart();
            </script>

    <?php

    }
}

    ?>
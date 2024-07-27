<template>
    <div class="container">

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-4">

            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="mb-0 text-white">INCOME</p>
                                <h4 class="my-1 text-white  text-nowrap">
                                    ৳
                                    <b>
                                        {{ parseInt(Math.random() * 10000000) }}
                                    </b>
                                </h4>
                                <div class="mb-0 font-13 text-white">
                                    <div>
                                        <i class="bx text-danger bxs-down-arrow align-middle mr-1"></i>
                                        <sub class="text-info">
                                            {{ new Date().toDateString() }}
                                        </sub>
                                    </div>
                                    <span class="text-nowrap">
                                        ৳
                                        <b>
                                            {{ parseInt(Math.random() * 1000000) }}
                                        </b>
                                    </span>
                                </div>
                            </div>
                            <div class="widgets-icons bg-light-transparent p-1 bg-white ms-auto">
                                <img src="https://files.etek.com.bd/images/income.png" class="img-fluid" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="mb-0 text-white">Expense</p>
                                <h4 class="my-1 text-white text-nowrap">
                                    ৳
                                    <b>
                                        {{ parseInt(Math.random() * 10000000) }}
                                    </b>
                                </h4>
                                <div class="mb-0 font-13 text-white">
                                    <div>
                                        <i class="bx mr-1 text-success bxs-up-arrow align-middle"></i>
                                        <sub class="text-info">
                                            {{ new Date().toDateString() }}
                                        </sub>
                                    </div>
                                    <span class="text-nowrap">
                                        ৳
                                        <b>
                                            {{ parseInt(Math.random() * 1000000) }}
                                        </b>
                                    </span>
                                </div>
                            </div>
                            <div class="widgets-icons bg-light-transparent bg-white p-1 ms-auto">
                                <img src="https://files.etek.com.bd/images/expense.png" class="img-fluid" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="mb-0 text-white">Profit</p>
                                <h4 class="my-1 text-white text-nowrap">
                                    ৳
                                    <b>
                                        {{ parseInt(Math.random() * 10000000) }}
                                    </b>
                                </h4>
                                <div class="mb-0 font-13 text-white">
                                    <div>
                                        <i class="bx bxs-up-arrow text-success mr-1 align-middle"></i>
                                        <sub class="text-info">
                                            {{ new Date().toDateString() }}
                                        </sub>
                                    </div>
                                    <span class="text-nowrap">
                                        ৳
                                        <b>
                                            {{ parseInt(Math.random() * 1000000) }}
                                        </b>
                                    </span>
                                </div>
                            </div>
                            <div class="widgets-icons bg-light-transparent bg-white p-1 ms-auto">
                                <img src="https://files.etek.com.bd/images/profit.png" class="img-fluid" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="mb-0 text-white">DUE</p>
                                <h4 class="my-1 text-white text-nowrap">
                                    ৳
                                    <b>
                                        {{ parseInt(Math.random() * 10000000) }}
                                    </b>
                                </h4>
                                <div class="mb-0 font-13 text-white">
                                    <div>
                                        <i class="bx mr-1 bxs-down-arrow text-danger align-middle"></i>
                                        <sub class="text-info">
                                            {{ new Date().toDateString() }}
                                        </sub>
                                    </div>
                                    <span class="text-nowrap">
                                        ৳
                                        <b>
                                            {{ parseInt(Math.random() * 1000000) }}
                                        </b>
                                    </span>
                                </div>
                            </div>
                            <div class="widgets-icons bg-light-transparent bg-white p-1 ms-auto">
                                <img src="https://files.etek.com.bd/images/due.png" class="img-fluid" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="card radius-10 w-100">
            <div class="card-header">
                <h3>Sales</h3>
            </div>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-4 g-3">
                    <div class="col py-4" v-for="i in 4" :key="i">
                        <div class="p-3 text-center border radius-10 analytic_compare_card">
                            <div class="analytics_arrow">
                                <img v-if="i % 2 == 0" src="https://files.etek.com.bd/images/arrow_up.png" alt="">
                                <img v-if="i % 2 != 0" src="https://files.etek.com.bd/images/arrow_down.png" alt="">
                            </div>
                            <div class="mid_text">
                                <div>
                                    <b class="text-info">
                                        Today
                                    </b>
                                </div>
                                <div>
                                    BDT:
                                    <b>
                                        {{ parseInt(Math.random() * 10000000) }}
                                    </b>
                                    TK
                                </div>
                                <div>
                                    <b class="text-warning">
                                        Yesterday
                                    </b>
                                </div>
                                <div>
                                    BDT:
                                    <b>
                                        {{ parseInt(Math.random() * 10000000) }}
                                    </b>
                                    TK
                                </div>
                            </div>
                            <div class="chart_donat">
                                <div class="text_percentage">
                                    {{ parseInt(Math.random() * 1000) }}%
                                </div>
                                <div class="chart_donat_chart">
                                    <span class="donut"
                                        data-peity='{ "fill": ["#fff", "rgb(255 255 255 / 12%)"], "innerRadius": 35, "radius": 25 }'>
                                        {{ parseInt(Math.random() * 10) }}/{{ parseInt(Math.random() * 10) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>

        <div class="card radius-10 w-100">
            <div class="card-header">
                <h3>Purchase</h3>
            </div>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-4 g-3">
                    <div class="col py-4" v-for="i in 4" :key="i">
                        <div class="p-3 text-center border radius-10 analytic_compare_card">
                            <div class="analytics_arrow">
                                <img v-if="i % 2 == 0" src="https://files.etek.com.bd/images/arrow_up.png" alt="">
                                <img v-if="i % 2 != 0" src="https://files.etek.com.bd/images/arrow_down.png" alt="">
                            </div>
                            <div class="mid_text">
                                <div>
                                    <b class="text-info">
                                        Today
                                    </b>
                                </div>
                                <div>
                                    BDT:
                                    <b>
                                        {{ parseInt(Math.random() * 10000) }}
                                    </b>
                                    TK
                                </div>
                                <div>
                                    <b class="text-warning">
                                        Yesterday
                                    </b>
                                </div>
                                <div>
                                    BDT:
                                    <b>
                                        {{ parseInt(Math.random() * 10000) }}
                                    </b>
                                    TK
                                </div>
                            </div>
                            <div class="chart_donat">
                                <div class="text_percentage">
                                    {{ parseInt(Math.random() * 1000) }}%
                                </div>
                                <div class="chart_donat_chart">
                                    <span class="donut"
                                        data-peity='{ "fill": ["#fff", "rgb(255 255 255 / 12%)"], "innerRadius": 35, "radius": 25 }'>4/5</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-8 col-xl-8 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3 justify-content-between">
                            <h5 class="mb-0">Performance</h5>
                            <div class="dropdown options ms-auto">
                                <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                                    <i class='bx bx-dots-horizontal-rounded'></i>
                                </div>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                                    <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                                    <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                                </ul>
                            </div>
                        </div>

                        <div
                            class="hstack flex-wrap align-items-center justify-content-between gap-3 gap-sm-4 mb-3 border p-3 radius-10">
                            <div class="">
                                <h5 class="mb-0">974 <span class="text-white font-13">56% <i
                                            class='bx bx-up-arrow-alt'></i></span></h5>
                                <p class="mb-0">Page Views</p>
                            </div>
                            <div class="vr"></div>
                            <div class="">
                                <h5 class="mb-0">1,218 <span class="text-white font-13">34% <i
                                            class='bx bx-down-arrow-alt'></i></span></h5>
                                <p class="mb-0">Total Sales</p>
                            </div>
                            <div class="vr"></div>
                            <div class="">
                                <h5 class="mb-0">42.8% <span class="text-white font-13">22% <i
                                            class='bx bx-up-arrow-alt'></i></span></h5>
                                <p class="mb-0">Conversion Rate</p>
                            </div>
                        </div>

                        <div class="chart-js-container1">
                            <canvas id="chart1"></canvas>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-xl-4 d-flex">
                <div class="card radius-10 overflow-hidden w-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <h5 class="mb-0">Top Categories</h5>
                            <div class="dropdown options ms-auto">
                                <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                                    <i class='bx bx-dots-horizontal-rounded'></i>
                                </div>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                                    <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                                    <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="chart-js-container2 mt-4">
                            <div class="piechart-legend">
                                <h2 class="mb-1">8,452</h2>
                                <h6 class="mb-0">Total Sessions</h6>
                            </div>
                            <canvas id="chart2"></canvas>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li
                            class="list-group-item d-flex justify-content-between align-items-center border-top bg-transparent">
                            Clothing
                            <span class="badge bg-white rounded-pill text-dark">558</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                            Electronics
                            <span class="badge bg-white bg-opacity-50 text-dark rounded-pill">204</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                            Furniture
                            <span class="badge bg-white bg-opacity-25 text-dark rounded-pill">108</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div><!--end row-->

        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h5 class="mb-0">Orders Summary</h5>
                    </div>
                    <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Order id</th>
                                <th>Product</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#897656</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="recent-product-img">
                                            <img src="/backend/assets/images/products/12.png" alt="">
                                        </div>
                                        <div class="ms-2">
                                            <h6 class="mb-1 font-14">Light Blue Chair</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>Brooklyn Zeo</td>
                                <td>12 Jul 2020</td>
                                <td>$64.00</td>
                                <td>
                                    <div class="d-grid">
                                        <a href="javascript:;" class="btn btn-sm btn-light radius-30">Pending</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex order-actions gap-3">
                                        <a href="javascript:;"><i class="bx bx-trash"></i></a>
                                        <a href="javascript:;"><i class="bx bx-cloud-download"></i></a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card radius-10 w-100">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div>
                        <h5 class="mb-0">Weekly Visits</h5>
                    </div>
                    <div class="dropdown options ms-auto">
                        <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-horizontal-rounded"></i>
                        </div>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                            <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                            <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-js-container3">
                    <canvas id="chart3" style="display: block; box-sizing: border-box; height: 380px; width: 1005px;"
                        width="1005" height="380"></canvas>
                </div>
            </div>
        </div>

        <!--start overlay-->
        <div class="overlay"></div>
        <!--end overlay-->

    </div>
    <!-- End container-fluid-->
</template>

<script>
export default {
    mounted: function () {
        this.init_chart1();
        this.init_chart2();
        this.init_chart3();
        this.init_pitty_donut();
    },
    methods: {
        init_chart1: function () {
            var ctx = document.getElementById('chart1').getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    datasets: [{
                        label: 'Page Views',

                        data: [20, 35, 30, 35, 28, 22, 25],
                        backgroundColor: [
                            "#fff"
                        ],
                        borderColor: [
                            "#fff"
                        ],
                        borderWidth: 0,
                        borderRadius: 20
                    },
                    {
                        label: 'Sales',
                        data: [15, 22, 13, 25, 20, 10, 15],
                        backgroundColor: [
                            "rgb(255 255 255 / 50%)"
                        ],
                        borderColor: [
                            "rgb(255 255 255 / 50%)"
                        ],
                        borderWidth: 0,
                        borderRadius: 20
                    }, {
                        label: 'Conversion',
                        data: [10, 15, 9, 15, 17, 16, 10],
                        backgroundColor: [
                            "rgb(255 255 255 / 25%)"
                        ],
                        borderColor: [
                            "rgb(255 255 255 / 25%)"
                        ],
                        borderWidth: 0,
                        borderRadius: 20
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    barPercentage: 0.7,
                    categoryPercentage: 0.45,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            display: true,
                            labels: {
                                color: 'rgb(255 255 255 / 75%)'
                            }

                        }
                    },
                    scales: {
                        x: {
                            stacked: false,
                            beginAtZero: true,
                            ticks: {
                                color: "rgb(255 255 255 / 75%)", // this here
                            },
                            grid: {
                                display: true,
                                color: "rgba(221, 221, 221, 0.08)"
                            }
                        },
                        y: {
                            stacked: false,
                            beginAtZero: true,
                            ticks: {
                                color: "rgb(255 255 255 / 75%)", // this here
                            },
                            grid: {
                                display: true,
                                color: "rgba(221, 221, 221, 0.08)"
                            }
                        },

                    }
                }
            });
        },
        init_chart2: function () {
            // chart2
            var ctx = document.getElementById('chart2').getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Desktop', 'Mobile', 'Tablet'],
                    datasets: [{
                        data: [155, 120, 110],
                        backgroundColor: [
                            "rgb(255 255 255 / 100%)",
                            "rgb(255 255 255 / 50%)",
                            "rgb(255 255 255 / 25%)"
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    cutout: 110,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    }

                }
            });
        },
        init_chart3: function () {
            var ctx = document.getElementById('chart3').getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
                    datasets: [{
                        label: 'Visitors',
                        data: [12, 25, 13, 25, 14, 35, 10],
                        backgroundColor: [
                            "rgb(255 255 255 / 100%)",
                        ],
                        fill: {
                            target: 'origin',
                            above: 'rgb(255 255 255 / 12%)',   // Area will be red above the origin
                            below: 'rgb(255 255 255 / 12%)'    // And blue below the origin
                        },
                        tension: 0.4,
                        borderColor: [
                            "rgb(255 255 255 / 100%)",
                        ],
                        borderWidth: 4
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    scales: {
                        x: {
                            stacked: false,
                            beginAtZero: true,
                            ticks: {
                                color: "rgb(255 255 255 / 75%)", // this here
                            },
                            grid: {
                                display: true,
                                color: "rgba(221, 221, 221, 0.08)"
                            }
                        },
                        y: {
                            stacked: false,
                            beginAtZero: true,
                            ticks: {
                                color: "rgb(255 255 255 / 75%)", // this here
                            },
                            grid: {
                                display: true,
                                color: "rgba(221, 221, 221, 0.08)"
                            }
                        },

                    }
                }
            });

        },
        init_pitty_donut: function () {
            $("span.donut").peity("donut", {
                width: 80,
                height: 80
            });
        }
    }
}



</script>

<style></style>

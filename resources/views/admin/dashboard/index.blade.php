@extends('layouts.admin')

@section('title', 'Dashboard - Admin')

@section('content')
    <h2>Thống kê doanh thu</h2>
    <canvas id="revenueChart" width="400" height="200"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Dữ liệu từ Controller
        var revenue = @json($revenue);  // Dữ liệu doanh thu từ bảng products
        var months = @json($months);    // Dữ liệu tháng

        // Tạo biểu đồ doanh thu
        var ctx = document.getElementById('revenueChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Doanh thu (triệu VND)',
                    data: revenue,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection

@extends('layouts.admin')

@section('content')
<div class="w-full h-full p-6">
    <div class="flex flex-col md:flex-row space-y-6 md:space-y-0 md:space-x-6">
        <!-- Claims This Week Chart -->
        <div class="flex-1 bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4 text-purple-900">Claims this week</h2>
            <div style="height: 400px; width: 500px;">
                <canvas id="claimsChart"></canvas>
            </div>
        </div>

        <!-- Accepted Claims Chart -->
        <div class="flex-1 bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4 text-purple-900">Accepted Claims this week</h2>
            <div style="height: 400px; width: 500px;">
                <canvas id="acceptedClaimsChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    // Claims Chart
    const claimsCtx = document.getElementById('claimsChart').getContext('2d');
    new Chart(claimsCtx, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Claims',
                data: [65, 60, 80, 81, 58, 55, 40],
                fill: true,
                borderColor: '#4B0082',
                backgroundColor: 'rgba(75, 0, 130, 0.1)',
                tension: 0.4,
                pointRadius: 4,
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        font: {
                            size: 14
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false,
                        color: 'rgba(0, 0, 0, 0.1)'
                    },
                    ticks: {
                        font: {
                            size: 12
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 12
                        }
                    }
                }
            }
        }
    });

    // Accepted Claims Chart
    const acceptedClaimsCtx = document.getElementById('acceptedClaimsChart').getContext('2d');
    new Chart(acceptedClaimsCtx, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Accepted Claims',
                data: [45, 48, 60, 70, 45, 45, 30],
                fill: true,
                borderColor: '#22C55E',
                backgroundColor: 'rgba(34, 197, 94, 0.1)',
                tension: 0.4,
                pointRadius: 4,
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        font: {
                            size: 14
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false,
                        color: 'rgba(0, 0, 0, 0.1)'
                    },
                    ticks: {
                        font: {
                            size: 12
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 12
                        }
                    }
                }
            }
        }
    });
</script>
@endsection

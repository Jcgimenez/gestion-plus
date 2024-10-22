<x-app-layout>
    <body>
        <div class="card">
            <span class="text-3xl font-bold">Welcome {{$user->name}}</span>

            @php
                $totalIncomes = 0;
                $totalExpenses = 0;

                foreach($user->banks as $bank) {
                    $totalIncomes += $bank->income->sum('amount');
                    $totalExpenses += $bank->expense->sum('amount');
                }
            @endphp

            <!-- Containers for the charts -->
            <div class="chart-container">
                <canvas id="pieChart"></canvas>
                <canvas id="barChart"></canvas>
            </div>

            <!-- Cards for financial entities -->
            <div class="chart-container">
                @foreach($user->banks as $bank)
                    <div class="bank-card">
                        <div class="bank-title">{{ $bank->name }}</div>
                        <ul class="transaction-list" id="bank-{{ $bank->id }}-transactions">
                            @if($bank->income->isNotEmpty())
                                @foreach($bank->income as $income)
                                    <li class="transaction-item income">
                                        <span>Income</span><span>${{ $income->amount }}</span>
                                    </li>
                                @endforeach
                            @else
                                <li>No incomes found for this bank.</li>
                            @endif

                            @if($bank->expense->isNotEmpty())
                                @foreach($bank->expense as $expense)
                                    <li class="transaction-item expense">
                                        <span>Expense</span><span>${{ $expense->amount }}</span>
                                    </li>
                                @endforeach
                            @else
                                <li>No expenses found for this bank.</li>
                            @endif
                        </ul>
                    </div>
                @endforeach
            </div>

            <!-- Cards for work details -->
            <div class="chart-container">
                @php
                    $totalHours = 0;
                    $totalEarnings = 0;
                @endphp

                @foreach($user->companies as $company)
                    <div class="work-card">
                        <div class="work-title">{{$company->name}}</div>
                        <p>Hours Worked: {{$company->hours_worked}}</p>
                        <p>Monthly Earnings: ${{ number_format($company->monthly_earnings, 2) }}</p>
                    </div>

                    @php
                        $totalHours += $company->hours_worked;
                        $totalEarnings += $company->monthly_earnings;
                    @endphp
                @endforeach
            </div>

            <!-- Totals card -->
            <div class="chart-container">
                <div class="work-card" style="background-color: #f0f4f8;">
                    <div class="work-title">Total</div>
                    <p>Total Hours Worked: {{$totalHours}}</p>
                    <p>Total Monthly Earnings: ${{ number_format($totalEarnings, 2) }}</p>
                </div>
            </div>
        </div>

        <script>
            const pieData = {
                labels: ['Incomes', 'Expenses'],
                datasets: [{
                    data: [{{ $totalIncomes }}, {{ $totalExpenses }}],
                    backgroundColor: ['rgb(21 128 61)', 'rgb(185 28 28)'],
                    hoverOffset: 4
                }]
            };

            // Create the pie chart
            const pieChart = new Chart(document.getElementById('pieChart'), {
                type: 'pie',
                data: pieData,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        title: {
                            display: true,
                            text: 'Distribution of Incomes and Expenses'
                        }
                    }
                }
            });

            // Data for the bar chart with real totals from the backend
            const barData = {
                labels: ['Incomes', 'Expenses'],
                datasets: [{
                    label: 'Amount',
                    data: [{{ $totalIncomes }}, {{ $totalExpenses }}],
                    backgroundColor: ['rgb(21 128 61)', 'rgb(185 28 28)'],
                }]
            };

            // Create the bar chart
            const barChart = new Chart(document.getElementById('barChart'), {
                type: 'bar',
                data: barData,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Incomes vs Expenses'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </body>
</x-app-layout>
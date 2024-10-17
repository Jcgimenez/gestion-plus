


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to right, #e0f7fa, #f1f8e9);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
        }

        .card {
            background-color: white;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            width: 90%;
            max-width: 1200px;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            background-color: #38bdf8;
            color: white;
            font-weight: 600;
            border-radius: 10px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0284c7;
        }

        .chart-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        canvas {
            max-width: 300px;
            max-height: 300px;
        }

        .bank-card, .work-card {
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            padding: 1rem;
            width: 22%;
            min-width: 200px;
            margin: 10px;
            text-align: left;
        }

        .bank-title, .work-title {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .transaction-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .transaction-item {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
        }

        .income {
            color: #21a179; /* Green */
        }

        .expense {
            color: #b91c1c; /* Red */
        }
    </style>
</head>
<body>
    <div class="card">
        <!-- TODO: TITULO -->
        <a href="{{ route('register-login') }}" class="btn fixed top-2 right-2">Sign In / Sign Up</a>

        <!-- Containers for the charts -->
        <div class="chart-container">
            <canvas id="pieChart"></canvas>
            <canvas id="barChart"></canvas>
        </div>

        <!-- Cards for financial entities -->
        <div class="chart-container">
            @foreach($user->banks as $bank)
                <div class="bank-card">
                    <div class="bank-title">{{$bank->name}}</div>
                    <ul class="transaction-list" id="{{$bank->cod_name}}-transactions"></ul>
                </div>
            @endforeach
        </div>

        <!-- Cards for work details -->
        <div class="chart-container">
            @php
                // Inicializamos las variables para sumar el total de horas y ganancias
                $totalHours = 0;
                $totalEarnings = 0;
            @endphp
            
            <!-- Iteramos sobre cada empresa -->
            @foreach($user->companies as $company)
                <div class="work-card">
                    <div class="work-title">{{$company->name}}</div>
                    <p>Hours Worked: {{$company->hours_worked}}</p>
                    <p>Monthly Earnings: ${{ number_format($company->monthly_earnings, 2) }}</p>
                </div>
            
                <!-- Acumulamos las horas trabajadas y ganancias -->
                @php
                    $totalHours += $company->hours_worked;
                    $totalEarnings += $company->monthly_earnings;
                @endphp
            @endforeach
        </div>
            
        <!-- Mostramos una tarjeta con los totales -->
        <div class="chart-container">
            <div class="work-card" style="background-color: #f0f4f8;">
                <div class="work-title">Total</div>
                <p>Total Hours Worked: {{$totalHours}}</p>
                <p>Total Monthly Earnings: ${{ number_format($totalEarnings, 2) }}</p>
            </div>
        </div>

    </div>

    <script>
        // Generate random incomes and expenses
        function generateRandomTransactions() {
            let transactions = [];
            for (let i = 0; i < 5; i++) {
                const income = (Math.random() * 1000).toFixed(2);
                const expense = (Math.random() * 1000).toFixed(2);
                transactions.push({ type: 'income', amount: income });
                transactions.push({ type: 'expense', amount: expense });
            }
            return transactions;
        }

        function displayTransactions(containerId, transactions) {
            const container = document.getElementById(containerId);
            transactions.forEach(transaction => {
                const li = document.createElement('li');
                li.classList.add('transaction-item');
                li.classList.add(transaction.type === 'income' ? 'income' : 'expense');
                li.innerHTML = `<span>${transaction.type === 'income' ? 'Income' : 'Expense'}</span><span>$${transaction.amount}</span>`;
                container.appendChild(li);
            });
        }

        // Fill each card with random data
        const macroTransactions = generateRandomTransactions();
        const ualaTransactions = generateRandomTransactions();
        const mpTransactions = generateRandomTransactions();
        const lemonTransactions = generateRandomTransactions();
        const binanceTransactions = generateRandomTransactions();

        displayTransactions('macro-transactions', macroTransactions);
        displayTransactions('uala-transactions', ualaTransactions);
        displayTransactions('mp-transactions', mpTransactions);
        displayTransactions('lemon-transactions', lemonTransactions);
        displayTransactions('binance-transactions', binanceTransactions);

        // Sample data for the pie chart
        const pieData = {
            labels: ['Incomes', 'Expenses'],
            datasets: [{
                data: [Math.floor(Math.random() * 100), Math.floor(Math.random() * 100)],
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

        // Sample data for the bar chart
        const barData = {
            labels: ['Incomes', 'Expenses'],
            datasets: [{
                label: 'Amount',
                data: [Math.floor(Math.random() * 5000), Math.floor(Math.random() * 5000)],
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
</html>

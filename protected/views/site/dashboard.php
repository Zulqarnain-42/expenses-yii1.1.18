<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
  
  <!-- Left Column: Total Expenses Summary -->
  <div class="bg-gray-800 rounded-lg shadow p-6">
    <h3 class="text-lg font-semibold mb-2 text-white">Total Expenses</h3>
    <p class="text-2xl font-bold text-red-400">
      <?php echo CHtml::encode($totalExpenses); ?>
    </p>
  </div>

  <!-- Right Column: Pie Chart -->
  <div class="bg-gray-800 rounded-lg shadow p-6">
    <h2 class="text-xl font-semibold mb-4 text-white">Expenses Breakdown</h2>
    <canvas id="expensesPieChart"></canvas>
  </div>

</div>

<canvas id="expensesPieChart" width="400" height="400"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('expensesPieChart').getContext('2d');
  const expensesPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: <?php echo $labels; ?>,
      datasets: [{
        label: 'Expenses',
        data: <?php echo $data; ?>,
        backgroundColor: [
          '#ef4444', '#3b82f6', '#fbbf24', '#10b981',
          '#8b5cf6', '#ec4899', '#f97316', '#14b8a6'
        ],
        borderWidth: 1,
        borderColor: '#1f2937',
      }]
    },
    options: {
      plugins: {
        legend: {
          labels: {
            color: 'white'
          }
        }
      }
    }
  });
</script>

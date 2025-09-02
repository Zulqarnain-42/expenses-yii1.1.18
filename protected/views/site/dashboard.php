
<div class="flex flex-wrap gap-6">
    <!-- Two Columns with Summary -->
  <div class="w-full md:w-1/2 grid grid-cols-2 gap-6">
    <div class="bg-gray-800 rounded-lg shadow p-6">
      <h3 class="text-lg font-semibold mb-2 text-white">Total Expenses</h3>
      <p class="text-2xl font-bold text-red-400">$3,200</p>
    </div>
    <div class="bg-gray-800 rounded-lg shadow p-6">
      <h3 class="text-lg font-semibold mb-2 text-white">Remaining Budget</h3>
      <p class="text-2xl font-bold text-green-400">$800</p>
    </div>
  </div>
  <!-- Pie Chart -->
  <div class="w-full md:w-1/2 bg-gray-800 rounded-lg shadow p-6">
    <h2 class="text-xl font-semibold mb-4 text-white">Expenses Breakdown</h2>
    <canvas id="expensesPieChart"></canvas>
  </div>

  
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('expensesPieChart').getContext('2d');
  const expensesPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ['Rent', 'Groceries', 'Utilities', 'Entertainment'],
      datasets: [{
        label: 'Expenses',
        data: [1200, 800, 600, 600],
        backgroundColor: [
          '#ef4444', // red-500
          '#3b82f6', // blue-500
          '#fbbf24', // yellow-400
          '#10b981'  // green-500
        ],
        borderWidth: 1,
        borderColor: '#1f2937', // gray-800
      }]
    },
    options: {
      plugins: {
        legend: {
          labels: {
            color: 'white' // legend text white for dark bg
          }
        }
      }
    }
  });
</script>

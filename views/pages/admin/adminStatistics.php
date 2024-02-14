<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h2 class="text-center mt-4">Page Traffic Statistics <br> <small>(Last 24 hours)</small></h2>
      <hr class="underTitle mb-4" />

      <div class="container" id="statisticsDiv">
        <canvas id="myChart">

        </canvas>
      </div>
    </div>
  </div>
</div>

<script>
  const ctx = document.getElementById('myChart');

  const pages = <?= json_encode(getAllPages()) ?>;
  const percentages = <?= json_encode(getPageTrafficData()) ?>;
  const percentageValues = Object.values(percentages);

  new Chart(ctx, {
    type: 'pie',
    data: {
      labels: pages,
      datasets: [{
        label: 'Visit %',
        data: percentageValues,
        backgroundColor: ['#CB4335', '#1F618D', '#F1C40F', '#27AE60', '#884EA0', '#FF2ACD', '#BCEE21']
      }]
    },
    options: {
      plugins: {
        legend: {
          onHover: handleHover,
          onLeave: handleLeave
        }
      }
    }
  });


  // Removes the alpha channel from background colors
  function handleLeave(evt, item, legend) {
    legend.chart.data.datasets[0].backgroundColor.forEach((color, index, colors) => {
      colors[index] = color.length === 9 ? color.slice(0, -2) : color;
    });
    
    legend.chart.update();
  }

  // Append '4d' to the colors (alpha channel), except for the hovered index
  function handleHover(evt, item, legend) {
    legend.chart.data.datasets[0].backgroundColor.forEach((color, index, colors) => {
      colors[index] = index === item.index || color.length === 9 ? color : color + '4D';
    });

    legend.chart.update();
  }

</script>
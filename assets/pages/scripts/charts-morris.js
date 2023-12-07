jQuery(document).ready(function() {
  // MORRIS CHARTS DEMOS







  // BAR CHART
  new Morris.Bar({
    element: 'morris_chart_3',
    data: [
      { y: '04-01-2019', a: 200, b: 90 },
      { y: '2007', a: 75,  b: 65 },
      { y: '2008', a: 50,  b: 40 },
      { y: '2009', a: 75,  b: 65 },
      { y: '2010', a: 50,  b: 40 },
      { y: '2011', a: 75,  b: 65 },
      { y: '2012', a: 100, b: 90 }
    ],
    xkey: 'y',
    ykeys: ['a', 'b'],
    labels: ['incoming', 'Outgoing']
  });


});

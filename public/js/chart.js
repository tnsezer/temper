var app = new Vue({
    el: '#chart',
    data: {
        chart: {},
    },
    methods: {
        init: function () {
            axios.get('/load.php')
                .then(function (response) {
                    console.log('loaded');
                    var chart =  {
                        chart: { type: 'spline' },
                        title: { text: 'Temper OnBoarding' },
                        xAxis: { title: {text: 'Steps'}, categories: response.data.steps },
                        yAxis: { title: {text: 'Percentage of Users (%)'}, min: 0, max: 100 },
                        tooltip: { valueSuffix: '%' },
                        series: response.data.series
                    };

                    this.chart = Highcharts.chart('chartContainer', chart);
                }.bind(this))
                .catch(function (error) {
                    console.log(error);
                }.bind(this));
        }
    },

    created: function () {
        console.log('created');
        this.init();
    }
});
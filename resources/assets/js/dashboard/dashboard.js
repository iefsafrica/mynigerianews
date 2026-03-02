'use strict';
document.addEventListener('turbo:load', loadDashboardData);


function  loadDashboardData(){
    let dashboardChartBGColor = $('#dashboardChartBGColor').val()
    const timeRange = $('#timeRange');
    let start = moment().subtract(30, 'days');
    let end = moment();
    window.cb = function (start, end) {
        timeRange.find('span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
        loadChartData(start.format('MMM D, YYYY'), end.format('MMM D, YYYY'));
    };

    timeRange.daterangepicker({
        startDate: start,
        endDate: end,
        opens: 'left',
        maxDate: moment(),
        showDropdowns: true,
        autoUpdateInput: false,
        locale:{
            customRangeLabel: Lang.get('js.custom'),
            applyLabel:Lang.get('js.apply'),
            cancelLabel: Lang.get('js.cancel'),
            fromLabel:Lang.get('js.from'),
            toLabel: Lang.get('js.to'),
            monthNames: [
                Lang.get('js.jan'),
                Lang.get('js.feb'),
                Lang.get('js.mar'),
                Lang.get('js.apr'),
                Lang.get('js.may'),
                Lang.get('js.jun'),
                Lang.get('js.jul'),
                Lang.get('js.aug'),
                Lang.get('js.sep'),
                Lang.get('js.oct'),
                Lang.get('js.nov'),
                Lang.get('js.dec')
            ],
            daysOfWeek: [
                Lang.get('js.sun'),
                Lang.get('js.mon'),
                Lang.get('js.tue'),
                Lang.get('js.wed'),
                Lang.get('js.thu'),
                Lang.get('js.fri'),
                Lang.get('js.sat')
            ],
        },
        ranges: {
            [Lang.get('js.this_week')]: [moment().startOf('week'), moment().endOf('week')],
            [Lang.get('js.last_week')]: [moment().startOf('week').subtract(7, 'days'), moment().startOf('week').subtract(1, 'days')]
        }
    }, cb);
    cb(start, end);

    function loadChartData(startDate, endDate) {
        if (!$('#postChartContainer').length) {
            return
        }
        $.ajax({
            type: 'GET',
            url: '/admin/chart',
            dataType: 'json',
            data: {
                start_date: startDate,
                end_date: endDate,
            },
            success: function (result) {
                chart(result.data)
            }
        });
    }

    function chart(result) {
        if (!$('#postChartContainer').length) {
            return
        }
        $('#postChartContainer').empty();
        $('#postChartContainer').append('<canvas id="postChart" class="post-chart" style="display: block; width: 905px; height: 400px;"></canvas>');

        new Chart("postChart", {
            type: "line",
            data: {
                labels: result.labels,
                datasets: [{
                    label: Lang.get('js.views'),
                    fill: true,
                    lineTension: 0.5,
                    backgroundColor: dashboardChartBGColor,
                    borderColor: "rgba(0,0,255,0.1)",
                    data: result.data,
                }],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: false
                    },
                }
            }
        });
    }
};

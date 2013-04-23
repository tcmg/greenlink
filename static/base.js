function site_url(slug) {
    return SITE_URL + '/' + slug;
}

$(document).ready(function() {
    $('#analytics-page').each(function() {

        var data = [
            { label: 'a', data: 50 },
            { label: 'b', data: 20 }
        ]
        data = pieData;

        $.plot($("#analytics-pie"), data, {
            series: {
                pie: { 
                        show: true,
                        radius: 3/4,
                        label: {
                            show: true,
                            radius: 3/4,
                            formatter: function(label, series) {
                                return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
                            },
                            background: { 
                                opacity: 0.5,
                                color: '#000'
                            }
                        }
                },
                legend: {
                    show: false
                }
            }
        });

        indexData = {};
        finalData = [];

        $.each(lineData, function(i, e) {
            var d = new Date(parseInt(e.timestamp) * 1000);
            e['date'] = d;
            e['date_axis'] = d.getDate() + '/' + (d.getMonth() + 1) + '/' + d.getFullYear();

            if (!(e['date_axis'] in indexData)) {
                indexData[e['date_axis']] = { count: 0, date: d.getDate(), month: (d.getMonth()), year: d.getFullYear() };
            }
            (indexData[e['date_axis']].count)++;
        });

        $.each(indexData, function(i, e) {
            var tempDate = new Date(e.year, e.month, e.date);
            var timestamp = tempDate.getTime();
            finalData.push([timestamp, e.count]);
        });

        $.plot($('#analytics-line'), [finalData], {
            xaxis: {
                mode: "time",
                minTickSize: [1, "day"]

            }           
        });
    });

});

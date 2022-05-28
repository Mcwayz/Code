$(document).ready(function () {
    $.ajax({
        url: "http://localhost/IT-HelpDesk/admin/dist/chartdata.php",
        type: "GET",
        success: function (data) {
            console.log(data);
            var closed_tickets = [];
            var pending_tickets = [];
            var total_tickets = [];
            var overdue_tickets = [];
            for (var i in data)
            {
                total_tickets.push("Total Tickets "+ data[i].Total);
                closed_tickets.push(data[i].Closed);
                pending_tickets.push(data[i].Pending);
                overdue_tickets.push(data[i].Overdue);
            }

            var chartdata = {
                labels: ["Mar 1", "Mar 2", "Mar 3", "Mar 4", "Mar 5", "Mar 6", "Mar 7", "Mar 8", "Mar 9", "Mar 10", "Mar 11", "Mar 12", "Mar 13"],
                datasets: [
                    {
                        label: "Overdue",
                        fill: false,
                        lineTension: 0.1,
                        backgroundColor: "rgba(211,72,54, 0.75)",
                        borderColor: "rgba(211, 72,54, 1)",
                        pointHoverBackgroundColor: "rgba(211, 72,54, 1)",
                        pointHoverBorderColor: "rgba(211, 72,54, 1)",
                        data: overdue_tickets
                    },
                     
                    {
                        label: "Closed",
                        fill: false,
                        lineTension: 0.1,
                        backgroundColor: "rgba(59,89,152, 0.75)",
                        borderColor: "rgba(59,89,152, 1)",
                        pointHoverBackgroundColor: "rgba(59,89,152, 1)",
                        pointHoverBorderColor: "rgba(59,89,152, 1)",
                        data: closed_tickets
                    },

                    {
                        label: "Pending",
                        fill: false,
                        lineTension: 0.1,
                        backgroundColor: "rgba(29, 202, 255, 0.75)",
                        borderColor: "rgba(29, 202, 255, 1)",
                        pointHoverBackgroundColor: "rgba(29, 202, 255, 1)",
                        pointHoverBorderColor: "rgba(29, 202, 255, 1)",
                        data: pending_tickets
                    }
                ]
            };

            var ctx = $("#mycanvas");
            var LineGraph = new Chart(ctx, {
                type: 'line',
                data: chartdata
            });

        },
        error: function (data) {

        }
    });
});
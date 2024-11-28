document.addEventListener("DOMContentLoaded", function () {

    const cardswithinfo = document.getElementsByClassName("SeeAllButton");



    for (let i = 0; i < cardswithinfo.length; i++) {
        const cardcolor = cardswithinfo[i].style.backgroundColor;

        cardswithinfo[i].addEventListener("mouseover", function () {
            cardswithinfo[i].style.backgroundColor = 'grey';
        });

        cardswithinfo[i].addEventListener("mouseout", function () {
            cardswithinfo[i].style.backgroundColor = cardcolor;
        });

        cardswithinfo[i].addEventListener("click", function () {
            cardswithinfo[i].style.backgroundColor = cardcolor;
        });


    };

    function resetActive() {
        const links = document.getElementsByClassName("nav-link");
        for (let i = 0; i < links.length; i++) {
            links[i].classList.remove("active");
        }

        // Alternative:
        // document.querySelectorAll(".nav-link").forEach(link => link.classList.remove("active"));
    }

    // Event listener for "DailyShiftTab"
    document.getElementById("DailyShiftTab").addEventListener("click", function () {
        resetActive();
        this.classList.add("active");


        // Fetch data from the server
        urlstaffonshift = "staff_on_shift.php";
        fetch(urlstaffonshift)
            .then(response => response.json())
            .then(function (data) {
                const content = document.getElementById("CardContent");
                const title = document.getElementById("CardTitle");
                content.innerHTML = ""; // Clear previous content
                title.innerHTML = `<h5>Staff on Shift</h5>`


                if (data.message) {
                    content.innerHTML = `<p class="text-center m-4 text-secondary font-italic "> No staff on shift at the moment...</p>`
                } else {
                    // Create a new table
                    const table = document.createElement("table");
                    table.classList.add("table", "text-start");

                    // Add the header
                    table.innerHTML = `
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Staff Name</th>
                            <th scope="col">Staff Role</th>
                            <th scope="col">Attendance</th>
                        </tr>
                    </thead>`;

                    // Create table body
                    const tableBody = document.createElement("tbody");

                    // Populate the table with staff data
                    data.forEach(staff => {
                        const row = document.createElement("tr");

                        row.innerHTML = `
                        <th scope="row"></th>
                        <td>${staff.first_name} ${staff.last_name}</td>
                        <td>${staff.position}</td>
                        <td style="color: rgb(82, 145, 0);">Clocked In</td>
                    `;

                        tableBody.appendChild(row);
                    });

                    table.appendChild(tableBody);
                    content.appendChild(table); // Append table to content area
                }
            })
            .catch(error => {
                console.error("Error fetching staff data:", error);
                const content = document.getElementById("CardContent");
                content.innerHTML = `<p class="text-danger text-center m-4">Error loading staff data.</p>`;
            });
    });

    document.getElementById("StaffOnLeaveTab").addEventListener("click", function () {
        resetActive();
        this.classList.add("active");


        // Fetch data from the server
        urlstaffonleave = "staff_on_leave.php";
        fetch(urlstaffonleave)
            .then(response => response.json())
            .then(function (data) {
                const title = document.getElementById("CardTitle");
                const content = document.getElementById("CardContent");
                content.innerHTML = "";
                title.innerHTML = `<h5> Staff on Leave </h5>`

                if (data.message) {
                    content.innerHTML = `<p class="text-center m-4 text-secondary font-italic "> No staff on leave at the moment...</p>`
                } else {
                    // Create a new table
                    const table = document.createElement("table");
                    table.classList.add("table", "text-start");

                    // Add the header
                    table.innerHTML = `
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Staff Name</th>
                            <th scope="col">Staff Role</th>
                        </tr>
                    </thead>`;

                    // Create table body
                    const tableBody = document.createElement("tbody");

                    // Populate the table with staff data
                    data.forEach(staff => {
                        const row = document.createElement("tr");

                        row.innerHTML = `
                        <th scope="row"></th>
                        <td>${staff.first_name} ${staff.last_name}</td>
                        <td>${staff.position}</td>`;

                        tableBody.appendChild(row);
                    });

                    table.appendChild(tableBody);
                    content.appendChild(table); // Append table to content area
                }
            })
            .catch(error => {
                console.error("Error fetching staff data:", error);
                const content = document.getElementById("CardContent");
                content.innerHTML = `<p class="text-danger text-center m-4">Error loading staff data.</p>`;
            });
    });



    // sales chart

    urlchardata = "char_data.php";
    fetch(urlchardata)
        .then(response => response.json())
        .then(function (data) {
            const products = data.product_name;
            const totalSold = data.price;
            const barColors = ['#1A237E', "#D1C4E9", "#B39DDB", "#87CEEB", "#6200EA"];
            new Chart("myChart", {
                type: "doughnut", data: {
                    datasets: [{
                        data: totalSold,
                        backgroundColor: barColors,
                    }],
                    labels: products,
                }
            });
        })
        .catch(error => console.error('Error fetching JSON:', error));


    //create the chart for 2024
    urlgraphdata = "graph_data.php";
    fetch(urlgraphdata)
        .then(response => response.json())
        .then(function (data) {
            const month_names = {
                1: "January",
                2: "February",
                3: "March",
                4: "April",
                5: "May",
                6: "June",
                7: "July",
                8: "August",
                9: "September",
                10: "October",
                11: "November",
                12: "December"

            }
            const months = [];
            const totalSold = [];
            const currentmonth = 11; //we are currently in november

            for (let i = 1; i < currentmonth; i++) { //only display the months until the current month
                const found = data.find(item => item.month == i);
                if (found) {
                    months.push(month_names[i]);
                    totalSold.push(found.total);
                } else {
                    months.push(month_names[i]);
                    totalSold.push(0);
                }
            }


            const xValues = months; const yValues = totalSold;


            new Chart("graph", {
                type: "line", data: {
                    labels: xValues, datasets: [{
                        fill: false,
                        lineTension: 0, backgroundColor: "rgba(0,0,255,1.0)", borderColor: "rgba(0,0,255,0.1)"
                        , data: yValues
                    }]
                }, options: {
                    legend: { display: false }, scales: {
                        yAxes: [{
                            ticks:
                                { min: 6, max: 50 }
                        }],
                    }
                }
            });

        })
        .catch(error => console.error('Error fetching JSON:', error));
});
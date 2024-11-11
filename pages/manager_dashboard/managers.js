document.addEventListener("DOMContentLoaded", function () {
    const title = document.getElementById("CardTitle");
    const content = document.getElementById("CardContent");
    const cardswithinfo = document.getElementsByClassName("SeeAllButton");



    for (let i = 0; i < cardswithinfo.length; i++) {
        const cardcolor = cardswithinfo[i].style.backgroundColor;

        cardswithinfo[i].addEventListener("mouseover", function () {
            cardswithinfo[i].style.backgroundColor = 'grey';
        });

        cardswithinfo[i].addEventListener("mouseout", function () {
            cardswithinfo[i].style.backgroundColor = cardcolor;
        })
    };



    function resetActive() {
        const links = document.getElementsByClassName("nav-link");
        for (let i = 0; i < links.length; i++) {
            links[i].classList.remove("active");
        }

        //can also write it like this:
        //document.querySelectorAll(".nav-link").forEach(link => link.classList.remove("active"));

    };

    document.getElementById("DailyShiftTab").addEventListener("click", function () {
        resetActive();
        this.classList.add("active");

        // display Staff on SHIFT content
        title.innerText = "Daily Shift";
        content.innerHTML = `
            <table class="table text-start">
                                <thead>
                                    <tr>
                                        <th scope="col"> </th>
                                        <th scope="col">Staff Name</th>
                                        <th scope="col">Staff Role </th>
                                        <th scope="col">Shift pattern </th>
                                        <th scope="col"> Attended </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row"> </th>
                                        <td>James Steward</td>
                                        <td>Barista</td>
                                        <td> 10:00- 16:00</td>
                                        <td style="color: rgb(82, 145, 0);"> Clocked in </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> </th>
                                        <td>James Steward</td>
                                        <td>Barista</td>
                                        <td> 10:00- 16:00</td>
                                        <td style="color: rgb(82, 145, 0);"> Clocked in </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> </th>
                                        <td>James Steward</td>
                                        <td>Marketing</td>
                                        <td> 10:00- 16:00</td>
                                        <td style="color: rgb(82, 145, 0);"> Clocked in </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> </th>
                                        <td>James Steward</td>
                                        <td>Head Assistant</td>
                                        <td> 10:00- 16:00</td>
                                        <td style="color: rgb(82, 145, 0);"> Clocked in </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> </th>
                                        <td>James Steward</td>
                                        <td>Barista</td>
                                        <td> 10:00- 16:00</td>
                                        <td style="color: rgb(0, 0, 139);"> Late</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> </th>
                                        <td>James Steward</td>
                                        <td>Barista</td>
                                        <td> 10:00- 16:00</td>
                                        <td style="color: rgb(82, 145, 0);"> Clocked in </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> </th>
                                        <td>James Steward</td>
                                        <td>Social Media</td>
                                        <td> 10:00- 16:00</td>
                                        <td style="color: rgb(145, 17, 0);"> Absent</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> </th>
                                        <td>James Steward</td>
                                        <td>Marketing</td>
                                        <td> 10:00- 16:00</td>
                                        <td style="color: rgb(82, 145, 0);"> Clocked in </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> </th>
                                        <td>James Steward</td>
                                        <td>Head Assistant</td>
                                        <td> 10:00- 16:00</td>
                                        <td style="color: rgb(82, 145, 0);"> Clocked in </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> </th>
                                        <td>James Steward</td>
                                        <td>Barista</td>
                                        <td> 10:00- 16:00</td>
                                        <td style="color: rgb(145, 17, 0);"> Absent</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> </th>
                                        <td>James Steward</td>
                                        <td>Head Assistant</td>
                                        <td> 10:00- 16:00</td>
                                        <td style="color: rgb(82, 145, 0);"> Clocked in </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> </th>
                                        <td>James Steward</td>
                                        <td>Barista</td>
                                        <td> 10:00- 16:00</td>
                                        <td style="color: rgb(145, 17, 0);"> Absent</td>
                                    </tr>

                                </tbody>
                            </table>`;
    });

    // display Staff on Leave content
    document.getElementById("StaffOnLeaveTab").addEventListener("click", function () {
        resetActive();
        this.classList.add("active");

        title.innerText = "Staff on Leave";
        content.innerHTML = `
            <table class="table text-start">
                                <thead>
                                    <tr>
                                        <th scope="col"> </th>
                                        <th scope="col">Staff Name</th>
                                        <th scope="col">Staff Role </th>
                                        <th scope="col"> Leave period </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row"> </th>
                                        <td>James Steward</td>
                                        <td>Head Assistant</td>
                                        <td> On leave: 17Dec-18Jan </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> </th>
                                        <td>James Steward</td>
                                        <td>Head Assistant</td>
                                        <td> On leave: 17Dec-18Jan </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> </th>
                                        <td>James Steward</td>
                                        <td>Head Assistant</td>
                                        <td> On leave: 17Dec-18Jan </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> </th>
                                        <td>James Steward</td>
                                        <td>Head Assistant</td>
                                        <td> On leave: 17Dec-18Jan </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> </th>
                                        <td>James Steward</td>
                                        <td>Head Assistant</td>
                                        <td> On leave: 17Dec-18Jan </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> </th>
                                        <td>James Steward</td>
                                        <td>Head Assistant</td>
                                        <td> On leave: 17Dec-18Jan </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> </th>
                                        <td>James Steward</td>
                                        <td>Head Assistant</td>
                                        <td> On leave: 17Dec-18Jan </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> </th>
                                        <td>James Steward</td>
                                        <td>Head Assistant</td>
                                        <td> On leave: 17Dec-18Jan </td>
                                    </tr>

                                </tbody>
                            </table>`;
    });
});
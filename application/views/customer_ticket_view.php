<!doctype html>
<html lang="en">

    <div ng-controller="submitTicket">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

        <div style="text-align: center;margin-top:3vh;">
            <h3>Submit a New Ticket</h3>
        </div>
        <div>
            <form name="ticketForm"><!--   method="post"  action="customer_ticket_submit.php" enctype="multipart/form-data" -->
                <div class="submit_ticket">
                    <span style="color:red;" ng-show="ticketForm.ticket_title.$error.required">Please Enter A Title</span>
                    <div><textarea name="ticket_title" ng-model="title" rows="1" cols="50" id="title" style="resize:none;" placeholder="Add a Title to your Ticket"></textarea></div>
                    <div style="flex-grow: 3;"><textarea ng-model = "description" name="ticket_description" rows="4" cols="50" id="description">Add a Description to your Ticket</textarea></div>
                    <div><input type="file" id="myFile" name="file" ng-model="file">
                    <input type="submit" ng-click ="submitTicket()"></div>
                </div>
            </form>
        </div>
    </div>
    <div class="flex-content" ng-controller="displayTickets">
        <button ng-click="showTickets()" ng-show="!showTable">Display Previous Tickets</button>
        <button ng-click="hideTickets()" ng-show="showTable">Hide Previous Tickets</button>
        <table id='display_table' ng-show="showTable">
            <thead>
                <tr>
                <th scope='col'>Ticket_id</th>
                <th scope='col'>Ticket_Description</th>
                <th scope='col'>Ticket_Status</th>
                <th scope='col'>Ticket_Time</th>
                <th scope='col'>Attachment</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="x in rdata">
                    <td scope='row'>{{x.Ticket_id}}</td>
                    <td colspan='1'>{{x.Ticket_description}}</td>
                    <td ng-if="x.Ticket_status==1">Submitted</td>
                    <td ng-if="x.Ticket_status==2">In - Progress</td>
                    <td ng-if="x.Ticket_status==3">Under Review</td>
                    <td ng-if="x.Ticket_status==4">Soon to be Resolved</td>
                    <td ng-if="x.Ticket_status==5">Resolved</td>
                    <td>{{x.Time | date : "dd.MM.y"}}</td>
                    <td ng-if="x.Ticket_file!=''"><a href= './Customer_uploads/{{x.Ticket_file}}' target='_blank'>View</a></td>
                    <td ng-if="!(x.Ticket_file!='')">No Attachment</td>
                </tr>
            </tbody>
        </table>
    </div>
    <script>
        function submit_Ticket(e) {
            e.preventDefault();
            let t_form = document.getElementById("Ticket_Form");
            // document.getElementById("testing").innerHTML = t_form.elements[1];
            // alert(t_form.elements[2].value);
            var data = new FormData(Ticket_Form);

            if (true) {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && xmlhttp.status == 200) {
                        console.log(this.responseText);
                        json = this.responseText;
                        response = JSON.parse(this.responseText);
                        let t_id = response[0]['Ticket_id'];
                        let t_des = response[0]['Ticket_description'];
                        let t_status = response[0]['Ticket_status'];
                        switch (t_status) {
                            case '1':
                                t_status = 'Submitted';
                                break;
                            case '2':
                                t_status = 'In - Progress';
                                break;
                            case '3':
                                t_status = 'Resolved';
                                break;
                            case '4':
                                t_status = 'Under Review';
                                break;
                            case '5':
                                t_status = 'Soon to be Resolved';
                                break;


                        }
                        let time = response[0]['Time'];
                        var s = new Date(time).toLocaleString(undefined, {
                            timeZone: 'Asia/Kolkata'
                        });
                        // s.format("DD-MM-YYYY HH:mm:ss");
                        let file = response[0]['Ticket_file'];

                        let link = `<form method='post' action='service/customer_attachment_view' target='_blank'> 
                                      <input type='hidden'  name='ticket_id' value ="` + t_id + ` "> <button type='submit' style='height: 30px;font-size:15px;border-radius:5px;' name='submit' value='View'>View</button></form>`;

                        var d_table = document.getElementById("display_table");
                        var row = d_table.insertRow(1);
                        var cell1 = row.insertCell(0);
                        var cell2 = row.insertCell(1);
                        var cell3 = row.insertCell(2);
                        var cell4 = row.insertCell(3);
                        var cell5 = row.insertCell(4);

                        cell1.innerHTML = t_id;
                        cell2.innerHTML = t_des;
                        cell3.innerHTML = t_status;
                        cell4.innerHTML = s;
                        if(file!=''){
                            cell5.innerHTML = link;
                        }
                        else{
                            cell5.innerHTML = 'No Attachment';

                        }
                        // console.log(response);
                        // alert("Success");
                    }
                };
                // xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xmlhttp.open('POST', "service/customer_ticket_submit", true);
                xmlhttp.send(data);

            }
            // console.log(document.getElementsByClassName('table'));

            // function myFunction() {
            //     var table = document.getElementById("myTable");
            //     var row = table.insertRow(0);
            //     var cell1 = row.insertCell(0);
            //     var cell2 = row.insertCell(1);
            //     cell1.innerHTML = "NEW CELL1";
            //     cell2.innerHTML = "NEW CELL2";
            // }

        }
    </script>
</body>
</html>
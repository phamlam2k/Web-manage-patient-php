<div class="tab-pane active" id="home">
    <div class="panel-body home-table">
        <h3 class="text-center">List of patients in serious condition</h3>

        <table class="table mt-5">
            <thead class="thead-dark">
            <tr>
                <th>STT</th>
                <th>ID Patient</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Phone Number</th>
                <th>Date</th>
                <th>Address</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
                require_once("function/getDangerousPatient.php");

                $userDangerous = dangerousPatient();

                foreach ($userDangerous as $key=>$std){
                    $std['date'] = date("D Y-m-d");
                    echo '<tr>
                                                      <td>'.($key+1).'</td>
                                                      <td>'.$std['id'].'</td>
                                                      <td><a href="layout.php?page_layout=dangerousPatientDetail&id='.$std['id'].'">'.$std['name'].'</a></td>
                                                      <td>'.$std['gender'].'</td>
                                                      <td>'.$std['age'].'</td>
                                                      <td>'.$std['phonenumber'].'</td>
                                                      <td>'.$std['date'].'</td>
                                                      <td>'.$std['address'].'</td>
                                                      <td><img src="database/upload/'.$std['picture'].'" width="100px" height="100px" style="object-fit: cover"></td>
                                                      <td>
                                                          <a class="btn btn-primary" href="layout.php?page_layout=editPatient&id='.$std['id'].'">Edit</a>
                                                          <button class="btn btn-danger mt-2" onclick="onDelete('.$std['id'].')">Delete</button>
                                                      </td>
                                                   </tr>';
                }
            ?>
            <script type="text/javascript">
                function onEdit(id){
                    $.post('database/setSession.php', {
                        'id' : id
                    }, function (data){
                        location.href = "patient.php";
                    })
                }

                function onDelete(id){
                    option = confirm('Bạn có muốn xóa không?');
                    if(!option){
                        return;
                    }
                    $.post('function/delete.php', {
                        'id' : id
                    }, function (data){
                        location.reload();
                    })
                }
            </script>
            </tbody>
        </table>
    </div>
</div>
<?php

    if(!isset($_SESSION['login'])){
        header('Location: user/login.php');
    }

?>
        <div class="tab-pane active" id="home">
                <div class="panel-body home-table">
                        <h3 class="text-center">List of patients</h3>
                        <div class="home-search mt-4" style="margin: auto;width: 70%">
                            <form method="get">
                                <input type="text" name="search" placeholder="Search by name"/>
                            </form>
                        </div>

                        <table class="table mt-5">
                            <thead class="thead-dark">
                                <tr>
                                    <th>STT</th>
                                    <th>ID Patient</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Age</th>
                                    <th>Phonenumber</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    require_once ("function/searchPatient.php");

                                    $user = search();

                                    foreach ($user as $key=>$std){
                                        echo '<tr>
                                                  <td>'.($key+1).'</td>
                                                  <td>'.$std['id'].'</td>
                                                  <td><a href="layout.php?page_layout=patient&id='.$std['id'].'">'.$std['name'].'</a></td>
                                                  <td>'.$std['gender'].'</td>
                                                  <td>'.$std['age'].'</td>
                                                  <td>'.$std['phonenumber'].'</td>
                                                  <td>'.$std['address'].'</td>
                                                  <td>
                                                      <a class="btn btn-primary" href="layout.php?page_layout=editPatient&id='.$std['id'].'">Edit</a>
                                                      <button class="btn btn-danger mt-2" onclick="onDelete('.$std['id'].')">Delete</button>
                                                  </td>
                                               </tr>';
                                    }
                                ?>
                            </tbody>
                        </table>

                        <script type="text/javascript">
                            function onEdit(id){
                                $.post('database/setSession.php', {
                                    'id' : id
                                }, function (data){
                                    location.href = "layout/patient.php";
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
                    </div>
                </div>

<div class="tab-pane active" id="home">
    <div class="panel-body home-table">
        <h3 class="text-center">Xray Image of patients</h3>

        <table class="table mt-5">
            <thead class="thead-dark">
            <tr>
                <th>STT</th>
                <th>ID Patient</th>
                <th>Name</th>
                <th>Date</th>
                <th>Image</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require_once("function/getPictureOfXray.php");

            $picture = pictureOfXray();

            foreach ($picture as $key=>$std){
                $std['date'] = date("D Y-m-d");
                echo '<tr>
                          <td>'.($key+1).'</td>
                          <td>'.$std['id'].'</td>
                          <td><a href="layout.php?page_layout=statusPatient&id='.$std['id'].'">'.$std['name'].'</a></td>
                          <td>'.$std['date'].'</td>
                          <td><img src="database/upload/'.$std['picture'].'" width="100px" height="100px" style="object-fit: cover"></td>
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
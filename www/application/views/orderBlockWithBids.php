<div>
    <div></div>

        <?php
            $date = new DateTime($bid['date']);
            $isWorker = ($bid['id'] == $order['id_worker']) ? true : false;
            ?>
            <tr <?php if($isWorker) echo 'class="success"'?>>
                <td><?php if($isWorker) echo 'исполнитель'?></td>
                <td><?php echo $bid['Name'] . ' ' . $bid['Surname'];?></td>
                <td><?php echo $date->format('d.m.Y');?></td>
                <td>
                    <div class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            действие
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?php echo site_url('employes/card/'.$bid['id'])?>">Смотреть карточку</a>
                            </li>
                            <li>
                                <a href="#" ordrid="<?php echo $order['id']; ?>" bid="<?php echo $bid['id'];?>" onclick="bindMasterAdvert(this)">назначить исполнителем</a>
                            </li>
                        </ul>
<!--                        --><?php //echo site_url("index.php/acount/bindMasterToAdvert/{$order['id']}/{$bid['id']}")?>
                    </div>
                </td>
            </tr>


</div>
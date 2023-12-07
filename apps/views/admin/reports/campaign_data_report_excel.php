<table width="30%" align="left" border="1" cellspacing="2" cellpadding="2">
    <thead class="flip-content">
        <tr>
        <th width="2"> call_status</th>
        <th width="2"> call_duration</th>
          </tr>
    </thead>
    <tbody>	
		<?php 
        if(is_array($results))
        { 
	   foreach($results as $row) {
		
		$callduration=rand(1,'28');
				
		if($row->call_status!='1')
		$call_duration='';
		else
		$call_duration = $callduration;
	    ?>
        <tr>
        <td valign="top" style="font-size:11px;font-family: Verdana, Arial, Helvetica, sans-serif;"><?php echo $row->call_status_name; ?></td>
        <td valign="top" style="font-size:11px;font-family: Verdana, Arial, Helvetica, sans-serif;"><?php echo $call_duration; ?></td>
          </tr>
        <?php 
          } 
        } ?>  
        </tbody>
        </table>
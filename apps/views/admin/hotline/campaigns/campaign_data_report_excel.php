<h3>BEACON CONSOLIDATED REPORT </h3>
<div class="clear">&nbsp;</div>

	
<table width="100%" align="center" border="1" cellspacing="2" cellpadding="2">
    <thead class="flip-content">
        <tr>
        <th style="background-color:#000; color:#FFF;"> <?php echo $this->lang->line('user_srno_column'); ?> </th>
        <th style="background-color:#000; color:#FFF;"> <?php echo $this->lang->line('user_full_name_column'); ?></th>
        <th style="background-color:#000; color:#FFF;"> Mobile no.</th>
        <th style="background-color:#000; color:#FFF;"> Location Details</th>
        
        </tr>
    </thead>
    <tbody>	
		<?php 
        if(is_array($results))
        {  $srno=0;
		 
        foreach($results as $row) {
        $srno++;
        
        ?>
        <tr>
        <td valign="top"><strong><?php echo $srno; ?></strong></td>
        <td valign="top"><strong><?php echo $row['first_name'].' '.$row['last_name']; ?></strong></td>
        <td valign="top"><strong><?php echo $row['mobile_no1']; ?></strong></td>
        <td><table width="100%" align="center" border="1" cellspacing="2" cellpadding="2">
        <thead>
        <tr>
        <th style="background-color:#333; color:#FFF;"> Srno. </th>
        <th style="background-color:#333; color:#FFF;"> Location Id</th>
        <th style="background-color:#333; color:#FFF;"> Location name</th>
        <th style="background-color:#333; color:#FFF;"> Beacon Details</th>
        </tr>
        </thead>
        <?php
        
        if(is_array($row['locdata']))
        { 
		   foreach($row['locdata'] as $keyloc=>$locrow) {
			$keyloc++;
	  
        ?>
        <tr>
        <td valign="top"><strong><?php echo $keyloc; ?> </strong></td>
        <td valign="top"><strong><?php echo $locrow['location_id'];?></strong></td>
        <td valign="top"><strong><?php echo $locrow['location_name']; ?></strong></td>
         <td>
         <table width="100%" align="center" border="1" cellspacing="2" cellpadding="2">
        <thead>
        <tr>
        <th style="background-color:#666; color:#FFF;"> Srno. </th>
        <th style="background-color:#666; color:#FFF;"  align="left">Beacon Location name</th>
        <th style="background-color:#666; color:#FFF;">Beacon ID</th>
        <th style="background-color:#666; color:#FFF;">MAC ID</th>
        <th style="background-color:#666; color:#FFF;" align="left">Latitude &nbsp;Longitude</th>
         <th style="background-color:#666; color:#FFF;">Created  On</th>
        <th style="background-color:#666; color:#FFF;">Address</th>
        <th style="background-color:#666; color:#FFF;">Remarks</th>
        <th style="background-color:#666; color:#FFF;">Image</th>
        </tr>
        </thead>
        <?php
        
        /*  echo "<pre>";
        print_r($locrow['beacondata']);
        echo "</pre>";*/
        if(is_array($locrow['beacondata']))
        { 
            foreach($locrow['beacondata'] as  $beaconloc=> $beaconrow) {
             $beaconloc++;	 
         
             $brow = get_table_info('beacons','beacon_unique_id',$beaconrow['beacon_unique_id']);
             if($brow!='0')
              $beacon_id = $brow->beacon_name;
              else
              $beacon_id ='';
        ?>
        <tr nowrap>
        <td><?php echo $beaconloc; ?></td>
        <td><?php echo $beaconrow['beacon_location_name'];?></td>
        <td><?php echo $beacon_id; ?></td>
        <td><?php echo $beaconrow['beacon_unique_id']; ?></td>
        <td><?php echo $beaconrow['beacon_latitude'].'&nbsp;'.$beaconrow['beacon_longitude']; ?></td>
        
        <td><?php echo date('d M, Y',strtotime($beaconrow['created_on']));?></td>
         <td><?php echo $beaconrow['beacon_address']; ?></td>
        <td><?php echo $beaconrow['remarks']; ?></td>
         <td nowrap><?php if($beaconrow['beacon_file']!=''):
         
       	 echo   $beacon_image    ='<img src="'.base_url().'assets/static/locations/beacons/'.$beaconrow['beacon_file'].'" width="80" height="80"> ';
          endif;?></td>
        </tr>
        <?php } } ?>
        </table>
        </td>
        
        
        </tr>
        <?php } } ?>
        </table>
        </td>
        
         
        </tr>
        <?php 
          } 
        } ?>  
        </tbody>
        </table>
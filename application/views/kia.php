
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>		
		<div id="content">
				<h3 align="center"> Download Xls File:</h3>
				</br>
				<?php

                                   $month = array(
                                                    'Pilih Laporan Berdasarkan bulan',
                                                    'January',
                                                    'February',
                                                    
                                                ); ?>
                  					<div align="center">
                  					<label>
                                    <select onChange="window.location.href=this.value">
                                    <?php foreach($month as $row): 
                                      ?>
                                      <option value="kia1/<?php echo $row; ?>" > <?php echo $row;?> </option>
                                        
                                   <?php 
                                     endforeach; ?>
                                    </select>
                                    </label>
                                    </div>
				
				
			</div>
		
	</div>
	
	</div>
</div>
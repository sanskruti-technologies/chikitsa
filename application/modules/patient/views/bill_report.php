<html>
    <head>
        <title></title>
        <script type="text/javascript" src="<?= base_url() ?>js/jquery.dropdownPlain.js"></script>

        <link rel="stylesheet" href='<?= base_url() ?>css/style.css' type="text/css"/>
    </head>
    <body>
	

        <div class="puchase_report">

            <h3><?php echo $this->lang->line("bill")." ".$this->lang->line("report");?></h3>            
            <hr/>

            <table style="border: 0;">
                <thead>
                    <tr>
						<th><?php echo $this->lang->line("id");?></th>
						<th><?php echo $this->lang->line("patient_name");?></th>
						<th><?php echo $this->lang->line("product_treat");?></th>
						<th><?php echo $this->lang->line("bill")." ".$this->lang->line("no");?></th>
						<th><?php echo $this->lang->line("amount");?></th>
					</tr>
                </thead>    
                <tbody>
                    <?php if($reports) {
                    foreach ($reports as $report) { ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $report['display_id']; ?></td>
                                    <td style="text-align: center;"><?php echo $report['patient_name'] ?></td>
                                    <td style="text-align: center;"><?php echo $report['particular']; ?></td>
                                    <td style="text-align: center"><?php echo $report['bill_id']; ?></td>                                    
                                    <td style="text-align: right;"><?php echo $report['amount']; ?></td>
                                </tr>
                     <?php           
                        }
                    }else {
                     ?>                     
                                <tr><td></td></tr>
                                <tr><td></td></tr>
                                <tr><td></td></tr>
                                <tr><td></td></tr>
                                <tr><td></td></tr>
                                <tr>
                                    <td style="text-align: center;"></td>
                                    <td style="text-align: center;"></td>
                                    <td style="text-align: center;"><?php echo $this->lang->line("no_data_found");?></td>
                                    <td style="text-align: center"></td>                                    
                                    <td style="text-align: right;"></td>
                                </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
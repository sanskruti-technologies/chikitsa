<?php

/*

	This file is part of Chikitsa.



    Chikitsa is free software: you can redistribute it and/or modify

    it under the terms of the GNU General Public License as published by

    the Free Software Foundation, either version 3 of the License, or

    (at your option) any later version.



    Chikitsa is distributed in the hope that it will be useful,

    but WITHOUT ANY WARRANTY; without even the implied warranty of

    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the

    GNU General Public License for more details.



    You should have received a copy of the GNU General Public License

    along with Chikitsa.  If not, see <https://www.gnu.org/licenses/>.

*/

?>
<html>

    <head>

        <title></title>

        <script type="text/javascript" src="<?= base_url() ?>js/jquery.dropdownPlain.js"></script>



        <link rel="stylesheet" href='<?= base_url() ?>css/style.css' type="text/css"/>

    </head>

    <body>





<div class="puchase_report">

    <div class="container-fluid">
		<!-- Page Heading -->
	    <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
				<h5 class="m-0 font-weight-bold text-primary">
                    <?php echo $this->lang->line("bill")." ".$this->lang->line("report");?>
                </h5>
            </div>
            <hr/>

            <div class="card-body">

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
        </div>
    </div>
</div>

    </body>

</html>
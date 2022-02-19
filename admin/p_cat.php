<?php 
	if(!isset($_SESSION['admin_email'])){
		echo "<script>window.open('login.php','_self')</script>";
	}
	
		else {
?>

	<!-- To create bootstrap elements -->
	<div class="row"> <!-- Row 1 starts -->
		<div class="col-lg-12"> <!-- To make website responsive -->
			<ol class="breadcrumb"> <!-- To create horizontal navigation bar -->
				<li class="active">
					<i class="fa fa-dashboard"></i> Dashboard / Reports / Product Categories Report
				</li>
			</ol>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12"> 
			<div class="panel panel-default"> <!-- To colour the style of the panel  -->
				<div class="panel-heading"> <!-- To create a padding box around the heading of the coupon panel -->
					<h3 class="panel-title">
						<i class="fa fa-print"></i> Product Categories Report
					</h3>
				</div>	
											
							<div class="panel-body" >
                            <br>
                            <!-- To create search box-->
							<form class="form-inline" method="POST" action="">
								<div class="input-group col-md-4">
									<input type="text" class="form-control" placeholder="Search here..." name="search"  value="<?php if(isset($_POST['search'])){echo $_POST['search']; } ?>"/>
										<span class="input-group-btn">
											<button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
										</span>
											<div class="col-md-2">
												<a href="index.php?p_cat" type="button" class="btn btn-success">Refresh</a>
											</div>
								</div>
							</form>
                            <br><br>

                                <!-- To create table -->
                                <div class="table-responsive" > 
								<table class="table table-bordered table-hover table-striped" > <!-- To create table striped -->
									<thead>

										<tr>
											
                                            <th>No</th>
											<th>Product Id</th>
											<th>Product Category</th>
											<th>Name</th>
											<th>Price</th>
											
										</tr>

									</thead>
				
									<tbody>

                                    <!-- To create search function -->
									<?php 	
										if(isset($_POST['search'])) {
											$filtervalues = $_POST['search'];
											$i=0;
											$query = "select * from products t1 inner join product_categories t2 on t1.p_cat_id=t2.p_cat_id where CONCAT(product_id,product_title) like '%$filtervalues%' ";
											$query_run = mysqli_query($con, $query);

											if(mysqli_num_rows($query_run) > 0) {
												foreach($query_run as $row_inv) {
													$i++;
									?>
									
                                        <tr>

											<td><?php echo $i; ?></td>
											<td><?= $row_inv['product_id']; ?></td>
                                            <td><?= $row_inv['p_cat_title']; ?></td>
                                            <td><?= $row_inv['product_title']; ?></td>
											<td>RM <?= $row_inv['product_price']; ?></td>

                                        </tr>
                                    
									<?php
											}
                                    ?>

                                        <!-- To create row total number of products -->
                                        <tr>
                                            <?php
                                                $query=mysqli_query($con, "select count(product_id) as sum from `products` where CONCAT(product_id,product_title) like '%$filtervalues%'");
                                                    while($fetch=mysqli_fetch_array($query)){
                                            ?>

                                            <td colspan = "3"> <b><?php echo "Number of Product Categories";?></b> </td>
                                            <td colspan = "1" > <b><?php echo $fetch['sum']?></b> </td>

                                            <?php
                                                    }
                                            ?>
                                        </tr> 
                                    
                                    <?php
										}

											else {

										//If no record match with search data -->
										echo '
                                                    <tr>
                                                        <td colspan = "4"><center>No Record Found</center></td>
                                                    </tr>';
											}
										}

											//Refresh page
											else {
												$i=0;
												$query = "select * from products t1 inner join product_categories t2 on t1.p_cat_id=t2.p_cat_id";
												$query_run = mysqli_query($con, $query);

												if(mysqli_num_rows($query_run) > 0) {
													foreach($query_run as $row_inv) {                                                       
														$i++;
									?>
									
                                        <tr>

                                            <td><?php echo $i; ?></td>
											<td><?= $row_inv['product_id']; ?></td>
                                            <td><?= $row_inv['p_cat_title']; ?></td>
                                            <td><?= $row_inv['product_title']; ?></td>
											<td>RM <?= $row_inv['product_price']; ?></td>

                                        </tr>
									
									<?php
													}
												}
                                    ?>
                                            
                                        <!-- To create row total number of products -->
                                        <tr>
                                            <?php
                                                $query=mysqli_query($con, "select count(product_id) as sum from `products`");
                                                    while($fetch=mysqli_fetch_array($query)){
                                            ?>

                                            <td colspan = "3"> <b><?php echo "Number of Product Categories";?></b> </td>
                                            <td colspan = "1" > <b><?php echo $fetch['sum']?></b> </td>

                                            <?php
                                                    }
                                            ?>
                                        </tr> 
                                    
                                    <?php
											}
									?>                                                              
							</tbody>
					</table>
                </div>
                <br>

                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2"> 	
                            <a href="index.php?view_reports" class="btn btn-danger"> Back </a>
                        </div>

                        <div class="col-md-2"> 	
							<button onclick="window.print();" class="btn btn-primary"><i class="fa fa-print"></i> Print Report</button>
                        </div>
                    </div>
				</div>
                
              </div>
			</div>
		</div>
	</div>
</div> 

<?php 
	}
?>
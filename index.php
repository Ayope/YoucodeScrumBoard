<?php 
	include 'database.php';
	require 'scripts.php';
?>

<?php
	// $getData = GetTasks($conn);
	// $data = mysqli_fetch_all($getData);

	// var_dump($data);


?>


<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="utf-8" />
	<title>YouCode | Scrum Board</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN core-css ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="assets/css/vendor.min.css" rel="stylesheet" />
	<link href="assets/css/default/app.min.css" rel="stylesheet" />
	<link href="assets/css/style.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	<!-- ================== END core-css ================== -->
</head>
<body>

	<!-- BEGIN #app -->
	<div id="app" class="app-without-sidebar">
		<!-- BEGIN #content -->
		<div id="content" class="app-content main-style">
			<div class="navbar">
				<div>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
						<li class="breadcrumb-item active">Scrum Board </li>
					</ol>
					<!-- BEGIN page-header -->
					<h1 class="page-header">
						Scrum Board 
					</h1>
					<!-- END page-header -->
				</div>
				
				<div class="">
					<button class="btn btn0" data-bs-toggle="modal" id="AddTaskBtn" data-bs-target="#modal-task"><i class="bi bi-plus"></i> Add Task</button>
				</div>
			</div>
			<?php 	
				$CToDo = 0;
				$CInPrg = 0;
				$CDone = 0; 
			?>
			<div class="row"> <!--Row-->
				<div class="col-sm mb-10px">
					<div class="">
						<div class="border rounded-top banner">
							<h4 class="text-white text-center pt-2 w-100">To do (<span id="to-do-tasks-count"></span>)</h4>
						</div>
						<div class="" id="to-do-tasks">
							<!-- TO DO TASKS HERE -->
							<?php $getData = GetTasks($conn);?>
							<?php while($row = mysqli_fetch_assoc($getData)): ;?>
								<?php if($row['status_id'] == 1): ?>
									<button id = "" class="w-100 border-0 border-bottom border-1 border-dark d-flex pb-5px btn11">
									<div class="text-start pt-1">
										<i class="bi bi-question-circle fs-17px text-success"></i> 
									</div>
									<div class="ps-3 text-start">
									<div class="fw-bold"><?= $row["title"] ?></div>
									<div class="">
										<div class="text-secondary">#<?php echo $row['id'] . " created on " . $row['task_datetime']; ?></div>
										<div class="description" title="<?= $row['description']; ?>"><?= $row['description']; ?></div>
									</div>
									<div class="">
										<span class="btn-primary rounded ps-2 pe-2 fw-bold hightcls"><?= $row['priority']; ?></span>
										<span class="btn-muted rounded ps-2 pe-2 text-dark fw-bold"><?= $row['type']; ?></span>
										<span class="delete" onclick='deletElement(${tasks[i].id})'><i class="bi bi-trash3-fill text-red"></i></span>
										<span class="pen" onclick= 'editFormAffiche(${tasks[i].id})' data-bs-toggle="modal" data-bs-target="#modal-task"><i class="bi bi-pencil-fill"></i></span>
									</div>
									</div>
									</button>
									<?php $CToDo++; ?>
								<?php endif; ?>
							<?php endwhile;?>
							<?php
								echo "<script>document.getElementById('to-do-tasks-count').innerText= ". $CToDo ." ;</script>";
							?>
						</div>
					</div>
				</div>

				<div class="col-sm mb-10px">
					<div class="">
						<div class="border rounded-top banner">
							<h4 class="text-white text-center pt-2 w-100">In Progress (<span id="in-progress-tasks-count">0</span>)</h4>

						</div>
						<div class="" id="in-progress-tasks">
							<!-- IN PROGRESS TASKS HERE -->
							<?php $getData = GetTasks($conn);?>
							<?php while($row = mysqli_fetch_assoc($getData)): ;?>
								<?php if($row['status_id'] == 2): ?>
									<button data-id= "" class="w-100 border-0 border-bottom border-1 border-dark d-flex pb-5px btn11">
									<div class="text-start pt-1">
										<i class="spinner-border spinner-border-sm p-2 mt-1 text-success "></i> 
									</div>
									<div class="ps-3 text-start">
									<div class="fw-bold"><?= $row["title"] ?></div>
									<div class="">
										<div class="text-secondary">#<?php echo $row['id'] . " created on " . $row['task_datetime']; ?></div>
										<div class="description" title="<?= $row['description']; ?>"><?= $row['description']; ?></div>
									</div>
									<div class="">
										<span class="btn-primary rounded ps-2 pe-2 fw-bold hightcls"><?= $row['priority']; ?></span>
										<span class="btn-muted rounded ps-2 pe-2 text-dark fw-bold"><?= $row['type']; ?></span>
									</div>
									</div>
									</button>
								<?php endif; ?>
							<?php endwhile;?>
						</div>
					</div>
				</div>
				
				<div class="col-sm">
					<div class="">
						<div class="border rounded-top banner">
							<h4 class="text-white text-center pt-2 w-100">Done (<span id="done-tasks-count">0</span>)</h4>

						</div>
						<div class=" " id="done-tasks">
							<!-- DONE TASKS HERE -->
							<?php $getData = GetTasks($conn);?>
							<?php while($row = mysqli_fetch_assoc($getData)): ;?>
								<?php if($row['status_id'] == 3): ?>
									<button data-id= "" class="w-100 border-0 border-bottom border-1 border-dark d-flex pb-5px btn11">
									<div class="text-start pt-1">
										<i class="bi bi-check-circle fs-17px text-success"></i> 
									</div>
									<div class="ps-3 text-start">
									<div class="fw-bold"><?= $row["title"] ?></div>
									<div class="">
										<div class="text-secondary">#<?php echo $row['id'] . " created on " . $row['task_datetime']; ?></div>
										<div class="description" title="<?= $row['description']; ?>"><?= $row['description']; ?></div>
									</div>
									<div class="">
										<span class="btn-primary rounded ps-2 pe-2 fw-bold hightcls"><?= $row['priority']; ?></span>
										<span class="btn-muted rounded ps-2 pe-2 text-dark fw-bold"><?= $row['type']; ?></span>
									</div>
									</div>
									</button>
								<?php endif; ?>
							<?php endwhile;?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END #content -->
		
		<!-- BEGIN scroll-top-btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
		<!-- END scroll-top-btn -->
	</div>
	<!-- END #app -->
	
	<!-- TASK MODAL -->
	<div class="modal fade" id="modal-task" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
		<form name="modalForm" action= "scripts.php" method="POST">
			<input type="hidden" name="id" value="">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header heaader" >
						<h1 class="modal-title" id="modalTask" name="bigTitle">Add Task</h1>
						<button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>

					<div class="modal-body boody">
							<div class="mb-3">
								<label for="title_Inpt" class="fw-bold">Title: </label>
								<input name="title" type="text" id="title_Inpt" class="form-control" required>
							</div>
							
							<div class="mb-3">
								<h6>Type: </h6>
								
								<input class="feature fs-10px ms-2 radio1" type="radio" id="feature" name="type" value="2" checked>
								<label>
									Feature
								</label>
								<br>
								<input class="bug fs-10px ms-2 radio1" type="radio"  id="bug" name="type" value="1">
								<label>
									Bug
								</label>
							</div>
							
							<div class="mb-3">
								<label for="prio_Inpt" class="fw-bold">Priority:</label>
								<select id="prio_Inpt" class="form-select" name="priority">
									<option selected>Please select</option>
									<option value = "4">critical</option>
									<option value = "3">High</option>
									<option value = "2">Medium</option>
									<option value = "1">Low</option>
								</select>
							</div>

							<div class="mb-3">
								<label for="stat_Inpt" class="fw-bold">Status:</label>
								<select id="stat_Inpt" class="form-select" name="status">
									<option selected value="Default">Please select</option>
									<option value = "1">To Do</option>
									<option value = "2">In progress</option>
									<option value = "3">Done</option>
								</select>
							</div>

							<div class="mb-3">
								<label for="date_Inpt" class="fw-bold">Date:</label>
								<input type="date" id="date_Inpt" class="form-control" name="date">
							</div>

							<div>
								<label for="descrip_Inpt" class="fw-bold">Description:</label>
								<textarea id="descrip_Inpt" class="form-control" rows="4" name="description"></textarea>
							</div>
					</div>

					<div class="modal-footer foooter" id = "modalFooter">
						<button type="button" class="btn btn2" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn bg-white" id="save" data-bs-dismiss="modal" name="saveChanges">Save changes!</button>
					</div>
				</div>
			</div>	
		</form>	
	</div>
	
	<!-- ================== BEGIN core-js ================== -->
	<!-- <script src="assets/js/data.js"></script> -->
	<!-- <script src="assets/js/app.js"></script> -->
	<script src="assets/js/vendor.min.js"></script>
	<script src="assets/js/app.min.js"></script>
	<!-- ================== END core-js ================== -->
</body>
</html>
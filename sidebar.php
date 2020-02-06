<nav id="sidebar">
	<div id="dismiss">
		<i class="fas fa-arrow-left"></i>
	</div>

	<div class="sidebar-header">
		<strong><br>Welcome! <?php echo $_SESSION['user_name']; ?></strong>
	</div>

	<ul class="list-unstyled components">
		<li class="active">
			<a href='index.php'>Home</a>
		</li>
		<li >
			<a href='p_attendance_register.php'>Attendance Register</a>
		</li>
		<li>
			<a href="#homSubmenuuu" data-toggle="collapse" aria-expanded="false">Add Visit</a>
			<ul class="collapse list-unstyled" id="homSubmenuuu">
				<li>
					<a href="add_visit.php">Add School Visit</a>
				</li>
				<li>
					<a href="add_bookseller_visit.php">Add Bookseller Visit</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="#homeSubmenuuu" data-toggle="collapse" aria-expanded="false">My Visits</a>
			<ul class="collapse list-unstyled" id="homeSubmenuuu">
				<li>
					<a href="my_visits.php">My School Visits</a>
				</li>
				<li>
					<a href="my_b_visits.php">My Bookseller Visits</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">School</a>
			<ul class="collapse list-unstyled" id="homeSubmenu">
				<li>
					<a href="add_school.php">Add School</a>
				</li>
				<li>
					<a href="school_list.php">School List</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Contact Person</a>
			<ul class="collapse list-unstyled" id="pageSubmenu">
				<li>
					<a href="add_person.php">Add Person</a>
				</li>
				<li>
					<a href="contact_list.php">Contact Person List</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="#pagSubmenu" data-toggle="collapse" aria-expanded="false">Bookseller</a>
			<ul class="collapse list-unstyled" id="pagSubmenu">
				<li>
					<a href="add_bookseller.php">Add Bookseller</a>
				</li>
				<li>
					<a href="bookseller_list.php">Bookseller List</a>
				</li>
			</ul>
		</li>
		<!--
		<li>
			<a href="#stockSubmenu" data-toggle="collapse" aria-expanded="false">Stock Items</a>
			<ul class="collapse list-unstyled" id="stockSubmenu">
				<li>
					<a href="add_stock.php">Add Stock Item</a>
				</li>
				<li>
					<a href="check_stock.php">Check Stock Left</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="#expenseSubmenu" data-toggle="collapse" aria-expanded="false">Expense Items</a>
			<ul class="collapse list-unstyled" id="expenseSubmenu">
				<li>
					<a href="add_expense.php">Add Expense Item</a>
				</li>
				<li>
					<a href="total_expense.php">Total Expense</a>
				</li>
			</ul>
		</li>
		-->
		<li>
			<a href='update_profile.php'>Change Password</a>
		</li>
		<li>
			<a href='help.php'>Help</a>
		</li>
		<li>
			<a href="logout.php">Log Out</a>
		</li>
	</ul>

	<ul class="list-unstyled CTAs">
		<a id="date_time" class="pull-right"></a>
			<script type="text/javascript">window.onload = date_time('date_time');</script> 
	</ul>
</nav>

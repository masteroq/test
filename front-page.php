
<?php get_header(); ?>
<?php
	$json = file_get_contents('https://api.jsonbin.io/b/5dd7cefb040d843991f7183c'); 
	$data = json_decode($json,true);
	$jobs = $data['jobs'];
	$departments = $data['departments'];
	$nb_elem_per_page = 10;
	$page = isset($_GET['page'])?intval($_GET['page']-1):0;
	$number_of_pages = intval(count($jobs)/$nb_elem_per_page)+1; ?>
	<script type="text/javascript">
		
	</script>
	<div class="content">
		<div class="remote_header">
			<div class="header_title">Our open positions</div>
			<div class="header_dropbox">
			<?php echo '<form action="'.$_SERVER['REQUEST_URI'].'" method="GET">'; ?>
				<select id="department" onchange="this.form.submit()">
					<?php foreach($departments as $value) : ?>
					<?php if ($_GET['department_id'] == $value['id']) { ?>
						<option id="<?= $value['id'] ?>" name="<?= $value['name'] ?>" selected><?= $_GET['department_name'] ?></option>
					<?php } else { ?>
					<option id="<?= $value['id'] ?>" name="<?= $value['name'] ?>" <?= $selected ?>><?= $value['name'] ?></option>
					<?php } endforeach; ?>
				</select>
				<input id="blogurl" type="hidden" value="<?php bloginfo('url'); ?>/"
			</form>
			</div>
		</div>
		<div class="remote_content">
		<?php
		if ($_GET['department_id'] == '') {
		foreach(array_slice($jobs, $page*$nb_elem_per_page, $nb_elem_per_page) as $value) :
			foreach($departments as $value_dep) :
				if ($value_dep['id'] == $value['departments'][0]):
					$dep = $value_dep['name'];
				endif;
			endforeach;
			
			echo '<div class="item" data-id="'.$value['departments'][0].'">';
			echo '<div class="vac_name"><a href="'.$value["absolute_url"].'" class="vac_name">' . $value['title'] . '</a></div>';
			echo '<div class="location"><i class="fas fa-map-marker-alt"></i>' . $value['location']['name'] . '<i class="fas fa-user-friends"></i>'.$dep.'</div>';
			echo '<div class="learnmore"><a href='.$value["absolute_url"].'>Learn more <i class="fas fa-arrow-right"></i></a></div>';
			echo '</div>';

		endforeach;
		}		
		if ($_GET['department_id'] !== '') {
			foreach($jobs as $value) :
				foreach($departments as $value_dep) :
					if ($value_dep['id'] == $value['departments'][0]):
						$dep = $value_dep['name'];
					endif;
				endforeach;
				if ($_GET['department_id'] == $value['departments'][0]) {
					echo '<div class="item" data-id="'.$value['departments'][0].'">';
					echo '<div class="vac_name"><a href="'.$value["absolute_url"].'" class="vac_name">' . $value['title'] . '</a></div>';
					echo '<div class="location"><i class="fas fa-map-marker-alt"></i>' . $value['location']['name'] . '<i class="fas fa-user-friends"></i>'.$dep.'</div>';
					echo '<div class="learnmore"><a href='.$value["absolute_url"].'>Learn more <i class="fas fa-arrow-right"></i></a></div>';
					echo '</div>';
				}
			endforeach;
		}
		?>
		</div>
		<div class="remote_footer">
			<?php if ($_GET['department_id'] == '') { ?>
			<ul id='paginator'>
			<?php
			for ($i=1;$i<=$number_of_pages;$i++) {?>
				<?php if ($_GET['page'] == $i) { $class = 'active'; } ?>
				<li class="<?= $class ?>"><a href='./?page=<?=$i?>' class="<?= $class ?>"><?= $i ?></a></li>
				<?php $class = ''; ?>
			<?php } ?>
			</ul>
			<?php } ?>
		</div>
	</div>
<?php wp_footer(); ?>
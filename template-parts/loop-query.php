<?php
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
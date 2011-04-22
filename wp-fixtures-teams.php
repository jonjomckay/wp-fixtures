<div class="wrap">
	<h2>Add Teams</h2>
	
	<?php $teams = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'wpf_teams'); ?>
	<?php print_r($teams); ?>
	<?php /*foreach ($teams as $team) : ?>
		<li><?php echo $team->name; ?></li>
	<?php endforeach;*/ ?>
</div>
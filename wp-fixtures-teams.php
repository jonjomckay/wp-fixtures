<div class="wrap">
	<h2>Add Teams</h2>
	
	<table class="wp-list-table widefat fixed">
		<thead>
			<tr>
				<th scope="col" id="name" class="manage-column column-name sortable desc">
					<a href="<?php echo get_admin_url(null, 'wp-fixtures-menu-teams?orderby=name&order=asc'); ?>">
						<span>Name</span>
						<span class="sorting-indicator"></span>
					</a>
				</th>
				<th scope="col" id="edit" class="manage-column column-edit">
					<span>Edit</span>
				</th>
				<th scope="col" id="delete" class="manage-column column-delete">
					<span>Delete</span>
				</th>
			</tr>
		</thead>
		<tbody id="the-list">
		<?php $teams = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'wpf_teams'); ?>
		<?php foreach ($teams as $team) : ?>
			<tr id="team-<?php echo $team->id; ?>" class="" valign="top">
				<td class="name column-name">
					<strong><?php echo $team->name; ?></strong>
				</td>
				<td class="edit column-edit">
					<strong>Edit</strong>
				</td>
				<td class="delete column-delete">
					<strong>Delete</strong>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
				<th scope="col" class="manage-column column-name sortable desc">
					<a href="<?php echo get_admin_url(null, 'wp-fixtures-menu-teams?orderby=name&order=asc'); ?>">
						<span>Name</span>
						<span class="sorting-indicator"></span>
					</a>
				</th>
				<th scope="col" class="manage-column column-edit">
					<span>Edit</span>
				</th>
				<th scope="col" class="manage-column column-delete">
					<span>Delete</span>
				</th>
			</tr>
		</tfoot>
	</table>
</div>
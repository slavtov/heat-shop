<div class="card">
	<div class="card-header">Filters</div>
	<div class="card-body">
		<?php foreach ($this->groups as $group_id => $group_item): ?>
			<?=$group_id != 1 ? '<hr>' : null;?>
			<h5><?=$group_item['title'];?></h5>
			<div class="row">
				<div class="col-12">
					<?php foreach ($this->attrs[$group_id] as $attr_id => $value): ?>
						<?php $checked = (!empty($filter) AND in_array($attr_id, $filter)) ? 'checked' : null; ?>
						<label class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" name="checkbox" value="<?=$attr_id;?>" <?=$checked;?>>
							<div class="custom-control-label"><?=$value;?></div>
						</label>
					<?php endforeach; ?>		
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>
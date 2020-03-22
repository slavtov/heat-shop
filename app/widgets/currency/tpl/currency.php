<option class="label" value hidden><?=$this->currency['code'];?></option>

<?php foreach ($this->currencies as $key => $val): ?>
	<?php if ($key != $this->currency['code']): ?>
		<option value="<?=$key;?>"><?=$key;?></option>
	<?php endif; ?>
<?php endforeach; ?>
<style type="text/css">

.row-stripped{
	border-botom:1px solid rgb(221,221,221);
}

</style>

<div class="span6">
	<div class="well well-small ">
	<div class="row-stripped">
	
	<div class="row-fluid " >
	<div class="span12" >

		<div class="span3 muted"><h2><?php echo $this->item->title; ?></h2></div>
		<div class="span8">
			<strong></strong>
			
		</div>
		
	</div>

	</div>

	<div class="row-fluid">
	<div class="span12">

		<div class="span3 muted">Notes</div>
		<div class="span8">
			<strong><?php 	echo $this->item->notes; ?></strong>
			<hr>
		</div>

	</div>
	</div>
	
	
	<div class="row-fluid">
	<div class="span12" id="asndiv" >
		<div class="span3 muted" id="asn"><i class="icon-user">Asignee</i></div>
		<div class="span8"><strong><?php echo $this->item->asignee; ?></strong>
		</div>
	
	</div>
	</div>
	
	
	<div class="row-fluid">
	<div class="span12" >


		<div class="span3 muted">Projects</div>
		<div class="span8">
			<strong><?php 	echo $this->item->projects; ?></strong>
			
		</div>


	</div>
	</div>
	
	
	
	<div class="row-fluid">
	<div class="span12">
	
	<div class="span3 muted"><i class="icon-calendar">Duedate</i></div>
		<div class="span8">
		<strong><?php echo $this->item->duedate; ?></strong>
		
		</div>
	</div>	

	<div class="row-fluid">
	<div class="span12">
	
	<div class="span3 muted "><i class="icon-search">Tags</i></div>
		<div class="span8">
		<strong><?php echo $this->item->tags; ?></strong>
	
		</div>

		
	</div>
	</div>

	
	<div class="row-fluid">
	<div class="span12" >

		<div class="span3 muted">Followers</div>
		<div class="span8">
			<strong><?php echo $this->item->followers; ?></strong>
				
		</div>


	</div>
	</div>

	<div class="row-fluid">
	<div class="span12">
		<div class="span3 muted">Activity Feed</div>
		<div class="span8">
			<strong><?php echo $this->item->feed; ?></strong>
			
		</div>

	</div>
	</div>

</div>
</div>
</div>

</div>



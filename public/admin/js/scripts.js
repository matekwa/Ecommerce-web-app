$(document).ready(function(){
$(".image_container").click(function(){
	location.reload();
	return confirm("Do you really want to delete this record?");
})
});
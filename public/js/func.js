function cambioMsj(s)
{
	var index = s.selectedIndex;

	var todos 	= $("#todos");
	var grupos 	= $("#grupos");

	var selectTodos = document.getElementById("selectTodos");
	var selectGrupos = document.getElementById("selectGrupos");

	if(index == 1){

		grupos.attr("class", "form-group");
		todos.attr("class", "form-group hide");
		selectTodos.selectedIndex = 0;
	}else if(index == 2){

		todos.attr("class", "form-group");
		grupos.attr("class", "form-group hide");
		selectGrupos.selectedIndex = 0;
	}else{

		grupos.attr("class", "form-group hide");
		todos.attr("class", "form-group hide");

		selectTodos.selectedIndex = 0;
		selectGrupos.selectedIndex = 0;
	}
}
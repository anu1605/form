
var emptyInput;
var btn = document.getElementById("submit");
btn.addEventListener("click", func);

function func() {
  var firstName = document.getElementById("fname");
  if(firstName.value == ""){
    removeBorder();
    emptyInput = firstName;
    emptyInput.classList.add('redBorder');
    return;
  }

  var lastName = document.getElementById("lname");
  if(lastName.value == ""){
    removeBorder();
    emptyInput = lastName;
    emptyInput.classList.add('redBorder');
    console.log(emptyInput.classList.contains('redBorder'));
    return;
  }

  var email = document.getElementById("email");
  if(email.value == ""){
    removeBorder();
    emptyInput = email;
    email.classList.add('redBorder')
    return;
  }

  
  // if(!document.getElementById("male").checked || document.getElementById("female").checked) {
  //   removeBorder();
  //   emptyInput = document.getElementById("male");
  //   emptyInput.classList.add("redBorder");
  //   return;
  // }


  var selectedValues = [];
  for (var option of document.getElementById("hobbies").options)
    if (option.selected) selectedValues.push(option.value);
  console.log(selectedValues);
  if(selectedValues.length == 0){
    console.log(emptyInput);
    removeBorder();
    emptyInput = document.getElementById("hobbies");
    emptyInput.classList.add('redBorder');
    console.log(emptyInput.classList);
    return;
  }

  var subjectList = [];
  var maths = document

}


var menu_btn = document.getElementById("menu");
var alreadyClick = false;
menu_btn.addEventListener("click", addClass);

function addClass() {
  var container = document.getElementById("option_container");
  var arrow = document.getElementById("menu");
  if (!alreadyClick) {
    container.classList.add("expandible_class");
    arrow.classList.remove("rotate_down");
    arrow.classList.add("rotate_up");
    alreadyClick = true;
  } else {
    container.classList.remove("expandible_class");
    arrow.classList.add("rotate_down");
    arrow.classList.remove("rotate_up");
    alreadyClick = false;
  }
}

var tableCount;

function addFunc() {

  
  //Add and delete row
  var table = document.getElementById("table_body");
  tableCount = document.getElementById("table_body").rows.length;

  //Check for Empty field
  var cellLength = document.getElementById("table_body").rows[0].cells.length;
  var x = document.getElementById("table_body").rows[tableCount-1];

  
  if(!checkEmptyCell(cellLength-1,x)){
    return;
  }
 

  var row = table.insertRow(tableCount);
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
  var cell4 = row.insertCell(3);
  var cell5 = row.insertCell(4);
  cell1.innerHTML =
    '<input class="education_level" type="text" id="education_level" name="education" value = "" placeholder="Education qualification">';
  cell2.innerHTML =
    '<input class="field" type="text" id="field" name="field" value="" placeholder="Field">';
  cell3.innerHTML =
    '<input class="year" type="text" id="year" name="year" value="" placeholder="Year">';
  cell4.innerHTML =
    '<input class="marks" type="text" name="marks" id="marks" value="" placeholder="Marks Obtained">';
  cell5.innerHTML =
    '<div id="add_and_delete" class="add_and_delete"> <button onclick="addFunc()" type="button" class="add" id="add" name="add" value="+"> + </button> <button onclick="myDeleteFunction()" type="button" class="minus" id="minus" name="minus" value="-"> - </button> </div>';
}

function myDeleteFunction() {
  document.getElementById("table_body").deleteRow(tableCount);
  tableCount--;
}



function checkEmptyCell(length,row){
  for(var i = 0; i<length;i++){
    var childList = row.cells[i].childNodes;
    var index = 0;
    if(childList.length>1){
      index = 1;
    }
    if(childList[index].value == ""){
      removeBorder();
      emptyInput = childList[index];
      childList[index].classList.add('redBorder');
      return false;
    }
  }
  return true;
}

document.addEventListener('click',removeBorder);

function removeBorder(){
  if(emptyInput != undefined && emptyInput.value != "")
  emptyInput.classList.remove('redBorder');
}

function redBorderRemove() {
  console.log("triggered");
}
var btn = document.getElementById('submit');
btn.addEventListener('click',func);



function func(){
    console.log(document.getElementById("fname").value +'\n');
    console.log(document.getElementById("lname").value);
    console.log(document.getElementById("email").value);
    
    if(document.getElementById('male').checked)
    console.log('Male');

    else if(document.getElementById('female').checked)
    console.log('Female');

    var selectedValues = [];
    for(var option of document.getElementById('hobbies').options)
    if(option.selected )
    selectedValues.push(option.value);
    console.log(selectedValues);
}

var menu_btn = document.getElementById('menu');
var alreadyClick = false;
menu_btn.addEventListener('click',addClass);

function addClass(){
    var container = document.getElementById('option_container');
    var arrow = document.getElementById('menu');
    if(!alreadyClick){
    container.classList.add('expandible_class');
    arrow.classList.remove('rotate_down')
    arrow.classList.add('rotate_up');
    alreadyClick = true;
}
else {
    container.classList.remove('expandible_class');
    arrow.classList.add('rotate_down');
    arrow.classList.remove('rotate_up')       
        alreadyClick = false;
    }
}

// var add = document.getElementById('add');
// var count = 0;



function addFunc(){
    var table = document.getElementById("table_body");
    var row = table.insertRow(0);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    cell1.innerHTML = '<input class="education_level" type="text" id="education_level" name="education" value="" placeholder="Education qualification">';
    cell2.innerHTML = '<input class="field" type="text" id="field" name="field" value="" placeholder="Field">';
    cell3.innerHTML = '<input class="year" type="text" id="year" name="year" value="" placeholder="Year">';
    cell4.innerHTML = '<input class="marks" type="text" name="marks" id="marks" value="" placeholder="Marks Obtained">';
}

function myDeleteFunction() {
  document.getElementById("myTable").deleteRow(0);
}
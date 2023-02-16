var emptyInput;
var tableCount=0;
var isSelected = false;
var alreadyClick = false;
var listLength = 0;
  var subjectList = [];
  var selectedSbject = [];
var btn = document.getElementById("submit");
btn.addEventListener("click", func);


function func() {
  console.log(document.getElementById('myFile').value);

  var firstName = document.getElementById("fname");
  if (firstName.value == "") {
    removeBorder();
    emptyInput = firstName;
    emptyInput.classList.add("redBorder");
    emptyInput.select();
    emptyInput.scrollIntoView();
    return;
  }

 
  var lastName = document.getElementById("lname");
  if (lastName.value == "") {
    removeBorder();
    emptyInput = lastName;
    emptyInput.classList.add("redBorder");
    emptyInput.select();
    emptyInput.scrollIntoView();
    return;
  }

  var email = document.getElementById("email");
  if (email.value == "") {
    removeBorder();
    emptyInput = email;
    email.classList.add("redBorder");
    emptyInput.select();
    emptyInput.scrollIntoView();
    return;
  }
  if(!validateEmail()){
    email.scrollIntoView();
    return;
  }

  var male = document.getElementById("male");
  var female = document.getElementById("female");
  if (male.checked == false && female.checked == false) {
    removeBorder();
    emptyInput = document.getElementById("male");
    emptyInput.classList.add("redBorder");
    emptyInput.scrollIntoView();
    return;
  }

  var selectedValues = [];
  for (var option of document.getElementById("hobbies").options)
    if (option.selected) selectedValues.push(option.value);
  if (selectedValues.length == 0) {
    removeBorder();
    emptyInput = document.getElementById("hobbies");
    emptyInput.classList.add("redBorder");
    emptyInput.scrollIntoView();
    return;
  }


  var maths = document.getElementById("maths");
  subjectList.push(maths);
  var biology = document.getElementById("biology");
  subjectList.push(biology);
  var economics = document.getElementById("economics");
  subjectList.push(economics);
  var chemistry = document.getElementById("chemistry");
  var physics = document.getElementById("physics");
  subjectList.push(physics);
  var english = document.getElementById("english");
  subjectList.push(english);
  for (var subject of subjectList) {
    if (subject.checked == true) selectedSbject.push(subject.value);
  }

  if (selectedSbject.length == 0) {
    addClass();

    document.getElementById('option_container').scrollIntoView();
    return;
  } 


  checkEmptyCell(5, document.getElementById("table_body").rows[tableCount]);

  if(!yearValidate()){
    document.getElementById('year').scrollIntoView();
    return;
  }
  
  if(!marksValidate()){
    document.getElementById('marks').scrollIntoView();
    return
  }


}

var male = document.getElementById("male");
male.addEventListener("click", genderValue);
var female = document.getElementById("female");
female.addEventListener("click", genderValue);

function genderValue() {
  if (male.checked == true || female.checked == true) {
    male.value = "male";
    female.value = "female";
  }
}

var menu_btn = document.getElementById("menu");

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


function addFunc() {
  //Add and delete row
  var table = document.getElementById("table_body");
  tableCount = document.getElementById("table_body").rows.length;

  //Check for Empty field
  var cellLength = document.getElementById("table_body").rows[0].cells.length;
  var x = document.getElementById("table_body").rows[tableCount - 1];

  if (!checkEmptyCell(cellLength - 1, x)) {
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

function checkEmptyCell(length, row) {
  for (var i = 0; i < length; i++) {
    var childList = row.cells[i].childNodes;
    var index = 0;
    if (childList.length > 1) {
      index = 1;
    }
    if (childList[index].value == "") {
      removeBorder();
      emptyInput = childList[index];
      childList[index].classList.add("redBorder");
      emptyInput.select();
      emptyInput.scrollIntoView();
      document.getElementById('message').innerHTML = childList[index].placeholder +" is Incomplete";
      return false;
    }
  }
  return true;
}

document.addEventListener("click", removeBorder);

function removeBorder() {
  if (emptyInput != undefined && emptyInput.value != "") {
    emptyInput.classList.remove("redBorder");
    document.getElementById('message').innerHTML = "";
  }
}

var myInput = document.getElementById('pwd');
var letter = document.getElementById('letter');
var capital = document.getElementById('capital');
var number = document.getElementById('number');
var length = document.getElementById('length');

myInput.onfocus = function() {
  document.getElementById('validator').style.display = "block";
}

myInput.onblur = function() {
  document.getElementById('validator').style.display = "none";
}


myInput.onkeyup = validator;

function validator(){
  var lowerCaseLetters = /[a-z]/g;

  if(myInput.value.match(lowerCaseLetters)){
    letter.classList.remove('invalid');
    letter.classList.add('valid');
  }
  else{
    letter.classList.remove('valid');
    letter.classList.add('invalid');
  }


  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)){
    capital.classList.remove('invalid');
    capital.classList.add('valid');
  }
  else{
    capital.classList.remove('valid');
    capital.classList.add('invalid');
  
  }

  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)){
    number.classList.remove('invalid');
    number.classList.add('valid');
  }
  else{
    number.classList.remove('valid');
    number.classList.add('invalid');
  
  }

  

  if(myInput.value.length >= 8){
      length.classList.remove('invalid');
      length.classList.add('valid');
    }
    else if(myInput.value.length){
      length.classList.remove('valid');
      length.classList.add('invalid');
    
    }
  
}
console.log(myInput.value);
var confirm = document.getElementById('confirm_pwd');
confirm.onkeyup = function() {
  if(myInput.value.length != 0){
    if(confirm.value.length > myInput.value.length ||
       !(confirm.value[confirm.value.length -1 ] == myInput.value[confirm.value.length - 1]))
    document.getElementById('pwd_message').innerHTML = "wrong password";
    else document.getElementById('pwd_message').innerHTML = "";
  } 
}

var email = document.getElementById("email");
email.onblur = validateEmail;

function validateEmail(){
  if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value))){
    document.getElementById('error').innerHTML = "email is wrong";
    return false;
  }
  else document.getElementById('error').innerHTML = ""
  return true;
}

var marksSelected = false;
var yearSelected = false;
var year = document.getElementById('year');
year.onkeyup = yearValidate;
function yearValidate(){
  yearSelected = true;
  var validYear = /[0-9]/g;
  if(!(year.value.match(validYear))){
    document.getElementById('message').innerHTML = "Enter valid Year";
    return false;
  }
  else document.getElementById('message').innerHTML = "";
  return true; 
}

var marks = document.getElementById('marks');
marks.onkeyup = marksValidate;
function marksValidate(){
  marksSelected = true;
  var vaildMarks = /[0-9\b]/g;
  if(!(marks.value.match(vaildMarks))){
    document.getElementById('message').innerHTML = "Enter valid marks"
    return false;
  }

  else document.getElementById('message').innerHTML = "";
  return true;
}


year.onblur = validMarksandYear;
marks.onblur = validMarksandYear;

function validMarksandYear(){
  if(marksSelected&& yearSelected&& marksValidate() && yearValidate())
  document.getElementById('message').innerHTML = "";
  else if(year.value.length !=4){
    document.getElementById('message').innerHTML = "Enter valid Year";
  }
}

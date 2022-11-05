var select = document.getElementById('subject_name');
var textSelected;
const result = document.querySelector('#resultadoP');
select.addEventListener('change',
  function(){
    var selectedOption = this.options[select.selectedIndex];
    console.log(selectedOption.value + ': ' + selectedOption.text);
    textSelected=selectedOption.value;
    for (var key in subjects) {
     if(subjects[key]['id']==textSelected){
       result.textContent = 'Horario: ' + subjects[key]['schedule'];
       return;
     }else{
      result.textContent = '';
     }
   }
  });

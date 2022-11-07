var selectTeacher = document.getElementById('subjectTeacherId');
var textSelected;
const resultTeacher = document.querySelector('#scheduleSubjectTeacher');
selectTeacher.addEventListener('change',
  function(){
    var selectedOption = this.options[selectTeacher.selectedIndex];
    textSelected=selectedOption.value;
    for (var key in subjects) {
     if(subjects[key]['id']==textSelected){
      resultTeacher.textContent = 'Horario: ' + subjects[key]['schedule'];
       return;
     }else{
      resultTeacher.textContent = '';
     }
   }
  });

var selectStudent = document.getElementById('subjectStudentId');
const resultStudent = document.querySelector('#scheduleSubjectStudent');
selectStudent.addEventListener('change',
  function(){
    var selectedOption = this.options[selectStudent.selectedIndex];
    textSelected=selectedOption.value;
    for (var key in subjects) {
     if(subjects[key]['id']==textSelected){
      resultStudent.textContent = 'Horario: ' + subjects[key]['schedule'];
       return;
     }else{
      resultStudent.textContent = '';
     }
   }
  });
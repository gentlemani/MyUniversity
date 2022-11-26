function visible_alum(){
    document.getElementById("sec_alum").style.display="";
    document.getElementById("contenido").style.display="none";
    document.getElementById("sec_prof").style.display="none";
    document.getElementById("sec_mat").style.display="none";
    document.getElementById("sec_cont").style.display="none";
    document.getElementById("sec_becas").style.display="none";
}


function visible_prof(){
    document.getElementById("sec_prof").style.display="";
    document.getElementById("sec_alum").style.display="none";
    document.getElementById("contenido").style.display="none";
    document.getElementById("sec_mat").style.display="none";
    document.getElementById("sec_cont").style.display="none";
    document.getElementById("sec_becas").style.display="none";
}


function visible_mat(){
    document.getElementById("sec_mat").style.display="";
    document.getElementById("sec_alum").style.display="none";
    document.getElementById("sec_prof").style.display="none";
    document.getElementById("contenido").style.display="none";
    document.getElementById("sec_cont").style.display="none";
    document.getElementById("sec_becas").style.display="none";

}

function visible_contact(){
    document.getElementById("sec_cont").style.display="";
    document.getElementById("sec_alum").style.display="none";
    document.getElementById("sec_prof").style.display="none";
    document.getElementById("sec_mat").style.display="none";
    document.getElementById("contenido").style.display="none";
    document.getElementById("sec_becas").style.display="none";
}
function visible_becas(){
    document.getElementById("sec_becas").style.display="";
    document.getElementById("contenido").style.display="none";
    document.getElementById("sec_cont").style.display="none";
    document.getElementById("sec_alum").style.display="none";
    document.getElementById("sec_prof").style.display="none";
    document.getElementById("sec_mat").style.display="none";
}
//Funciones de alumnos
function visible_becas_alumnos(){
    document.getElementById("sec_beca").style.display="";
    document.getElementById("sec_mat").style.display="none";
    document.getElementById("sec_trabajos").style.display="none";
    document.getElementById("contenido").style.display="none";
    document.getElementById("sec_cont").style.display="none";
}

function visible_contact_alumnos(){
    document.getElementById("sec_cont").style.display="";
    document.getElementById("sec_beca").style.display="none";
    document.getElementById("sec_mat").style.display="none";
    document.getElementById("contenido").style.display="none";
    document.getElementById("sec_trabajos").style.display="none";
}
function visible_mat_alumnos(){
    document.getElementById("sec_mat").style.display="";
    document.getElementById("sec_beca").style.display="none";
    document.getElementById("sec_trabajos").style.display="none";
    document.getElementById("contenido").style.display="none";
    document.getElementById("sec_cont").style.display="none";
}
function visible_trabajos_alumnos(){
    document.getElementById("sec_trabajos").style.display="";
    document.getElementById("sec_beca").style.display="none";
    document.getElementById("sec_mat").style.display="none";
    document.getElementById("contenido").style.display="none";
    document.getElementById("sec_cont").style.display="none";
}

function actualizarInputFile() {
    let filename = "'" + this.value.replace(/^.*[\\\/]/, '') + "'";
    this.parentElement.style.setProperty('--fn', filename);
    }
    
    document.querySelectorAll(".file-select input").forEach((ele)=>ele.addEventListener('change', actualizarInputFile));
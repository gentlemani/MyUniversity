function visible_alum(){
    document.getElementById("sec_alum").style.display="";
    document.getElementById("contenido").style.display="none";
    document.getElementById("sec_trabajos").style.display="none";
    document.getElementById("sec_mat").style.display="none";
    document.getElementById("sec_cont").style.display="none";
}



function visible_mat(){
    document.getElementById("sec_mat").style.display="";
    document.getElementById("sec_alum").style.display="none";
    document.getElementById("sec_trabajos").style.display="none";
    document.getElementById("contenido").style.display="none";
    document.getElementById("sec_cont").style.display="none";
    

}

function visible_trabajos(){
    document.getElementById("sec_trabajos").style.display="";
    document.getElementById("sec_alum").style.display="none";
    document.getElementById("sec_mat").style.display="none";
    document.getElementById("contenido").style.display="none";
    document.getElementById("sec_cont").style.display="none";

}

function visible_contact(){
    document.getElementById("sec_cont").style.display="";
    document.getElementById("sec_alum").style.display="none";
    document.getElementById("sec_trabajos").style.display="none";
    document.getElementById("sec_mat").style.display="none";
    document.getElementById("contenido").style.display="none";

}


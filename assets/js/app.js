// var todoList = document.getElementById("to-do-tasks");
// var InProgress = document.getElementById("in-progress-tasks");
// var Done = document.getElementById("done-tasks");

var typeFeature = document.querySelector("#feature");
var typeBug = document.querySelector("#bug");

var addTaskbtn = document.querySelector("#AddTaskBtn");

var form = document.forms['modalForm'];

// afficher();

// function clearList(){
//     todoList.innerText = "";
//     InProgress.innerText = ""; 
//     Done.innerText = ""; 
// }
// function afficher(){ //Read

//     clearList();
    
//     let countToDo = 0;
//     let countInProg = 0;
//     let countDone = 0;

//     for(let i = 0; i < tasks.length; i++){
//         var button = `<button data-id= "${tasks[i].id}" class="w-100 border-0 border-bottom border-1 border-dark d-flex pb-5px btn11">
//         <div class="text-start pt-1">
//             <i class="bi bi-question-circle fs-17px text-success"></i> 
//         </div>
//         <div class="ps-3 text-start">
//             <div class="fw-bold">${tasks[i].title}</div>
//             <div class="">
//                 <div class="text-secondary">#${tasks[i].id} created in ${tasks[i].date}</div>
//                 <div class="description" title="${tasks[i].description}">${tasks[i].description}</div>
//             </div>
//             <div class="">
//                 <span class="btn-primary rounded ps-2 pe-2 fw-bold hightcls">${tasks[i].type}</span>
//                 <span class="btn-muted rounded ps-2 pe-2 text-dark fw-bold">${tasks[i].priority}</span>
//                 <span class="delete" onclick='deletElement(${tasks[i].id})'><i class="bi bi-trash3-fill text-red"></i></span>
//                 <span class="pen" onclick= 'editFormAffiche(${tasks[i].id})' data-bs-toggle="modal" data-bs-target="#modal-task"><i class="bi bi-pencil-fill"></i></span>
//             </div>
//         </div>
//         </button> `
//         if(tasks[i].status ===  "To Do"){
//             countToDo++;
//             todoList.innerHTML += button;

//         } else if(tasks[i].status ===  "In Progress"){
//             countInProg++;
//             InProgress.innerHTML += button;
//         } else if(tasks[i].status === "Done"){
//             countDone++;
//             Done.innerHTML += button;
//         }
//     }

//     document.getElementById("to-do-tasks-count").innerText = countToDo;
//     document.getElementById("in-progress-tasks-count").innerText = countInProg;
//     document.getElementById("done-tasks-count").innerText = countDone;
    
// }

// function ajouter(){ //Create

//     if(form.title.value == "" || form.status.value == "Default"){
//         alert("No Enough Inputs\nFill Status or Title");
//         return 0;
//     }
    
//     let tmpObj = {
//         id: tasks[tasks.length - 1].id + 1 ,
//         title : form.title.value,
//         type : form.type.value,
//         priority : form.priority.value,
//         status : form.status.value,
//         date : form.date.value,
//         description : form.description.value
//     };


//     tasks.push(tmpObj);

//     afficher();
// }

addTaskbtn.addEventListener('click', ()=>{ //Change appearence of form when click "Add Task"
    form.reset();
    document.getElementById("modalTask").innerHTML = "Add Task";
    document.getElementById("modalFooter").innerHTML= `<button type="button" class="btn btn2" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn bg-white" id="save" name="saveChanges">Save changes!</button>`;
})

// function searchById(id){
//     for(let i = 0; i < tasks.length; i++){
//         if (tasks[i].id == id) {
//             return i; 
//         }
//     }
// }

// function deletElement(id){ //Delete
//     let index = searchById(id);
//     tasks.splice(index,1);

//     afficher();
// }

function editFormAffiche(id){ //Update
    
    // let index = searchById(id);

    form.id.value = id;

    form.title.value = document.getElementById(id+"t").getAttribute('value');

    if (document.getElementById(id+"ty").getAttribute('value') ==   2){
        typeFeature.checked = true;
    }else if(document.getElementById(id+"ty").getAttribute('value') == 1){
        typeBug.checked = true;
    }

    form.priority.value = document.getElementById(id+"p").getAttribute('value');
    form.status.value = document.getElementById(id+"s").getAttribute('value');;
    form.date.value = document.getElementById(id+"dt").getAttribute('value');
    form.description.value = document.getElementById(id+"dscrp").getAttribute('value');

    document.getElementById("modalTask").innerHTML = "Modify Task";
    
    var footer = document.getElementById("modalFooter");
    footer.innerHTML=`
    <button type="button" class="btn btn2" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn bg-white"
    name="update">Update!</button>`;
}

// function update(index){ //Update
//     if(form.title.value == "" || form.status.value == "Default"){
//         alert("No Enough Inputs\nFill Status or Title");
//         return 0;
//     }
    
//     let modifInpt = {
//         id : form.id.value,
//         title : form.title.value,
//         type : form.type.value,
//         priority : form.priority.value,
//         status : form.status.value,
//         date : form.date.value,
//         description : form.description.value,
//     };

//     tasks[index] = modifInpt; 
//     form.reset();
//     afficher();
// }
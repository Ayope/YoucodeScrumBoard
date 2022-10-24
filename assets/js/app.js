var todoList = document.getElementById("to-do-tasks");
var InProgress = document.getElementById("in-progress-tasks");
var Done = document.getElementById("done-tasks");

var typeFeature = document.querySelector("#feature");
var typeBug = document.querySelector("#bug");

var addTaskbtn = document.querySelector("#AddTaskBtn");
var form = document.forms['modalForm'];


afficher();

function clearList(){
    todoList.innerText = "";
    InProgress.innerText = ""; 
    Done.innerText = ""; 
}
function afficher(){ //Read

    clearList();
    
    let countToDo = 0;
    let countInProg = 0;
    let countDone = 0;

    for(let i = 0; i < tasks.length; i++){
        if(tasks[i].status ===  "To Do"){
            countToDo++;
            todoList.innerHTML += 
            `<button data-id= "${tasks[i].id}" class="w-100 border-0 border-bottom border-1 border-dark d-flex pb-5px btn11">
                <div class="text-start pt-1">
                    <i class="bi bi-question-circle fs-17px text-success"></i> 
                </div>
                <div class="ps-3 text-start">
                    <div class="fw-bold">${tasks[i].title}</div>
                    <div class="">
                        <div class="text-secondary">#${tasks[i].id} created in ${tasks[i].date}</div>
                        <div class="description" title="${tasks[i].description}">${tasks[i].description}</div>
                    </div>
                    <div class="">
                        <span class="btn-primary rounded ps-2 pe-2 fw-bold hightcls">${tasks[i].type}</span>
                        <span class="btn-muted rounded ps-2 pe-2 text-dark fw-bold">${tasks[i].priority}</span>
                        <span class="delete" onclick='deletElement(${tasks[i].id})'><i class="bi bi-trash3-fill text-red"></i></span>
                        <span class="pen" onclick= 'editElement(${tasks[i].id})' data-bs-toggle="modal" data-bs-target="#modal-task"><i class="bi bi-pencil-fill"></i></span>
                    </div>
                </div>
            </button> `

        } else if(tasks[i].status ===  "In Progress"){
            countInProg++;
            InProgress.innerHTML +=
            `<button data-id= "${tasks[i].id}" class="w-100 border-0 border-bottom border-1 border-dark d-flex pb-5px btn11">
            <div class="text-start pt-2">
                <i class="spinner-border spinner-border-sm fs-10px text-success"></i> 
            </div>
            <div class="ps-3 text-start">
                <div class="fw-bold">${tasks[i].title}</div>
                <div class="">
                    <div class="text-secondary">#${tasks[i].id} created in ${tasks[i].date}</div>
                    <div class="description" title="${tasks[i].description}">${tasks[i].description}</div>
                </div>
                <div class="">
                    <span class="btn-primary rounded ps-2 pe-2 fw-bold hightcls">${tasks[i].type}</span>
                    <span class="btn-muted rounded ps-2 pe-2 text-dark fw-bold">${tasks[i].priority}</span>
                    <span class="delete" onclick='deletElement(${tasks[i].id})'><i class="bi bi-trash3-fill text-red"></i></span>
                    <span class="pen" onclick= 'editElement(${tasks[i].id})' data-bs-toggle="modal" data-bs-target="#modal-task"><i class="bi bi-pencil-fill"></i></span>
                </div>
            </div>
            </button>`
        } else if(tasks[i].status === "Done"){
            countDone++;
            Done.innerHTML +=
            `<button data-id= "${tasks[i].id}" class="w-100 border-0 border-bottom border-1 border-dark d-flex pb-5px btn11">
            <div class="text-start pt-1">
                <i class="bi bi-check-circle fs-17px text-success"></i> 
            </div>
            <div class="ps-3 text-start">
                <div class="fw-bold">${tasks[i].title}</div>
                <div class="">
                    <div class="text-secondary">#${tasks[i].id} created in ${tasks[i].date}</div>
                    <div class="description" title="${tasks[i].description}">${tasks[i].description}</div>
                </div>
                <div class="">
                    <span class="btn-primary rounded ps-2 pe-2 fw-bold hightcls">${tasks[i].type}</span>
                    <span class="btn-muted rounded ps-2 pe-2 text-dark fw-bold">${tasks[i].priority}</span>
                    <span class="delete" onclick='deletElement(${tasks[i].id})'><i class="bi bi-trash3-fill text-red"></i></span>
                    <span class="pen" onclick= 'editElement(${tasks[i].id})' data-bs-toggle="modal" data-bs-target="#modal-task"><i class="bi bi-pencil-fill"></i></span>
                </div>
            </div>
            
            </button>`
        }
    }

    document.getElementById("to-do-tasks-count").innerHTML = countToDo;
    document.getElementById("in-progress-tasks-count").innerHTML = countInProg;
    document.getElementById("done-tasks-count").innerHTML = countDone;
    
}




function ajouter2(){ //Create
    var form = document.forms['modalForm'];

    if(form.title.value == "" || form.status.value == "Default"){
        alert("No Enough Inputs\nFill Status or Title");
        return 0;
    }
    
    let tmpObj = {
        id: tasks.length+1,
        title : form.title.value,
        type : form.type.value,
        priority : form.priority.value,
        status : form.status.value,
        date : form.date.value,
        description : form.description.value
    };


    tasks.push(tmpObj);

    afficher();
}

addTaskbtn.addEventListener('click', ()=>{
    form.reset();
    document.getElementById("modalTask").innerHTML = "Add Task";
    document.getElementById("modalFooter").innerHTML= `<button type="button" class="btn btn2" data-bs-dismiss="modal">Close</button>
    <button type="button" class="btn bg-white" onclick="ajouter2()" id="save" data-bs-dismiss="modal" name="saveChanges">Save changes!</button>`;
})


function deletElement(id){
    for(let i = 0; i < tasks.length; i++){
        if (tasks[i].id == id) {
            tasks.splice(i,1);
        }
    }
    afficher();
}

function editElement(id){
    var form = document.forms["modalForm"];
    
    for(let i = 0; i<tasks.length; i++){
        if(tasks[i].id == id){
            var index = i;
            break;
        }
    }

    form.id.value = tasks[index].id;
    form.title.value = tasks[index].title;
    if (tasks[index].type == "Feature"){
        typeFeature.checked = true;
    }else if(tasks[index].type == "Bug"){
        typeBug.checked = true;
    }
    form.priority.value = tasks[index].priority;
    form.status.value = tasks[index].status;
    form.date.value = tasks[index].date;
    form.description.value = tasks[index].description;

    document.getElementById("modalTask").innerHTML = "Modify Task";

    document.getElementById("save").style.display = "none";
    
    var footer = document.getElementById("modalFooter");
    footer.innerHTML=`
    <button type="button" class="btn btn2" data-bs-dismiss="modal">Close</button>
    <button type="button" class="btn bg-white" onclick="replace(${index})" id="save"
    data-bs-dismiss="modal" name="saveChanges">Update!</button>`;
}

function replace(index){
    var form = document.forms["modalForm"];
    if(form.title.value == "" || form.status.value == "Default"){
        alert("No Enough Inputs\nFill Status or Title");
        return 0;
    }
    
    let modifInpt = {
        id : form.id.value,
        title : form.title.value,
        type : form.type.value,
        priority : form.priority.value,
        status : form.status.value,
        date : form.date.value,
        description : form.description.value
    };

    tasks[index] = modifInpt; 
    form.reset();
    afficher();
}